<?php

namespace frontend\controllers;

use Yii;
use common\models\records\ProjectRecord;
use frontend\models\domain\Project;
use frontend\models\domain_repositories\ProjectRepository;
use common\models\search\ProjectRecordSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\search\TaskSearch;
use yii\data\ArrayDataProvider;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{

    public $layout = 'testLayout';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'delete', 'view', 'index'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'delete', 'view', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }



    /**
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectRecordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param integer $iddataProvider
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(string $projectId)
    {
        $project = ProjectRepository::getById((int)$projectId);
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $project,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $project = new Project(['id' => Yii::$app->user->getId()]);

        if ($project->load(Yii::$app->request->post())) {
            ProjectRepository::add($project);
            $id = $project->getId();
            return $this->redirect(["project/$id/task"]);
        }

        $this->layout = 'empty';

        return $this->render('_form', [
            'model' => $project,
        ]);
    }


    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(string $projectId)
    {
        $project = ProjectRepository::getById((int)$projectId);

        if ($project->load(Yii::$app->request->post())) {
            ProjectRepository::save($project);

            return $this->redirect(["project/{$project->getId()}/task"]);
        }

        return $this->render('_form', ['model' => $project]);

    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectRecord::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
