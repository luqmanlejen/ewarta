<?php

class OstAmendingActController extends CmsController {

    public function actionCreate() {
        $model = new OstAmendingAct;

        if (isset($_POST['OstAmendingAct'])) {
            $model->attributes = $_POST['OstAmendingAct'];
                    
            if (isset($_POST['date_proclamation']) && $_POST['date_proclamation'] != '') {
                $model->date_proclamation = $_POST['date_proclamation'];
            } else {
                $model->date_proclamation = '0000-00-00';
            }

            if (isset($_POST['date_consent']) && $_POST['date_consent'] != '') {
                $model->date_consent = $_POST['date_consent'];
            } else {
                $model->date_consent = '0000-00-00';
            }

            if (isset($_POST['date_effective']) && $_POST['date_effective'] != '') {
                $model->date_effective = $_POST['date_effective'];
            } else {
                $model->date_effective = '0000-00-00';
            }

            if (isset($_POST['date_received']) && $_POST['date_received'] != '') {
                $model->date_received = $_POST['date_received'];
            } else {
                $model->date_received = '0000-00-00';
            }

            $model->user_id = Yii::app()->session['user_id'];
            $model->tbl_ref = $_POST['tbl_ref'];
            $model->id_ref = $_POST['id_ref'];
            
            OstAuditTrail::model()->insertlog(9, 'create', $model->id);
            
            if ($model->save())
                $this->redirect(array('admin', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['OstAmendingAct'])) {
            $model->attributes = $_POST['OstAmendingAct'];

            if (isset($_POST['date_proclamation']) && $_POST['date_proclamation'] != '') {
                $model->date_proclamation = $_POST['date_proclamation'];
            } else {
                $model->date_proclamation = '0000-00-00';
            }

            if (isset($_POST['date_consent']) && $_POST['date_consent'] != '') {
                $model->date_consent = $_POST['date_consent'];
            } else {
                $model->date_consent = '0000-00-00';
            }

            if (isset($_POST['date_effective']) && $_POST['date_effective'] != '') {
                $model->date_effective = $_POST['date_effective'];
            } else {
                $model->date_effective = '0000-00-00';
            }

            if (isset($_POST['date_received']) && $_POST['date_received'] != '') {
                $model->date_received = $_POST['date_received'];
            } else {
                $model->date_received = '0000-00-00';
            }

            $model->user_id = Yii::app()->session['user_id'];
            $model->tbl_ref = $_POST['tbl_ref'];
            $model->id_ref = $_POST['id_ref'];
            
            OstAuditTrail::model()->insertlog(9, 'update', $model->id);
            
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
    
    public function actionFlagDelete($id) {
        $model = new OstAmendingAct('search');
        $del = OstAmendingAct::model()->findByPk($id);
        
        if (isset($_GET['OstAct']))
            $model->attributes = $_GET['OstAct'];
        
        OstAmendingAct::model()->updateByPk($del->id, array('isactive' => 1));
        OstAuditTrail::model()->insertlog(9, 'delete', $del->id);
        
        //$this->render('admin', array('model' => $model,));
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('OstAmendingAct');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new OstAmendingAct('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OstAmendingAct']))
            $model->attributes = $_GET['OstAmendingAct'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = OstAmendingAct::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ost-amending-act-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionChangeParent() {
        $ref = $_POST['tbl_ref'];
        if ($ref == 'ost_act') {
            echo CHtml::dropdownlist('id_ref', '', OstAct::model()->displayActList(), array('class' => 'col-sm-12'));
        } else if ($ref == 'ost_amending_act') {
            echo CHtml::dropdownlist('id_ref', '', OstAmendingAct::model()->displayActList2(), array('class' => 'col-sm-12'));
        } else if ($ref == 'ost_perundangan') {
            echo CHtml::dropdownlist('id_ref', '', OstPerundangan::model()->displayActList(), array('class' => 'col-sm-12'));
        }
    }
    
//    public function actionDownload($id){
//        $model = OstAmendingAct::model()->findByPk($id);
//        $url = Yii::app()->baseUrl."/uploads/files/lorem_ipsum_pdf.pdf";
//        //print_r($model->act_name_bi);
//        $model->file_url = Yii::app()->getRequest()->sendFile($url, file_get_contents('http://' . $_SERVER['HTTP_HOST'] . str_replace(' ','%20',$url)));
//        $this->redirect('index.php?r=portal/amendingactList');
//    }
    
    public function actionDownload($id){
        $model = OstAmendingAct::model()->findByPk($id);
        //$url = Yii::app()->baseUrl."/uploads/files/lorem_ipsum_pdf.pdf";
        //print_r($model->act_name_bi);
        
        if(Yii::app()->session['lang'] == 'my'){
            if($model->doc_name_bm != ''){
                $file = "..".Yii::app()->baseUrl."/uploads/files/amending_act/$model->doc_name_bm";
                if(file_exists("$file")){
                    $model->file_url = Yii::app()->getRequest()->sendFile($model->doc_name_bm, file_get_contents('http://' . $_SERVER['HTTP_HOST'] . str_replace(' ','%20',Yii::app()->baseUrl."/uploads/files/act/$model->doc_name_bm")));
                }
            } else {
                Yii::app()->user->setFlash('alert', OstRefList::model()->getTranslation("error"));
            }
        } else {
            print_r($model);
            if($model->doc_name_bi != ''){
                $file = "..".Yii::app()->baseUrl."/uploads/files/amending_act/$model->doc_name_bi";
                if(file_exists("$file")){
                    $model->file_url = Yii::app()->getRequest()->sendFile($model->doc_name_bi, file_get_contents('http://' . $_SERVER['HTTP_HOST'] . str_replace(' ','%20',Yii::app()->baseUrl."/uploads/files/act/$model->doc_name_bi")));
                }
            } else {
                Yii::app()->user->setFlash('alert', OstRefList::model()->getTranslation("error"));
            }
        }
        
        //$model->file_url = Yii::app()->getRequest()->sendFile($url, file_get_contents('http://' . $_SERVER['HTTP_HOST'] . str_replace(' ','%20',$url)));
//        $this->redirect('index.php?r=portal/actList');
        $this->redirect(Yii::app()->request->urlReferrer);
    }

}
