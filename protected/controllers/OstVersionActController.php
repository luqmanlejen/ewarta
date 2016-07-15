<?php

class OstVersionActController extends CmsController {

    public function actionCreate() {
        $model = new OstVersionAct;

        if (isset($_POST['OstVersionAct'])) {
            $model->attributes = $_POST['OstVersionAct'];

            if ($model->save())
                $this->redirect(array('admin', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['OstVersionAct'])) {
            $model->attributes = $_POST['OstVersionAct'];
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
        $dataProvider = new CActiveDataProvider('OstVersionAct');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new OstVersionAct('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OstVersionAct']))
            $model->attributes = $_GET['OstVersionAct'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = OstVersionAct::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ost-version-act-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

//    public function actionFlash() {
//        Yii::app()->user->setFlash('notification', 'Your have been successfully logged in by facebook!');
//        $this->render('flash');
//    }
    
    public function actionDownload($id, $type){
        $model = OstVersionAct::model()->findByPk($id);
        //$url = Yii::app()->baseUrl."/uploads/files/lorem_ipsum_pdf.pdf";
        
        if($type == 1){
            if(file_exists("../$model->doc_name_bi")) {
                $model->file_url = Yii::app()->getRequest()->sendFile($model->doc_name_bi, file_get_contents('http://' . $_SERVER['HTTP_HOST'] . str_replace(' ','%20',$model->doc_name_bi)));
            } else {
                if(Yii::app()->session['lang'] == 'my'){
                    Yii::app()->user->setFlash('alert', "Maaf, fail muat turun tidak dijumpai!");
                } else {
                    Yii::app()->user->setFlash('alert', "Sorry, download file not found!");
                }
            }
        }
        
        if($type == 2){
            if(file_exists("../$model->doc_name_bm")) {
                $model->file_url = Yii::app()->getRequest()->sendFile($model->doc_name_bm, file_get_contents('http://' . $_SERVER['HTTP_HOST'] . str_replace(' ','%20',$model->doc_name_bm)));
            } else {
                if(Yii::app()->session['lang'] == 'my'){
                    Yii::app()->user->setFlash('alert', "Maaf, fail muat turun tidak dijumpai!");
                } else {
                    Yii::app()->user->setFlash('alert', "Sorry, download file not found!");
                }
            }
        }
        
        $this->redirect('index.php?r=portal/lomList');
    }

}
