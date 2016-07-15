<?php

class OstPerundanganController extends CmsController {

    public function actionCreate() {
        $model = new OstPerundangan;

        if (isset($_POST['OstPerundangan'])) {
            $model->attributes = $_POST['OstPerundangan'];
			 $model->user_id = Yii::app()->session['user_id'];
            if ($model->save())
                $this->redirect(array('admin', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['OstPerundangan'])) {
            $model->attributes = $_POST['OstPerundangan'];
			 $model->user_id = Yii::app()->session['user_id'];
            if ($model->save())
                $this->redirect(array('admin', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('OstPerundangan');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }
    
    public function actionAdmin() {
        $model = new OstPerundangan('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OstPerundangan']))
            $model->attributes = $_GET['OstPerundangan'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = OstPerundangan::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ost-perundangan-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
