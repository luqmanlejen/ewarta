<?php

class OstActController extends CmsController {

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate() {
        $model = new OstAct;

        if (isset($_POST['OstAct'])) {
            $model->attributes = $_POST['OstAct'];
            if(isset($_POST['date_proclamation']) && $_POST['date_proclamation'] != ''){
                $model->date_proclamation = $_POST['date_proclamation'];
            } else {
                $model->date_proclamation = '0000-00-00';
            }
            
            if(isset($_POST['date_consent']) && $_POST['date_consent'] != ''){
                $model->date_consent = $_POST['date_consent'];
            } else {
                $model->date_consent = '0000-00-00';
            }
            
            if(isset($_POST['date_effective']) && $_POST['date_effective'] != ''){
                $model->date_effective = $_POST['date_effective'];
            } else {
                $model->date_effective = '0000-00-00';
            }
            
            if(isset($_POST['date_received']) && $_POST['date_received'] != ''){
                $model->date_received = $_POST['date_received'];
            } else {
                $model->date_received = '0000-00-00';
            }
                            
            $arr_bi = explode("/act/", $_POST['OstAct']['doc_name_bi']);
            $arr_bm = explode("/act/", $_POST['OstAct']['doc_name_bm']);
            if(sizeof($arr_bi) > 1){
                if(isset($_POST['OstAct']['doc_name_bi'])){
                    $model->doc_name_bi = $arr_bi[1];
                }
            }
            if(sizeof($arr_bm) > 1){
                if(isset($_POST['OstAct']['doc_name_bm']) && $_POST['OstAct']['doc_name_bm'] != ''){
                    $model->doc_name_bm = $arr_bm[1];
                }
            }
            
            $model->user_id = Yii::app()->session['user_id'];
            
            OstAuditTrail::model()->insertlog(8, 'create', $model->id);
            
            if ($model->save())
                $this->redirect(array('admin', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['OstAct'])) {
            $model->attributes = $_POST['OstAct'];
            
            if(isset($_POST['date_proclamation']) && $_POST['date_proclamation'] != ''){
                $model->date_proclamation = $_POST['date_proclamation'];
            } else {
                $model->date_proclamation = '0000-00-00';
            }
            
            if(isset($_POST['date_consent']) && $_POST['date_consent'] != ''){
                $model->date_consent = $_POST['date_consent'];
            } else {
                $model->date_consent = '0000-00-00';
            }
            
            if(isset($_POST['date_effective']) && $_POST['date_effective'] != ''){
                $model->date_effective = $_POST['date_effective'];
            } else {
                $model->date_effective = '0000-00-00';
            }
            
            if(isset($_POST['date_received']) && $_POST['date_received'] != ''){
                $model->date_received = $_POST['date_received'];
            } else {
                $model->date_received = '0000-00-00';
            }
            
            $arr_bi = explode("/act/", $_POST['OstAct']['doc_name_bi']);
            $arr_bm = explode("/act/", $_POST['OstAct']['doc_name_bm']);
            if(sizeof($arr_bi) > 1){
                if(isset($_POST['OstAct']['doc_name_bi'])){
                    $model->doc_name_bi = $arr_bi[1];
                }
            }
            if(sizeof($arr_bm) > 1){
                if(isset($_POST['OstAct']['doc_name_bm']) && $_POST['OstAct']['doc_name_bm'] != ''){
                    $model->doc_name_bm = $arr_bm[1];
                }
            }
            
            $model->user_id = Yii::app()->session['user_id'];
            
            OstAuditTrail::model()->insertlog(8, 'update', $model->id);
            
            if ($model->save())
                $this->redirect(array('admin', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }
    
    public function actionFlagDelete($id) {
        $model = new OstAct('search');
        $del = OstAct::model()->findByPk($id);
        
        if (isset($_GET['OstAct']))
            $model->attributes = $_GET['OstAct'];
        
        OstAct::model()->updateByPk($del->id, array('isactive' => 1));
        OstAuditTrail::model()->insertlog(8, 'delete', $model->id);
        //$this->render('admin', array('model' => $model,));
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('OstAct');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new OstAct('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OstAct']))
            $model->attributes = $_GET['OstAct'];

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id) {
        $model = OstAct::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ost-act-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionDownload($id,$type){
        $model = OstAct::model()->findByPk($id);
        //$url = Yii::app()->baseUrl."/uploads/files/lorem_ipsum_pdf.pdf";
        //print_r($model->act_name_bi);
        if($type == 1){
            if($model->doc_name_bi != ''){
                $file = "..".Yii::app()->baseUrl."/uploads/files/act/$model->doc_name_bi";
                if(file_exists("$file")){
                    $model->file_url = Yii::app()->getRequest()->sendFile($model->doc_name_bi, file_get_contents('http://' . $_SERVER['HTTP_HOST'] . str_replace(' ','%20',Yii::app()->baseUrl."/uploads/files/act/$model->doc_name_bi")));
                    OstAct::model()->updateByPk($model->id, array('hits' => $model->hits+1));
                } else {
                    if(Yii::app()->session['lang'] == 'my'){
                        Yii::app()->user->setFlash('alert', OstRefList::model()->getTranslation("error"));
                    } else {
                        Yii::app()->user->setFlash('alert', OstRefList::model()->getTranslation("error"));
                    }
                }
            } else {
                if(Yii::app()->session['lang'] == 'my'){
                    Yii::app()->user->setFlash('alert', OstRefList::model()->getTranslation("error"));
                } else {
                    Yii::app()->user->setFlash('alert', OstRefList::model()->getTranslation("error"));
                }
            }
        }
        if($type == 2){
            if($model->doc_name_bm != ''){
                $file = "..".Yii::app()->baseUrl."/uploads/files/act/$model->doc_name_bm";
                if(file_exists("$file")) {
                    $model->file_url = Yii::app()->getRequest()->sendFile($model->doc_name_bm, file_get_contents('http://' . $_SERVER['HTTP_HOST'] . str_replace(' ','%20',$model->doc_name_bm)));
                    OstAct::model()->updateByPk($model->id, array('hits' => $model->hits+1));
                } else {
                    if(Yii::app()->session['lang'] == 'my'){
                        Yii::app()->user->setFlash('alert', OstRefList::model()->getTranslation("error"));
                    } else {
                        Yii::app()->user->setFlash('alert', OstRefList::model()->getTranslation("error"));
                    }
                }
            } else {
                if(Yii::app()->session['lang'] == 'my'){
                    Yii::app()->user->setFlash('alert', OstRefList::model()->getTranslation("error"));
                } else {
                    Yii::app()->user->setFlash('alert', OstRefList::model()->getTranslation("error"));
                }
            }
        }
        
        //$model->file_url = Yii::app()->getRequest()->sendFile($url, file_get_contents('http://' . $_SERVER['HTTP_HOST'] . str_replace(' ','%20',$url)));
//        $this->redirect('index.php?r=portal/actList');
        $this->redirect(Yii::app()->request->urlReferrer);
    }

}
