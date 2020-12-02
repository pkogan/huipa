<?php

namespace app\controllers;

use Yii;
use app\models\InstanciaEnunciado;
use app\models\InstanciaEnunciadoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InstanciaEnunciadoController implements the CRUD actions for InstanciaEnunciado model.
 */
class InstanciaEnunciadoController extends Controller {

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
                'only' => ['index', 'view', 'update','updaterespuesta', 'delete', 'create'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'update','updaterespuesta', 'delete', 'create'],
                        'roles' => [\app\models\Rol::ROL_DOCENTE],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['updaterespuesta'],
                        'roles' => [\app\models\Rol::ROL_AYUDANTE],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all InstanciaEnunciado models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new InstanciaEnunciadoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InstanciaEnunciado model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new InstanciaEnunciado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id) {
        $model = new InstanciaEnunciado();
        $model->idMetaEnunciado = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idInstanciaEnunciado]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing InstanciaEnunciado model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idInstanciaEnunciado]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }
    public function actionUpdaterespuesta($id,$hash) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/examen-estudiante/view', 'hash' => $hash]);
        }

        return $this->render('updateRespuesta', [
                    'model' => $model,
        ]);
    }
    /**
     * Deletes an existing InstanciaEnunciado model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $idMetaEnunciado = $model->idMetaEnunciado;
        $model->delete();

        return $this->redirect(['/meta-enunciado/view', 'id' => $idMetaEnunciado]);
    }

    /**
     * Finds the InstanciaEnunciado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InstanciaEnunciado the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = InstanciaEnunciado::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
