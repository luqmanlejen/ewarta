<?php

class OstPuController extends CmsController {

    public function actionCreate() {
        $model = new OstPu;
        $model3 = new OstPuRefAct;
        $model4 = new OstPuReplace;
        $model5 = new OstPuRefAct;

        if (isset($_POST['OstPu'])) {
            $model->attributes = $_POST['OstPu'];
            if (isset($_POST['date_proclamation']) && $_POST['date_proclamation'] != '') {
                echo $model->date_proclamation = $_POST['date_proclamation'];
            } else {
                $model->date_proclamation = '0000-00-00';
            }
            if (isset($_POST['date_received']) && $_POST['date_received'] != '') {
                echo $model->date_received = $_POST['date_received'];
            } else {
                $model->date_received = '0000-00-00';
            }
            $model->officer_maker_id = Yii::app()->session['user_id'];
            
            OstAuditTrail::model()->insertlog(8, 'create', $model->id);
            
            if ($model->save()) {
                if (isset($_POST['pdf_add'])) {
                    if (sizeof($_POST['pdf_add']) > 0) {
                        //echo $_POST['doc_count'];
                        foreach ($_POST['pdf_add'] as $x) {
                            if ($x != '') {
                                $model2 = new OstPuDocument;
                                $model2->pu_id = $model->id;
                                $model2->doc_type = 1;
                                $model2->document = $x;
                                $model2->save();
                            }
                        }
                    }
                }
                if (isset($_POST['word_add'])) {
                    if (sizeof($_POST['word_add']) > 0) {
                        //echo $_POST['doc_count'];
                        foreach ($_POST['word_add'] as $x) {
                            if ($x != '') {
                                $model2 = new OstPuDocument;
                                $model2->pu_id = $model->id;
                                $model2->doc_type = 2;
                                $model2->document = $x;
                                $model2->save();
                            }
                        }
                    }
                }
                $arr = [];
                $arr2 = [];
                $arr2_act = [];
                $count = -1;
                $count_act = -1;
                $count2 = 0;
                $count2_act = 0;
                $loop = 0;
                $loop_act = 0;
                if (isset($_POST['related_act_add'])) {
                    if (sizeof($_POST['related_act_add']) > 0) {
                        //echo $_POST['doc_count'];
                        foreach ($_POST['related_act_add'] as $x) {
                            $pu_type = OstRefList::model()->findByAttributes(array('cat_id' => 4, 'label' => "$x"));
                            if ($x != '' && sizeof($pu_type) != 1) {
                                $arr2_act[$count2_act] = $x;
                                $count2_act++;
                            } else {
                                $arr[$count_act] = $x;
                                $count_act++;
                            }
                        }
                        while ($loop_act < (sizeof($arr) - 1)) {
                            $model5 = new OstPuRefAct;
                            if ($arr[$loop_act] == 'Act') {
                                $model_pu_type = OstAct::model()->findByAttributes(array('act_name_bi' => "$arr2_act[$loop_act]"));
                            }
                            if ($arr[$loop_act] == 'Amending Act') {
                                $model_pu_type = OstAmendingAct::model()->findByAttributes(array('act_name_bi' => "$arr2_act[$loop_act]"));
                            }
                            if ($arr[$loop_act] == 'Pu') {
                                $model_pu_type = OstPu::model()->findByAttributes(array('act_name_bi' => "$arr2_act[$loop_act]"));
                            }
                            if ($arr[$loop_act] == 'Other Law') {
                                $model_pu_type = OstPerundangan::model()->findByAttributes(array('act_name_bi' => "$arr2_act[$loop_act]"));
                            }
                            $model5->tbl_ref = $arr[$loop_act];
                            $model5->ref_id = $model->id;
                            $model5->pu_id = $model_pu_type->id;
                            $model5->save();
                            $loop_act++;
                        }
                    }
                }
                if (isset($_POST['replace_pu_add'])) {
                    if (sizeof($_POST['replace_pu_add']) > 1) {
                        foreach ($_POST['replace_pu_add'] as $x) {
                            $arr[$count] = $x;
                            $count++;
                        }
                        while ($loop < (sizeof($arr) - 1)) {
                            $model4 = new OstPuReplace;


                            $model_pu_type = OstPu::model()->findByAttributes(array('sub_act_name_bi' => "$arr[$loop]"));

                            $model4->replacee_id = $model->id;
                            $model4->replacee_by = $model_pu_type->id;
                            $model4->save();
                            $loop++;
                        }
                    }
                }
                $this->redirect(array('admin', 'id' => $model->id));
            }
        }
        $this->render('create', array(
            'model' => $model, 'model3' => $model3, 'model4' => $model4, 'model5' => $model5
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model2 = OstPuDocument::model()->findAll(array('condition' => "pu_id=$model->id"));
        $model3 = OstPuRefAct::model()->findByAttributes(array('ref_id' => $id));
        $model4 = OstPuReplace::model()->findByAttributes(array('replacee_id' => $model->id));
        $model5 = OstPuRefAct::model()->findByAttributes(array('ref_id' => $id));

        if (isset($_POST['OstPu'])) {
            $model->attributes = $_POST['OstPu'];
            if (isset($_POST['date_proclamation']) && $_POST['date_proclamation'] != '') {
                $model->date_proclamation = $_POST['date_proclamation'];
            } else {
                $model->date_proclamation = '0000-00-00';
            }
            if (isset($_POST['date_received']) && $_POST['date_received'] != '') {
                $model->date_received = $_POST['date_received'];
            } else {
                $model->date_received = '0000-00-00';
            }
            $model->officer_maker_id = Yii::app()->session['user_id'];


            $replace_count = 0;
            if (isset($_POST['replace_pu_add']) && sizeof($_POST['replace_pu_add']) > 0) {
                OstPuReplace::model()->deleteAllByAttributes(array('replacee_id' => $model->id));
                while($replace_count < sizeof($_POST['replace_pu_add'])){
                    $model4 = new OstPuReplace;
                    if($_POST['replace_pu_add'][$replace_count] != ''){
                        $model4->replacee_id = $model->id;
                        $replace_pu = OstPu::model()->findByAttributes(array('sub_act_name_bi'=> $_POST['replace_pu_add'][$replace_count]));
                        $model4->replacee_by = $replace_pu['id'];
                        $model4->save();
                    }
                    $replace_count++;
                }
            }
            
            if ($model->save()) {
                if (isset($_POST['pdf_add'])) {
                    if (sizeof($_POST['pdf_add']) > 0) {
                        //echo $_POST['doc_count'];
                        foreach ($_POST['pdf_add'] as $x) {
                            if ($x != '') {
                                $model2 = new OstPuDocument;
                                $model2->pu_id = $model->id;
                                $model2->doc_type = 1;
                                $model2->document = $x;
                                $model2->save();
                            }
                        }
                    }
                }
                if (isset($_POST['word_add'])) {
                    if (sizeof($_POST['word_add']) > 0) {
                        //echo $_POST['doc_count'];
                        foreach ($_POST['word_add'] as $x) {
                            if ($x != '') {
                                $model2 = new OstPuDocument;
                                $model2->pu_id = $model->id;
                                $model2->doc_type = 2;
                                $model2->document = $x;
                                $model2->save();
                            }
                        }
                    }
                }

                $type_list = [];
                $count_type = 0;
                $act_list = [];
                $count_act = 0;
                $count = 0;
                if (isset($_POST['related_act_add']) && sizeof($_POST['related_act_add']) > 0) {
                    while ($count < sizeof($_POST['related_act_add'])) {
                        if ($_POST['related_act_add'][$count] == 'Act' ||
                                $_POST['related_act_add'][$count] == 'Amending Act' ||
                                $_POST['related_act_add'][$count] == 'PU' ||
                                $_POST['related_act_add'][$count] == 'Other Law') {
                            $type_list[$count_type++] = $_POST['related_act_add'][$count];
                        } else {
                            if ($_POST['related_act_add'][$count] != '') {
                                $act_list[$count_act++] = $_POST['related_act_add'][$count];
                            }
                        }
                        $count++;
                    }
                    $loop = 0;
                    OstPuRefAct::model()->deleteAllByAttributes(array('ref_id' => $model->id));

                    while ($loop < $count_act) {
                        echo $type_list[$loop];
                        $model5 = new OstPuRefAct;
                        $model5->tbl_ref = $type_list[$loop];
                        $model5->ref_id = $model->id;

                        if ($type_list[$loop] == 'Act') {
                            $pu_id = OstAct::model()->findByAttributes(array('act_name_bi' => $act_list[$loop]));
                            $model5->pu_id = $pu_id->id;
                        }
                        if ($type_list[$loop] == 'Amending Act') {
                            $pu_id = OstAmendingAct::model()->findByAttributes(array('act_name_bi' => $act_list[$loop]));
                            $model5->pu_id = $pu_id->id;
                        }
                        if ($type_list[$loop] == 'PU') {
                            $pu_id = OstPu::model()->findByAttributes(array('sub_act_name_bi' => $act_list[$loop]));
                            $model5->pu_id = $pu_id->id;
                        }
                        if ($type_list[$loop] == 'Other Law') {
                            $pu_id = OstPerundangan::model()->findByAttributes(array('act_name_bi' => $act_list[$loop]));
                            $model5->pu_id = $pu_id->id;
                        }
                        $model5->save();
                        $loop++;
                    }
                }
                $this->redirect(array('admin', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model, 'model2' => $model2, 'model3' => $model3, 'model4' => $model4, 'model5' => $model5
        ));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }
    
    public function actionFlagDelete($id) {
        $model = new OstPu('search');
        $del = OstPu::model()->findByPk($id);
        
        if (isset($_GET['OstAct']))
            $model->attributes = $_GET['OstAct'];
        
        OstPu::model()->updateByPk($del->id, array('isactive' => 0));
        OstAuditTrail::model()->insertlog(11, 'delete', $model->id);
        //$this->render('admin', array('model' => $model,));
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('OstPu');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new OstPu('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OstPu']))
            $model->attributes = $_GET['OstPu'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = OstPu::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ost-pu-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionChangeParent() {
        $ref = $_POST['tbl_ref'];
        if ($ref == 'ost_act') {
            echo CHtml::dropdownlist('related_act', '', OstAct::model()->displayActList(), array('class' => 'col-sm-12', 'prompt' => '-- Please Choose --'));
        } else if ($ref == 'ost_amending_act') {
            echo CHtml::dropdownlist('related_act', '', OstAmendingAct::model()->displayActList2(), array('class' => 'col-sm-12', 'prompt' => '-- Please Choose --'));
        } else if ($ref == 'ost_pu') {
            echo CHtml::dropdownlist('related_act', '', OstPu::model()->displayActList(), array('class' => 'col-sm-12', 'prompt' => '-- Please Choose --'));
        } else if ($ref == 'ost_perundangan') {
            echo CHtml::dropdownlist('related_act', '', OstPerundangan::model()->displayActList(), array('class' => 'col-sm-12', 'prompt' => '-- Please Choose --'));
        }
    }
    
    public function actionView($id) {
        $model = $this->loadModel($id);
        $model2 = OstPuDocument::model()->findAll(array('condition' => "pu_id=$model->id"));
        $model3 = OstPuRefAct::model()->findByAttributes(array('ref_id' => $id));
        $model4 = OstPuReplace::model()->findByAttributes(array('replacee_id' => $model->id));
        $model5 = OstPuRefAct::model()->findByAttributes(array('ref_id' => $id));

        if (isset($_POST['OstPu'])) {
            $model->attributes = $_POST['OstPu'];
            if (isset($_POST['date_proclamation']) && $_POST['date_proclamation'] != '') {
                $model->date_proclamation = $_POST['date_proclamation'];
            } else {
                $model->date_proclamation = '0000-00-00';
            }
            if (isset($_POST['date_received']) && $_POST['date_received'] != '') {
                $model->date_received = $_POST['date_received'];
            } else {
                $model->date_received = '0000-00-00';
            }
            $model->officer_maker_id = Yii::app()->session['user_id'];


            $replace_count = 0;
            if (isset($_POST['replace_pu_add']) && sizeof($_POST['replace_pu_add']) > 0) {
                OstPuReplace::model()->deleteAllByAttributes(array('replacee_id' => $model->id));
                while($replace_count < sizeof($_POST['replace_pu_add'])){
                    $model4 = new OstPuReplace;
                    if($_POST['replace_pu_add'][$replace_count] != ''){
                        $model4->replacee_id = $model->id;
                        $replace_pu = OstPu::model()->findByAttributes(array('sub_act_name_bi'=> $_POST['replace_pu_add'][$replace_count]));
                        $model4->replacee_by = $replace_pu['id'];
                        $model4->save();
                    }
                    $replace_count++;
                }
            }
            
            if ($model->save()) {
                if (isset($_POST['pdf_add'])) {
                    if (sizeof($_POST['pdf_add']) > 0) {
                        //echo $_POST['doc_count'];
                        foreach ($_POST['pdf_add'] as $x) {
                            if ($x != '') {
                                $model2 = new OstPuDocument;
                                $model2->pu_id = $model->id;
                                $model2->doc_type = 1;
                                $model2->document = $x;
                                $model2->save();
                            }
                        }
                    }
                }
                if (isset($_POST['word_add'])) {
                    if (sizeof($_POST['word_add']) > 0) {
                        //echo $_POST['doc_count'];
                        foreach ($_POST['word_add'] as $x) {
                            if ($x != '') {
                                $model2 = new OstPuDocument;
                                $model2->pu_id = $model->id;
                                $model2->doc_type = 2;
                                $model2->document = $x;
                                $model2->save();
                            }
                        }
                    }
                }

                $type_list = [];
                $count_type = 0;
                $act_list = [];
                $count_act = 0;
                $count = 0;
                if (isset($_POST['related_act_add']) && sizeof($_POST['related_act_add']) > 0) {
                    while ($count < sizeof($_POST['related_act_add'])) {
                        if ($_POST['related_act_add'][$count] == 'Act' ||
                                $_POST['related_act_add'][$count] == 'Amending Act' ||
                                $_POST['related_act_add'][$count] == 'PU' ||
                                $_POST['related_act_add'][$count] == 'Other Law') {
                            $type_list[$count_type++] = $_POST['related_act_add'][$count];
                        } else {
                            if ($_POST['related_act_add'][$count] != '') {
                                $act_list[$count_act++] = $_POST['related_act_add'][$count];
                            }
                        }
                        $count++;
                    }
                    $loop = 0;
                    OstPuRefAct::model()->deleteAllByAttributes(array('ref_id' => $model->id));

                    while ($loop < $count_act) {
                        echo $type_list[$loop];
                        $model5 = new OstPuRefAct;
                        $model5->tbl_ref = $type_list[$loop];
                        $model5->ref_id = $model->id;

                        if ($type_list[$loop] == 'Act') {
                            $pu_id = OstAct::model()->findByAttributes(array('act_name_bi' => $act_list[$loop]));
                            $model5->pu_id = $pu_id->id;
                        }
                        if ($type_list[$loop] == 'Amending Act') {
                            $pu_id = OstAmendingAct::model()->findByAttributes(array('act_name_bi' => $act_list[$loop]));
                            $model5->pu_id = $pu_id->id;
                        }
                        if ($type_list[$loop] == 'PU') {
                            $pu_id = OstPu::model()->findByAttributes(array('sub_act_name_bi' => $act_list[$loop]));
                            $model5->pu_id = $pu_id->id;
                        }
                        if ($type_list[$loop] == 'Other Law') {
                            $pu_id = OstPerundangan::model()->findByAttributes(array('act_name_bi' => $act_list[$loop]));
                            $model5->pu_id = $pu_id->id;
                        }
                        $model5->save();
                        $loop++;
                    }
                }
                $this->redirect(array('admin', 'id' => $model->id));
            }
        }

        $this->render('view', array(
            'model' => $model, 'model2' => $model2, 'model3' => $model3, 'model4' => $model4, 'model5' => $model5
        ));
    }
    
    public function actionDownload($id){
        $model = OstPu::model()->findByPk($id);
        //$url = Yii::app()->baseUrl."/uploads/files/lorem_ipsum_pdf.pdf";
        //print_r($model->act_name_bi);
        
//        if(Yii::app()->session['lang'] == 'my'){
            if($model->doc_name_pdf != ''){
                $file = "..".Yii::app()->baseUrl."/uploads/files/amending_act/$model->doc_name_pdf";
                if(file_exists("$file")){
                    $model->file_url = Yii::app()->getRequest()->sendFile($model->doc_name_pdf, file_get_contents('http://' . $_SERVER['HTTP_HOST'] . str_replace(' ','%20',Yii::app()->baseUrl."/uploads/files/act/$model->doc_name_pdf")));
                    OstPu::model()->updateByPk($model->id, array('hits' => $model->hits+1));
                } else {
                    Yii::app()->user->setFlash('alert', OstRefList::model()->getTranslation("error"));
                }
            } else {
                Yii::app()->user->setFlash('alert', OstRefList::model()->getTranslation("error"));
            }
//        } 

        //$model->file_url = Yii::app()->getRequest()->sendFile($url, file_get_contents('http://' . $_SERVER['HTTP_HOST'] . str_replace(' ','%20',$url)));
//        $this->redirect('index.php?r=portal/actList');
        $this->redirect(Yii::app()->request->urlReferrer);
    }   
    
}

//0192590326