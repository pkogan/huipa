<?php

namespace app\controllers;

use Yii;
use app\models\Examen;
use app\models\ExamenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Da\QrCode\QrCode;
use kartik\mpdf\Pdf;

/**
 * ExamenController implements the CRUD actions for Examen model.
 */
class ExamenController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'ruleConfig' => [
                    'class' => \app\models\AccessRule::className(),
                ],
                'only' => ['index', 'view', 'update', 'delete', 'create', 'importarestudiantes', 'deleteestudiantes', 'asignarinstancias', 'deleteinstancias', 'deleteenvio'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'update', 'delete', 'create', 'importarestudiantes', 'deleteestudiantes', 'asignarinstancias', 'deleteinstancias', 'deleteenvio'],
                        'roles' => [\app\models\Rol::ROL_DOCENTE],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => [\app\models\Rol::ROL_AYUDANTE],
                    ],
                ],
            ],
        ];
    }

    public function actionImportarestudiantes($id) {
        $examen = $this->findModel($id);
        $model = new \app\models\ImportarInstanciaForm();
        $rows = [];
        $contadores = [];

        /*
         * se solicita archivo csv formato dni,obs
         */


        if ($model->load(Yii::$app->request->post())) {

            $model->archivo = \yii\web\UploadedFile::getInstance($model, 'archivo');

            if ($model->archivo) {
                $time = time();
                $nombre = '../tmp/examen' . $examen->idExamen . '_' . $time . '.' . $model->archivo->extension;
                $model->archivo->saveAs($nombre);
                $handle = fopen($nombre, "r");
                $contadores['error en archivo'] = 0;
                $contadores['registros'] = 0;

                $contadores['no existe estudiante'] = 0;
                $contadores['estudiante importado'] = 0;
                $contadores['error al guardar estudiante'] = 0;
                $contadores['importados'] = 0;
                $contadores['error al guardar registro'] = 0;


                while (($fileop = fgetcsv($handle, 1000, ",")) !== false) {
                    //print_r($fileop);
                    $contadores['registros']++;
                    $row = [];

                    /* todo hacerlo en función del archivo formato minimo dos maximo 11 último atributo respuesta */
                    if (isset($fileop[0]) && count($fileop) > 1) {
                        $row['mail'] = $fileop[0];

                        $estudiante = \app\models\Estudiante::findOne((['mail' => $row['mail']]));
                        if ($estudiante == null) {
                            $row['msj'] = 'No Existe Estudiante con Mail ingresado';
                            if (isset($fileop[1])) {
                                $contadores['no existe estudiante']++;
                                $estudiante = new \app\models\Estudiante();
                                $estudiante->apellidoNombre = $fileop[1];
                                $estudiante->mail = $row['mail'];
                                if (isset($fileop[2]) && $fileop[2] != '') {
                                    $estudiante->dni = $fileop[2];
                                }

                                if (isset($fileop[3]) && $fileop[3] != '') {
                                    $estudiante->legajo = $fileop[3];
                                }
                                if (!$estudiante->save()) {
                                    $row['msj'] .= '. Error al guardar Estudiante';
                                    foreach ($estudiante->errors as $atributo => $errores)
                                        $row['msj'] .= ', ' . $atributo . ': ' . implode(', ', $errores);
                                    $contadores['error al guardar estudiante']++;
                                    $estudiante = null;
                                } else {
                                    $row['msj'] .= '. Estudiante importado ok';
                                    $contadores['estudiante importado']++;
                                }
                            } else {
                                $row['msj'] .= '. Error al guardar Estudiante no cargó columnas 2, 3 y 4';
                                $contadores['error al guardar estudiante']++;
                            }
                        }
                        if ($estudiante != null) {
                            $examenestudiante = new \app\models\ExamenEstudiante();
                            $examenestudiante->idEstudiante = $estudiante->idEstudiante;
                            $examenestudiante->idExamen = $id;
                            $examenestudiante->hash = md5(uniqid());
                            $examenestudiante->idEstado = \app\models\Estado::ESTADO_INICIAL;

                            if (!$examenestudiante->save()) {
                                $row['msj'] = 'Error al guardar estudiante';
                                foreach ($examenestudiante->errors as $atributo => $errores)
                                    $row['msj'] .= ', ' . $atributo . ': ' . implode(', ', $errores);
                                $contadores['error al guardar registro']++;
                            } else {
                                $row['msj'] = 'ok';
                                $contadores['importados']++;
                            }
                        }
                        //$row['instancia']=$instancia;

                        $rows[] = $row;
                    } else {
                        $contadores['error en archivo']++;
                    }
                }
                //print_r($rows);
            }
        }
        $provider = new \yii\data\ArrayDataProvider([
            'allModels' => $rows,
            'pagination' => false
        ]);

        return $this->render('importar', [
                    'model' => $examen,
                    'provider' => $provider,
                    'contadores' => $contadores,
                    'modelform' => $model
        ]);
    }

    /**
     * Lists all Examen models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ExamenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Examen model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $searchModelEstudiante = new \app\models\ExamenEstudianteSearch();
        $searchModelEstudiante->idExamen = $id;
        $dataProviderEstudiante = $searchModelEstudiante->search(Yii::$app->request->queryParams);

        $searchModelEnunciado = new \app\models\ExamenEnunciadoSearch();
        $searchModelEnunciado->idExamen = $id;
        $dataProviderEnunciado = $searchModelEnunciado->search(Yii::$app->request->queryParams);


        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'searchModelEstudiante' => $searchModelEstudiante,
                    'dataProviderEstudiante' => $dataProviderEstudiante,
                    'searchModelEnunciado' => $searchModelEnunciado,
                    'dataProviderEnunciado' => $dataProviderEnunciado
        ]);
    }

    public function actionDeleteenvio($id) {

        $model = $this->findModel($id);
        /**
         * Borrar todas las instancias actuales
         */
        $estadoEnviado = $model->getExamenesEstudiantesEstado(\app\models\Estado::ESTADO_ENVIADO)->all();
        foreach ($estadoEnviado as $estudiante) {

            $estudiante->hash = md5(uniqid());
            $estudiante->idEstado = \app\models\Estado::ESTADO_ASIGNADO;
            $estudiante->save();
        }
        return $this->redirect(['view', 'id' => $model->idExamen]);
    }

    public function actionAsignarinstancias($id) {

        $model = $this->findModel($id);
        /**
         * Borrar todas las instancias actuales
         */
        $estadoInicial = $model->getExamenesEstudiantesEstado(\app\models\Estado::ESTADO_INICIAL)->all();
        foreach ($estadoInicial as $estudiante) {

            $estudiante->hash = md5(uniqid());
            $estudiante->idEstado = \app\models\Estado::ESTADO_ASIGNADO;
            $estudiante->save();
        }

        /**
         * Para cada Meta-enunciado crea las respectivas instancias para cada estudiante
         */
        foreach ($model->examenEnunciados as $enunciado) {
            $instanciasEnunciados = array_merge($enunciado->idMetaEnunciado0->instanciaEnunciados);

            $cant = count($instanciasEnunciados);
            $i = random_int(1, 100);
            foreach ($estadoInicial as $estudiante) {
                $examenEstudianteInstancia = new \app\models\ExamenEstudianteInstancia();
                $examenEstudianteInstancia->idExamenEstudiante = $estudiante->idExamenEstudiante;
                $examenEstudianteInstancia->idInstanciaEnunciado = $instanciasEnunciados[$i % $cant]->idInstanciaEnunciado;
                $examenEstudianteInstancia->save();
                $i++;
            }
        }

        /**
         * Actualizo hash
         */
        return $this->redirect(['view', 'id' => $model->idExamen]);
    }

    /**
     * Creates a new Examen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Examen();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idExamen]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Examen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idExamen]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    public function actionDeleteestudiantes($id) {
        $model = $this->findModel($id);
        /**
         * todo hacer un solo delete
         */
        \app\models\ExamenEstudiante::deleteAll('idExamen=' . $model->idExamen);

        return $this->redirect(['view', 'id' => $model->idExamen]);
    }

    public function actionDeleteinstancias($id) {
        $model = $this->findModel($id);
        /**
         * todo hacer un solo delete
         */
        foreach ($model->examenEstudiantes as $estudiante) {
            \app\models\ExamenEstudianteInstancia::deleteAll('idExamenEstudiante=' . $estudiante->idExamenEstudiante);
            $estudiante->hash = md5(uniqid());
            $estudiante->idEstado = \app\models\Estado::ESTADO_INICIAL;
            $estudiante->save();
        }


        return $this->redirect(['view', 'id' => $model->idExamen]);
    }

    /**
     * Deletes an existing Examen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Examen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Examen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Examen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
