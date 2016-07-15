<?php

class OstUserController extends CmsController {

    public function actionCreate() {

        $model = new OstUser;

        if (isset($_POST['OstUser'])) {

            $model->attributes = $_POST['OstUser'];

            if ($_POST['OstUser']['pwd'] != '')
                $model->pwd = md5($_POST['OstUser']['pwd']);

            if ($model->save()) {

                if (isset($_POST['role_code2']))
                    $role_arr = array_merge($_POST['role_code'], $_POST['role_code2']);
                else
                    $role_arr = $_POST['role_code'];

                foreach ($role_arr as $arr) {

                    if ($arr != '') {

                        $model2 = new OstUserRole;

                        $model2->user_id = $model->id;

                        $model2->role_code = $arr;

                        $model2->save();
                    }
                }

                OstAuditTrail::model()->insertlog(6, 'create', $model->id);

                $this->redirect("index.php?r=ostUser/admin");
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {

        $model = $this->loadModel($id);

        $pwd = $model->pwd;

        if (isset($_POST['OstUser'])) {

            $model->attributes = $_POST['OstUser'];

            if ($_POST['OstUser']['pwd'] != '')
                $model->pwd = md5($_POST['OstUser']['pwd']);
            else
                $model->pwd = $pwd;

            if ($model->save()) {

                OstUserRole::model()->deleteAllByAttributes(array('user_id' => $id));

                if (isset($_POST['role_code2']))
                    $role_arr = array_merge($_POST['role_code'], $_POST['role_code2']);
                else
                    $role_arr = $_POST['role_code'];

                foreach ($role_arr as $arr) {

                    if ($arr != '') {

                        $model2 = new OstUserRole;

                        $model2->user_id = $model->id;

                        $model2->role_code = $arr;

                        $model2->save();
                    }
                }

                OstAuditTrail::model()->insertlog(6, 'update', $id);

                $this->redirect("index.php?r=ostUser/admin");
            }
        }

        $this->render('update', array('model' => $model,));
    }

    public function actionDelete($id) {

        OstAuditTrail::model()->insertlog(6, 'delete', $id);

        OstUserRole::model()->deleteAllByAttributes(array('user_id' => $id));

        $this->loadModel($id)->delete();

        $this->redirect("index.php?r=ostUser/admin");
    }

    public function actionAdmin() {

        $model = new OstUser('search');

        $model->unsetAttributes();

        if (isset($_GET['OstUser']))
            $model->attributes = $_GET['OstUser'];

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id) {

        $model = OstUser::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        return $model;
    }

    protected function performAjaxValidation($model) {

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ost-user-form') {

            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

}
