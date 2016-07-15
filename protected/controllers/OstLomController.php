<?php

class OstLomController extends CmsController {

    public function actionCreate() {
        $model = new OstLom;
        $model2 = new OstLom;

        if (isset($_POST['OstLom'])) {
            $model->attributes = $_POST['OstLom'];
            $model->lom_parent_lang = '0';
            $model->lom_lang = 'en';

            if ($model->save()) {
                $model2->lom_title = $_POST['lom_title_my'];
                $model2->lom_parent_lang = $model->id;
                $model2->lom_doc = $_POST['lom_doc_my'];
                $model2->lom_lang = 'my';
                $model2->lom_no = $model->lom_no;
                $model2->save(false);
                OstAuditTrail::model()->insertlog(21, 'create', $model->id);
                $this->redirect("index.php?r=ostLom/admin");
            }
        }

        $this->render('create', array('model' => $model, 'model2' => $model2,));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model2 = OstLom::model()->findByAttributes(array('lom_parent_lang' => $id));

        if (isset($_POST['OstLom'])) {
            $model->attributes = $_POST['OstLom'];
            
            if ($model->save()) {
                $model2->lom_title = $_POST['lom_title_my'];
                $model2->lom_parent_lang = $model->id;
                $model2->lom_doc = $_POST['lom_doc_my'];
                $model2->lom_lang = 'my';
                $model2->lom_no = $model->lom_no;
                $model2->save(false);
                OstAuditTrail::model()->insertlog(21, 'update', $model->id);
                $this->redirect("index.php?r=ostLom/admin");
            }
        }

        $this->render('update', array('model' => $model, 'model2' => $model2,));
    }

    public function actionDelete($id) {
        OstAuditTrail::model()->insertlog(21, 'delete', $id);
        OstLom::model()->deleteAllByAttributes(array('lom_parent_lang' => $id));
        $this->loadModel($id)->delete();
        $this->redirect("index.php?r=OstLom/admin");
    }

    public function actionAdmin() {
        $model = new OstLom('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OstLom']))
            $model->attributes = $_GET['OstLom'];

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id) {
        $model = OstLom::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ost-lom-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGetactname() {

        $output = '';

        $lom_no = $_POST['lom_no'];

        if ($lom_no != '') {

            $output = OstLom::model()->getactname($lom_no);
        }

        echo $output;
    }
    
    public function actionChangeparent() {

        $parent_cat = $_POST['OstCategoies']['parent_cat'];

        echo CHtml::dropdownlist('OstLom[parent_cat]', '', OstLom::model()->getparent3($parent_cat), array('class' => 'col-sm-7'));
    }
    
    public function actionCount(){
        $model = new OstLom;
        $this->render('count', array('model' => $model));
    }
}
