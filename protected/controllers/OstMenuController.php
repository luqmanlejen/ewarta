<?php

class OstMenuController extends Controller {

    public function init() {
        parent::init();
        Yii::app()->theme = "admin";
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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new OstMenu;
        $model2 = new OstMenuAccess;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);


        if (isset($_POST['OstMenu'])) {
            $model->attributes = $_POST['OstMenu'];
            $model->menu_type = 'cms';
            $model->parent_lang = '0';
            $model->lang = 'en';
            $model->hide_ind = '0';
            if ($_POST['OstMenu']['parent_menu'] == '') {
                $model->parent_menu = 0;
            }
            if ($model->save()) {
                if (isset($_POST['OstMenuAccess']['role_code'])) {
                    $role_arr = $_POST['OstMenuAccess']['role_code'];
                    foreach ($role_arr as $arr) {
                        $model2 = new OstMenuAccess;
                        $model2->role_code = $arr;
                        $model2->menu_id = $model->id;
                        $model2->save();
                    }
                }
                OstAuditTrail::model()->insertlog(3, 'create', $model->id);
                $this->redirect(array('admin', 'id' => $model->id));
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
        $model2 = new OstMenuAccess;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['OstMenu'])) {
            $model->attributes = $_POST['OstMenu'];
            $model->menu_type = 'cms';
            $model->parent_lang = '0';
            $model->lang = 'en';
            $model->hide_ind = '0';
            if ($_POST['OstMenu']['parent_menu'] == '') {
                $model->parent_menu = 0;
            }
            if ($model->save()) {
                OstMenuAccess::model()->deleteAllByAttributes(array('menu_id' => $id));
                if (isset($_POST['OstMenuAccess']['role_code'])) {
                    $role_arr = $_POST['OstMenuAccess']['role_code'];
                    foreach ($role_arr as $arr) {
                        $model2 = new OstMenuAccess;
                        $model2->role_code = $arr;
                        $model2->menu_id = $model->id;
                        $model2->save();
                    }
                }
                OstAuditTrail::model()->insertlog(3, 'update', $id);
                $this->redirect(array('admin', 'id' => $model->id));
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
        OstAuditTrail::model()->insertlog(3, 'delete', $id);
        OstMenuAccess::model()->deleteAllByAttributes(array('menu_id' => $id));
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('OstMenu');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new OstMenu('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OstMenu']))
            $model->attributes = $_GET['OstMenu'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return OstMenu the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = OstMenu::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param OstMenu $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ost-menu-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
