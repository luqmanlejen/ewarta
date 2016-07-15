<?php

class OstRefListController extends Controller {

    public function init() {
        parent::init();
        Yii::app()->theme = "admin";

//            if(Yii::app()->user->isGuest){
//                $this->redirect('index.php?r=login/index');
//            }
    }

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /*
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */

    public function actionCreate() {
        $model = new OstRefList;
        $model2 = new OstRefList;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $id = $_GET['cat_id'];

        if (isset($_POST['OstRefList'])) {
            $model->attributes = $_POST['OstRefList'];
            $model->cat_id = $_POST['cat_id'];
            $model->lang = 'en';
            if ($model->save()) {
                //$model2->cat_id = $_POST['cat_id'];
                $model2->label = $_POST['label_malay'];
                $model2->parent_id = $model->id;
                $model2->lang = 'my';
                if ($model2->save(false)) {
                    //$this->redirect(array('list','id'=>$model->id));
                    //$this->redirect("index.php?r=OstRef/admin");
                    OstAuditTrail::model()->insertlog(2, 'create', $model->id);
                    $this->redirect("index.php?r=OstRefList/list&cat_id=" . $id);
                }
            }
        }

        $this->render('create', array(
            'model' => $model, 'model2' => $model2,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($cat_id, $id) {
        $model = $this->loadModel($id);
        $model2 = OstRefList::model()->findByAttributes(array('parent_id' => $id));
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
//		if(isset($_POST['OstRefList']))
//		{
//			$model->attributes=$_POST['OstRefList'];
//			if($model->save())
//				$this->redirect(array('admin','id'=>$model->id));
//		}
        if (isset($_POST['OstRefList'])) {
            $model->attributes = $_POST['OstRefList'];
            $model->cat_id = $cat_id; //$_POST['cat_id'];
            $model->lang = 'en';
            if ($model->save()) {
                //$model2->cat_id = $_POST['cat_id'];
                $model2->label = $_POST['label_malay'];
                $model2->parent_id = $model->id;
                $model2->lang = 'my';
                if ($model2->save(false)) {
                    //$this->redirect(array('list','id'=>$model->id));
                    OstAuditTrail::model()->insertlog(2, 'update', $id);
                    $this->redirect("index.php?r=OstRefList/list&cat_id=" . $cat_id);
                }
            }
        }

        $this->render('update', array(
            'model' => $model, 'model2' => $model2,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($cat_id, $id) {
        OstAuditTrail::model()->insertlog(2, 'delete', $id);
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        //if(!isset($_GET['ajax']))
        //	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//            $model = $this->loadModel($id);
//            $model = OstRefList::model()->findByAttributes(array('parent_id'=>$model->id));
//            
//            if($model->delete()){
//                $model2->delete();
//                
//                $this->redirect('index.php?r=OstRef/admin');
//            }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('OstRefList');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new OstRef('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OstRef']))
            $model->attributes = $_GET['OstRef'];
        $this->render('admin', array('model' => $model,));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return OstRefList the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = OstRefList::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param OstRefList $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ost-ref-list-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionList() {
        $model = new OstRefList('searchList');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OstRefList']))
            $model->attributes = $_GET['OstRefList'];

        $this->render('list', array(
            'model' => $model,
        ));
    }

}