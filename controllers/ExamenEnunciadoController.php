<?php

namespace app\controllers;

use Yii;
use app\models\ExamenEnunciado;
use app\models\ExamenEnunciadoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExamenEnunciadoController implements the CRUD actions for ExamenEnunciado model.
 */
class ExamenEnunciadoController extends Controller {

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
                'only' => ['index', 'view', 'update', 'delete', 'create'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['delete', 'create'],
                        'roles' => [\app\models\Rol::ROL_DOCENTE],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all ExamenEnunciado models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ExamenEnunciadoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ExamenEnunciado model.
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
     * Creates a new ExamenEnunciado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id,$idMetaEnunciado=null) {
        $model = new ExamenEnunciado();
        $model->idExamen = $id;
        $model->idMetaEnunciado = $idMetaEnunciado;
        //$model->load(Yii::$app->request->post())
        if (!is_null($idMetaEnunciado) && $model->save()) {
            return $this->redirect(['/examen/view', 'id' => $model->idExamen]);
        }

        
        $searchModel = new \app\models\MetaEnunciadoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('create', [
                    'model' => $model,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing ExamenEnunciado model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idExamenEnunciado]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ExamenEnunciado model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $idExamen = $model->idExamen;
        $model->delete();

        return $this->redirect(['/examen/view', 'id' => $idExamen]);
    }

    /**
     * Finds the ExamenEnunciado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ExamenEnunciado the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ExamenEnunciado::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
