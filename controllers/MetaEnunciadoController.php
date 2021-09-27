<?php

namespace app\controllers;

use Yii;
use app\models\MetaEnunciado;
use app\models\MetaEnunciadoSearch;
use app\models\InstanciaEnunciadoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MetaEnunciadoController implements the CRUD actions for MetaEnunciado model.
 */
class MetaEnunciadoController extends Controller {

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
                'only' => ['index', 'view', 'update', 'delete', 'create','importar','deleteinstancias', 'exportarmoodle'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'update', 'delete', 'create','importar','deleteinstancias','exportarmoodle'],
                        'roles' => [\app\models\Rol::ROL_DOCENTE],
                    ],
                ],
            ],
        ];
    }

    public function actionExportarmoodle($id) {
        header ("Content-Type:text/xml");

        return $this->renderPartial('moodle', [
                    'model' => $this->findModel($id),
                    
        ], true);
    }
    
    
    public function actionImportar($id) {
        $metaEnunciado = $this->findModel($id);
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
                $nombre = '../tmp/metaEnunciado' . $metaEnunciado->idMetaEnunciado . '_' . $time . '.' . $model->archivo->extension;
                $model->archivo->saveAs($nombre);
                $handle = fopen($nombre, "r");
                $contadores['error en archivo'] = 0;
                $contadores['registros'] = 0;

                //$contadores['no existe persona'] = 0;
                //$contadores['registro importado'] = 0;
                $contadores['error al guardar registro'] = 0;
                $contadores['importados'] = 0;
                //$contadores['error al guardar certificado'] = 0;


                while (($fileop = fgetcsv($handle, 1000, ",")) !== false) {
                    //print_r($fileop);
                    $contadores['registros']++;
                    $row = [];
                    $instancia = new \app\models\InstanciaEnunciado();
                    /*todo hacerlo en función del archivo formato minimo dos maximo 11 último atributo respuesta*/
                    if (isset($fileop[0])&&count($fileop)>1) {
                        
                        for($i=1;$i<count($fileop);$i++){
                            $atributo='c'.$i;
                            $row[$atributo] = $fileop[$i-1];
                            $instancia->$atributo=$fileop[$i-1];
                        }
                        $row['Respuesta'] = $fileop[$i-1];
                        $instancia->respuesta=$fileop[$i-1];
                        
                        //$persona = \app\models\Persona::findOne((['dni' => $row['dni']]));
                        
                        $instancia->idMetaEnunciado = $id;
                        
                        if (!$instancia->save()) {
                            $row['msj'] = 'Error al guardar instancia';
                            foreach ($instancia->errors as $atributo => $errores)
                                $row['msj'] .= ', ' . $atributo . ': ' . implode(', ', $errores);
                            $contadores['error al guardar registro']++;
                        } else {
                            $row['msj'] = 'ok';
                            $contadores['importados']++;
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
                    'model' => $metaEnunciado,
                    'provider' => $provider,
                    'contadores' => $contadores,
                    'modelform' => $model
        ]);
    }

    /**
     * Lists all MetaEnunciado models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MetaEnunciadoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MetaEnunciado model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $searchModel = new InstanciaEnunciadoSearch();
        $searchModel->idMetaEnunciado = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel
        ]);
    }

    /**
     * Creates a new MetaEnunciado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new MetaEnunciado();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idMetaEnunciado]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing MetaEnunciado model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idMetaEnunciado]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    
    /**
     * Deletes an existing MetaEnunciado model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteinstancias($id) {
        $model=$this->findModel($id);
        
        \app\models\InstanciaEnunciado::deleteAll('idMetaEnunciado='.$model->idMetaEnunciado);
        

        return $this->redirect(['view', 'id' => $model->idMetaEnunciado]);
    }    
    
    /**
     * Deletes an existing MetaEnunciado model.
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
     * Finds the MetaEnunciado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MetaEnunciado the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MetaEnunciado::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
