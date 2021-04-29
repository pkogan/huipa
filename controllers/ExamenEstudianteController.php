<?php

namespace app\controllers;

use Yii;
use app\models\ExamenEstudiante;
use app\models\ExamenEstudianteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Da\QrCode\QrCode;
use kartik\mpdf\Pdf;

/**
 * ExamenEstudianteController implements the CRUD actions for ExamenEstudiante model.
 */
class ExamenEstudianteController extends Controller {

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
                'only' => ['index', 'view', 'update', 'delete', 'create', 'mail', 'maillote'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['view', 'create', 'delete', 'mail', 'maillote'],
                        'roles' => [\app\models\Rol::ROL_DOCENTE],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['?', \app\models\Rol::ROL_AYUDANTE],
                    ],
                ],
            ],
        ];
    }

    /**
     * 
     * @param ExamenEstudiante $model
     * @return boolean
     * @throws \yii\web\NotAcceptableHttpException
     */
    private function mail($model, $test = false) {
        $subject = 'Examen - ' . $model->idExamen0->nombre;
        /* Hack cambiar del en el caso de por ejermplo Académica 
          Todo: ver forma de generalizar */
        //echo 'entro en mail';
        if ($test) {
            $subject='Testing '.$subject;
            $to = Yii::$app->components['mailer']['transport']['username'];
        } else {
            $to = $model->idEstudiante0->mail;
        }
        //
        $send = Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->components['mailer']['transport']['username'])
                ->setBcc(explode(',', str_replace(' ', '', $model->idExamen0->cco)))
                ->setTo($to)
                ->setSubject($subject)
                ->setHtmlBody('Estimadx, ' . $model->idEstudiante0->apellidoNombre .
                        ', este correo es enviado por el sistema (incuba.fi.uncoma.edu.ar/huipa) Gererador de examenes Aleatorios la Facultad de Informática de la Universidad Nacional Comahue. <br>' .
                        'El exámen se envió adjunto y también se puede descargar desde el siguiente  ' . \yii\helpers\Html::a('link', $model->link) . '.<br>  Muchas Gracias.')
                ->attach($model->linkpdf,
                        ['fileName' => $model->idExamen0->nombre . '-' . $model->idEstudiante0->apellidoNombre . '.pdf', 'contentType' => 'application/pdf'])
                ->send();
        if ($send) {
            if (!$test) {
                $model->idEstado = \app\models\Estado::ESTADO_ENVIADO;
                if ($model->save()) {
                    return true;
                } else {
                    throw new \yii\web\NotAcceptableHttpException('Error al cambiar de estado el examen estudiante');
                }
            }
        } else {
            throw new \yii\web\NotAcceptableHttpException('Error al enviar mail');
        }
    }

    /**
     * 
     * @param Examen $model
     * @param type $qrCode
     * @return type
     */
    private function pdf($model, $qrCode) {
        /* @var $model ExamenEstudiante */

        $content = $this->renderPartial('template/basico', ['model' => $model, 'qrCode' => $qrCode]);
        $header = 'Examen Digital emitido por la Facultad de Informática de la Universidad Nacional del Comahue';


        // get your HTML raw content without any layouts or scripts
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            //'filename'=>$model->idLote0->idActividad0->fecha.str_replace(' ', '', $model->idPersona0->apellidoNombre).'_'.substr($model->idLote0->idTipoCertificado0->tipo,0,3).'_'.substr($model->idLote0->idActividad0->idTipoActividad0->tipo,0,3).'.pdf',
            'filename' => $model->idExamen0->nombre . '.pdf',
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => 'P',
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            //'cssFile' => '@vendor/bower-asset/bootstrap/dist/css/bootstrap.css',
            //'cssFile' => '@app/web/assets/bc3439ae/css/bootstrap.css',
            //'cssFile' => 'css/site.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            //'options' => ['title' => 'Certificado sistema wene'],
            // call mPDF methods on the fly
            'marginLeft' => 15,
            'marginRight' => 15,
            'methods' => [
                'SetHeader' => [$header],
                'SetFooter' => ['<p>Se puede validar el examen, accediendo al link del código QR, o haciendo click <a href="' . $model->getLink() . '">' . $model->getLink() . '</a></p>' .
                    'Sistema de Generador de Examenes'], // <img style="padding-top:2px" height="12px" src="img/logolargonegro.png"/>  '],
            ]
        ]);

        /* if ($model->adjunto) {
          $pdf->addPdfAttachment($model->nombreArchivo());
          } */
        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    private function qr($model) {
        $qrCode = (new QrCode($model->getLink()))
                ->setSize(100)
                ->setMargin(5);
        $qrCode->writeFile(__DIR__ . '/../tmp/code.png'); // writer defaults to PNG when none is specified

        header('Content-Type: ' . $qrCode->getContentType());
        return $qrCode;
    }

    public function actionMail($hash) {

        $model = ExamenEstudiante::findOne(['hash' => $hash]);
        if ($this->mail($model)) {
            return $this->redirect(['view', 'hash' => $model->hash]);
        }
    }

    public function actionMaillote($id, $test = false) {
        if (($examen = \app\models\Examen::findOne($id)) == null) {
            throw new \yii\web\NotAcceptableHttpException('Examen Inexistente');
        }
        //$examen->validarPermisos();
        /*
         * se envía mail a todo el examen en ESTADO_INICIAL a TOPE_MAIL_LOTE
         */
        $examenesEstadoInicial = $examen->getExamenesEstudiantesEstado(\app\models\Estado::ESTADO_ASIGNADO)
                ->limit(\app\models\Examen::TOPE_MAIL_LOTE)
                ->all();

        foreach ($examenesEstadoInicial as $model) {
            //print_r($model);exit();
            // if ($model->idEstado == \app\models\Estado::ESTADO_INICIAL) {
            $this->mail($model, $test);
            /* $model->idEstado = \app\models\Estado::ESTADO_ENVIADO;
              if (!$model->save()) {
              throw new \yii\web\NotAcceptableHttpException('Error al guardar certificado');
              } */
            //}
        }
        /**
         * actualizar estado del examen
         */
        return $this->redirect(['/examen/view', 'id' => $id]);
    }

    /**
     * Lists all ExamenEstudiante models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ExamenEstudianteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ExamenEstudiante model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($hash, $pdf = false) {

        $model = ExamenEstudiante::findOne(['hash' => $hash]);


        $qrCode = $this->qr($model);
        //print_r($model); exit;
        if ($pdf) {
            return $this->pdf($model, $qrCode);
        } else {

            return $this->render('view', [
                        'model' => $model,
                        'qrCode' => $qrCode,
            ]);
        }
    }

    /**
     * Creates a new ExamenEstudiante model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id) {
        $model = new ExamenEstudiante();
        $model->idExamen = $id;
        if ($model->load(Yii::$app->request->post())) {
            $model->hash = md5(uniqid());
            $model->idEstado = \app\models\Estado::ESTADO_INICIAL;
        }
        if ($model->save()) {
            return $this->redirect(['view', 'hash' => $model->hash]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing ExamenEstudiante model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'hash' => $model->hash]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ExamenEstudiante model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model=$this->findModel($id);
        
        $id=$model->idExamen;
        $model->delete();
        return $this->redirect(['/examen/view','id'=>$id]);
    }

    /**
     * Finds the ExamenEstudiante model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ExamenEstudiante the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ExamenEstudiante::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
