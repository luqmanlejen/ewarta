<?php

class OstRefController extends Controller {
    
    public function init(){
        parent::init();
        Yii::app()->theme = "admin";

//        if(Yii::app()->user->isGuest){
//            $this->redirect('index.php?r=login/index');
//        }
    }
    
    public function actionCreate() {
        $model = new OstRef;
        
        if (isset($_POST['OstRef'])) {
            $model->attributes = $_POST['OstRef'];
            if ($model->save())
                $this->redirect('index.php?r=ostRef/admin');
        }
        
        $this->render('create', array('model' => $model,));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        
        if (isset($_POST['OstRef'])) {
            $model->attributes = $_POST['OstRef'];
            if ($model->save())
                $this->redirect('index.php?r=ostRef/admin');
        }
        
        $this->render('update', array('model' => $model,));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();
        $this->redirect('index.php?r=ostRef/admin');
    }

    public function actionAdmin() {
        $model = new OstRef('search');
        
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OstRef']))
            $model->attributes = $_GET['OstRef'];
        
        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id) {
        $model = OstRef::model()->findByPk($id);
        
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ost-ref-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
