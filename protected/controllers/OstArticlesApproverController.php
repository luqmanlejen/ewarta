<?php

class OstArticlesApproverController extends CmsController {

    public function actionUpdate($id) {

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

                OstArticlesStatus::model()->insertlog($model->id, $model->approval_sts);

                OstAuditTrail::model()->insertlog(27, $model->approval_sts, $model->id);

                $this->redirect("index.php?r=ostArticlesApprover/admin");
            }
        }

        $this->render('update', array('model' => $model, 'model2' => $model2));
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

}