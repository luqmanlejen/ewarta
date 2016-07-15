<?php

class OstMenuPortalController extends CmsController {

    public function actionCreate() {

        $model = new OstMenuPortal;

        $model2 = new OstMenuPortal;

        $model->menu_type = 'header';

        if (isset($_POST['OstMenuPortal'])) {

            $model->attributes = $_POST['OstMenuPortal'];

            if ($model->save()) {

                //masukkan translation

                $model2->title = $_POST['title_my'];

                $model2->parent_lang = $model->id;

                $model2->lang = 'my';

                $model2->save(false);

                //masukkan role

                if (isset($_POST['role_code']) && sizeof($_POST['role_code']) > 0) {

                    foreach ($_POST['role_code'] as $role_code) {

                        $model3 = new OstMenuAccess;

                        $model3->menu_id = $model->id;

                        $model3->role_code = $role_code;

                        $model3->save();
                    }
                }

                OstAuditTrail::model()->insertlog(8, 'create', $model->id);

                $this->redirect("index.php?r=ostMenuPortal/admin");
            }
        }

        $this->render('create', array('model' => $model, 'model2' => $model2));
    }

    public function actionUpdate($id) {

        $model = $this->loadModel($id);

        $model2 = OstMenuPortal::model()->findByAttributes(array('parent_lang' => $id));

        if (isset($_POST['OstMenuPortal'])) {

            $model->attributes = $_POST['OstMenuPortal'];

            if ($model->save()) {

                OstMenuPortal::model()->updateByPk($model2->id, array('title' => $_POST['title_my']));

                OstMenuAccess::model()->deleteAllByAttributes(array('menu_id' => $id));

                if (isset($_POST['role_code']) && sizeof($_POST['role_code']) > 0) {

                    foreach ($_POST['role_code'] as $role_code) {

                        $model3 = new OstMenuAccess;

                        $model3->menu_id = $model->id;

                        $model3->role_code = $role_code;

                        $model3->save();
                    }
                }

                OstAuditTrail::model()->insertlog(8, 'update', $id);

                $this->redirect("index.php?r=ostMenuPortal/admin");
            }
        }

        $this->render('update', array('model' => $model, 'model2' => $model2));
    }

    public function actionDelete($id) {

        OstAuditTrail::model()->insertlog(8, 'delete', $id);

        OstMenuAccess::model()->deleteAllByAttributes(array('menu_id' => $id));

        OstMenuPortal::model()->deleteAllByAttributes(array('parent_lang' => $id));

        $this->loadModel($id)->delete();

        $this->redirect("index.php?r=ostMenuPortal/admin");
    }

    public function actionAdmin() {

        $model = new OstMenuPortal('search');

        $model->unsetAttributes();

        if (isset($_GET['OstMenuPortal']))
            $model->attributes = $_GET['OstMenuPortal'];

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id) {

        $model = OstMenuPortal::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        return $model;
    }

    protected function performAjaxValidation($model) {

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ost-menu-portal-form') {

            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

    public function actionChangeparent() {

        $menu_type = $_POST['OstMenuPortal']['menu_type'];

        echo CHtml::dropdownlist('OstMenuPortal[parent_menu]', '', OstMenuPortal::model()->getparent($menu_type), array('class' => 'col-sm-7'));
    }

}