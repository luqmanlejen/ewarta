<?php

class OstArticlesController extends CmsController {

    public function actionCreate($menu_id = '') {

        $model = new OstArticles;

        $model2 = new OstArticles;

        if (isset($_POST['OstArticles'])) {

            $model->attributes = $_POST['OstArticles'];

            if ($_POST['OstArticles']['menu_id'] != 0)
                $model->menu_id = $_POST['OstArticles']['menu_id'];
            else
                $model->menu_id = '';

            /* Display Date Range */
            if ($_POST['OstArticles']['display_type'] == 't') {
                $daterange_explode = explode(' - ', $_POST['daterange']);
                $display_startdt_exp = explode('/', $daterange_explode[0]);
                $display_enddt = explode('/', $daterange_explode[1]);
                $model->display_startdt = $display_startdt_exp[2] . '-' . $display_startdt_exp[1] . '-' . $display_startdt_exp[0] . ' 00:00:00';
                $model->display_enddt = $display_enddt[2] . '-' . $display_enddt[1] . '-' . $display_enddt[0] . ' 00:00:00';
            }

            /* Approval Status */
            if ($model->chckmenuapprovalsts($_POST['OstArticles']['menu_id']) == 'n')
                $model->approval_sts = 'publish';
            if ($model->chckmenuapprovalsts($_POST['OstArticles']['menu_id']) == 'y')
                $model->approval_sts = 'draft';

            if ($model->save()) {

                $model2->title = $_POST['title_my'];
                $model2->content = $_POST['content_my'];
                $model2->parent_id = $model->id;
                $model2->lang = 'my';
                $model2->approval_sts = '';
                $model2->display_type = '';
                $model2->save(false);

                OstArticlesStatus::model()->insertlog($model->id, $model->approval_sts);

                if ($menu_id == '') {
                    OstAuditTrail::model()->insertlog(9, 'create', $model->id);
                    $this->redirect("index.php?r=ostArticles/admin");
                } else {
                    if ($menu_id == '192')
                        OstAuditTrail::model()->insertlog(10, 'create', $model->id);

                    if ($menu_id == '190')
                        OstAuditTrail::model()->insertlog(11, 'create', $model->id);

                    if ($menu_id == '194')
                        OstAuditTrail::model()->insertlog(12, 'create', $model->id);

                    $this->redirect("index.php?r=ostArticles/admin&menu_id=" . $menu_id);
                }
            }
        }

        $this->render('create', array('model' => $model, 'model2' => $model2));
    }

    public function actionUpdate($id, $menu_id = '') {

        $model = $this->loadModel($id);

        $model2 = OstArticles::model()->findByAttributes(array('parent_id' => $id));

        if (isset($_POST['OstArticles'])) {

            $model->attributes = $_POST['OstArticles'];

            if ($_POST['OstArticles']['menu_id'] != 0)
                $model->menu_id = $_POST['OstArticles']['menu_id'];
            else
                $model->menu_id = '';

            /* Display Date Range */
            if ($_POST['OstArticles']['display_type'] == 't') {
                $daterange_explode = explode(' - ', $_POST['daterange']);
                $display_startdt_exp = explode('/', $daterange_explode[0]);
                $display_enddt = explode('/', $daterange_explode[1]);
                $model->display_startdt = $display_startdt_exp[2] . '-' . $display_startdt_exp[1] . '-' . $display_startdt_exp[0] . ' 00:00:00';
                $model->display_enddt = $display_enddt[2] . '-' . $display_enddt[1] . '-' . $display_enddt[0] . ' 00:00:00';
            }

            if ($model->save()) {

                OstArticles::model()->updateByPk($model2->id, array('title' => $_POST['title_my'], 'content' => $_POST['content_my']));

                if ($menu_id == '') {
                    OstAuditTrail::model()->insertlog(9, 'update', $model->id);
                    $this->redirect("index.php?r=ostArticles/admin");
                } else {
                    if ($menu_id == '192')
                        OstAuditTrail::model()->insertlog(10, 'update', $model->id);

                    if ($menu_id == '190')
                        OstAuditTrail::model()->insertlog(11, 'update', $model->id);

                    if ($menu_id == '194')
                        OstAuditTrail::model()->insertlog(12, 'update', $model->id);

                    $this->redirect("index.php?r=ostArticles/admin&menu_id=" . $menu_id);
                }
            }
        }

        $this->render('update', array('model' => $model, 'model2' => $model2));
    }

    public function actionDelete($id, $menu_id = '') {

        $this->loadModel($id)->delete();

        OstArticles::model()->deleteAllByAttributes(array('parent_id' => $id));

        if ($menu_id == '') {

            OstAuditTrail::model()->insertlog(9, 'delete', $id);

            $this->redirect("index.php?r=ostArticles/admin");
        } else {

            if ($menu_id == '192')
                OstAuditTrail::model()->insertlog(10, 'delete', $id);

            if ($menu_id == '190')
                OstAuditTrail::model()->insertlog(11, 'delete', $id);

            if ($menu_id == '194')
                OstAuditTrail::model()->insertlog(12, 'delete', $id);

            $this->redirect("index.php?r=ostArticles/admin&menu_id=" . $menu_id);
        }
    }

    public function actionSendforapproval($id, $menu_id = '') {

        OstArticles::model()->updateByPk($id, array('approval_sts' => 'pending'));

        OstArticlesStatus::model()->insertlog($id, 'pending');

        if ($menu_id == '')
            $this->redirect("index.php?r=ostArticles/admin");
        else
            $this->redirect("index.php?r=ostArticles/admin&menu_id=" . $menu_id);
    }

    public function actionArchive($id, $menu_id = '') {

        OstArticles::model()->updateByPk($id, array('approval_sts' => 'archive'));

        OstArticlesStatus::model()->insertlog($id, 'archive');

        if ($menu_id == '')
            $this->redirect("index.php?r=ostArticles/admin");
        else
            $this->redirect("index.php?r=ostArticles/admin&menu_id=" . $menu_id);
    }

    public function actionUnarchive($id, $menu_id = '') {

        OstArticles::model()->updateByPk($id, array('approval_sts' => 'publish'));

        OstArticlesStatus::model()->insertlog($id, 'publish');

        if ($menu_id == '')
            $this->redirect("index.php?r=ostArticles/admin");
        else
            $this->redirect("index.php?r=ostArticles/admin&menu_id=" . $menu_id);
    }

    public function actionIndex() {

        $dataProvider = new CActiveDataProvider('OstArticles');

        $this->render('index', array('dataProvider' => $dataProvider,));
    }

    public function actionAdmin() {

        $model = new OstArticles('search');

        $model->unsetAttributes();

        if (isset($_GET['OstArticles']))
            $model->attributes = $_GET['OstArticles'];

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id) {

        $model = OstArticles::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        return $model;
    }

    protected function performAjaxValidation($model) {

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ost-articles-form') {

            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

    public function actionChangeparent() {

        $menu_type = $_POST['menu_type'];

        if (OstArticles::model()->chckdvsn() == 'n')
            echo CHtml::dropdownlist('OstArticles[menu_id]', '', OstMenuPortal::model()->getparent($menu_type), array('class' => 'col-sm-12'));
        if (OstArticles::model()->chckdvsn() == 'y')
            echo CHtml::dropdownlist('OstArticles[menu_id]', '', OstMenuPortal::model()->getparentfordvsn($menu_type), array('class' => 'col-sm-12'));
    }

}
