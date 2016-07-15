<?php

class OstArchivesController extends CmsController {

    public function actionCreate() {
        $model = new OstArchives;
        
        if (isset($_POST['OstArchives'])) {
            $model->attributes = $_POST['OstArchives'];            
            if (isset($_POST['OstArchives']['value']) && $_POST['OstArchives']['value'] != '') {
                $role_arr = $_POST['OstArchives']['value'];
                foreach ($role_arr as $arr) {              
                    $model = new OstArchives;
                    $model->value = $arr;                    
                    OstArchives::model()->deleteAllByAttributes(array('value' => $model->value));
                    $model->save();
                    
                }
            }
            if ($model->save())
                $this->redirect('index.php?r=ostArchives/admin');
        }

        $this->render('create', array('model' => $model,));
    }

    //public function actionUpdate($id) {
    //    $model = $this->loadModel($id);
    public function actionUpdate() {
        $model = new OstArchives;

        if (isset($_POST['OstArchives'])) {
            $model->attributes = $_POST['OstArchives'];
            if (isset($_POST['OstArchives']['value'])) {
                $role_arr = $_POST['OstArchives']['value'];
                foreach ($role_arr as $arr) {
                    $model2 = new OstArchives;
                    $model2->value = $arr;
                    if($model->value == $model2->value)
                    OstArchives::model()->deleteAllByAttributes(array('value' => $model->value));
                    $model2->save();
                }
            }
            $this->redirect('index.php?r=ostArchives/admin');
        }

        $this->render('update', array('model' => $model,));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('OstArchives');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new OstArchives('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OstArchives']))
            $model->attributes = $_GET['OstArchives'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = OstArchives::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ost-archives-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
