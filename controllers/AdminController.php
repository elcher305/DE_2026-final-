<?php

namespace app\controllers;

use app\models\Consultation;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminController implements the CRUD actions for User model.
 */
class AdminController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
       return [
           'access' => [
               'class' => \yii\filters\AccessControl::class,
               'rules' => [
                   [
                       'allow' => true,
                       'roles' => ['@'],
                       'matchCallback' => function () {
                            return \Yii::$app->user->identity->isRoleAdmin();
                       },
                   ],
               ],
               'denyCallback' => function () {
                    throw new \yii\web\NotFoundHttpException(
                        'У вас нет доступа к этой странице'
                    );
               },
           ],
       ];
    }


    public function actionIndex()
    {
        $query = Consultation::find();

        $status = \Yii::$app->request->get('status');
        if ($status && $status !== 'all') {
            $query->andWhere(['status' => $status]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

            'pagination' => [
                'pageSize' => 6
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],

        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionCreate()
    {
        $model = new User();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionUpdateStatus()
    {
       $id = \Yii::$app->request->post('id');
       $status = \Yii::$app->request->post('status');
       $model = Consultation::findOne($id);

       if ($model){
           $model->status = $status;
           if ($model->save()) {
               return $this->redirect(['admin/index?success=1']);
           } else {
               return $this->redirect(['admin/index?success=0']);
           }
       }
       return $this->redirect(['admin/index']);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
