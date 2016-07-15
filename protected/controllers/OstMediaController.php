<?php

class OstMediaController extends CmsController {

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($media_type) {
        $model = new OstMedia;
        $model2 = new OstMedia;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['OstMedia'])) {
            $model->attributes = $_POST['OstMedia'];
            $model->media_type = $media_type;

            if ($model->save()) {
                $model2->title = $_POST['title_my'];
                $model2->lang = 'my';
                $model2->parent_id = $model->id;
                $model2->img = $_POST['img_url_my'];
                $model2->save(false);

                //$this->redirect("index.php?r=ostMedia/admin&media_type=" . $media_type);


                if ($media_type === '') {
                    OstAuditTrail::model()->insertlog(15, 'create', $model->id);
                    $this->redirect("index.php?r=ostMedia/admin");
                } else {
                    if ($media_type === 'background')
                        OstAuditTrail::model()->insertlog(331, 'create', $model->id);
                    if ($media_type === 'slider2')
                        OstAuditTrail::model()->insertlog(332, 'create', $model->id);
                    if ($media_type === 'video')
                        OstAuditTrail::model()->insertlog(17, 'create', $model->id);
                    if ($media_type === 'audio')
                        OstAuditTrail::model()->insertlog(18, 'create', $model->id);
                    if ($media_type === 'slider')
                        OstAuditTrail::model()->insertlog(19, 'create', $model->id);
                    if ($media_type === 'online')
                        OstAuditTrail::model()->insertlog(13, 'create', $model->id);

                    $this->redirect("index.php?r=ostMedia/admin&media_type=" . $media_type);
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
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model2 = OstMedia::model()->findByAttributes(array('parent_id' => $id));
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['OstMedia'])) {
            $model->attributes = $_POST['OstMedia'];
            $model->media_type = $_GET['media_type'];
            $media_type = $model->media_type;

            if ($model->save()) {
                $model2->title = $_POST['title_my'];
                $model2->lang = 'my';
                $model2->parent_id = $model->id;
                $model2->img = $_POST['img_url_my'];
                $model2->save(false);

                //$this->redirect("index.php?r=ostMedia/admin&media_type=" . $model->media_type);


                if ($media_type == '') {
                    OstAuditTrail::model()->insertlog(15, 'update', $model->id);
                    $this->redirect("index.php?r=ostMedia/admin");
                } else {
                    if ($media_type == 'background')
                        OstAuditTrail::model()->insertlog(331, 'update', $model->id);
                    if ($media_type == 'slider2')
                        OstAuditTrail::model()->insertlog(332, 'update', $model->id);
                    if ($media_type == 'video')
                        OstAuditTrail::model()->insertlog(17, 'update', $model->id);
                    if ($media_type == 'audio')
                        OstAuditTrail::model()->insertlog(18, 'update', $model->id);
                    if ($media_type == 'slider')
                        OstAuditTrail::model()->insertlog(19, 'update', $model->id);
                    if ($media_type == 'online')
                        OstAuditTrail::model()->insertlog(13, 'update', $model->id);

                    $this->redirect("index.php?r=ostMedia/admin&media_type=" . $model->media_type);
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
    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->media_type = $_GET['media_type'];
        $media_type = $_GET['media_type'];
        if ($model->media_type === '') {
            OstAuditTrail::model()->insertlog(15, 'delete', $model->id);
            $this->redirect("index.php?r=ostMedia/admin");
        } else {
            if ($media_type === 'background')
                OstAuditTrail::model()->insertlog(331, 'delete', $model->id);
            if ($media_type === 'slider2')
                OstAuditTrail::model()->insertlog(332, 'delete', $model->id);
            if ($media_type === 'video')
                OstAuditTrail::model()->insertlog(17, 'delete', $model->id);
            if ($media_type === 'audio')
                OstAuditTrail::model()->insertlog(18, 'delete', $model->id);
            if ($media_type === 'slider')
                OstAuditTrail::model()->insertlog(19, 'delete', $model->id);
            if ($media_type === 'online')
                OstAuditTrail::model()->insertlog(13, 'delete', $model->id);

            $this->loadModel($id)->delete();
            OstMedia::model()->deleteAllByAttributes(array('parent_id' => $id));

            $this->redirect("index.php?r=ostMedia/admin&media_type=" . $model->media_type);
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('OstMedia');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new OstMedia('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OstMedia']))
            $model->attributes = $_GET['OstMedia'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return OstMedia the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = OstMedia::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param OstMedia $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ost-media-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionArchive($id, $media_type = '') {

        OstMedia::model()->updateByPk($id, array('status' => 'arc'));

        if ($media_type == '')
            $this->redirect("index.php?r=ostMedia/admin");
        else
            $this->redirect("index.php?r=ostMedia/admin&media_type=" . $media_type);
    }
    
    public function actionUnarchive($id, $media_type = '') {

        OstMedia::model()->updateByPk($id, array('status' => 'psh'));

        if ($media_type == '')
            $this->redirect("index.php?r=ostMedia/admin");
        else
            $this->redirect("index.php?r=ostMedia/admin&media_type=" . $media_type);
    }

}
