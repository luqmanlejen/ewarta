<?php

class PortalController extends Controller {

    public function init() {
        $ip = Yii::app()->request->userHostAddress;

        PortalController::UniqueVisitorCount($ip);
        //$ip = CHttpRequest::getUserHostAddress();
        //OstVisitor::model()->AddVisitor();

        Yii::app()->theme = "portal";
        parent::init();
    }

    public static function UniqueVisitorCount($ip) {
        session_start();
        if (!isset($_SESSION['current_user'])) {
            $file = 'counter.txt';
            if (!$data = @file_get_contents($file)) {
                file_put_contents($file, base64_encode($ip));                
                $_SESSION['visitor_count'] = 1;                
            } else {                
                $decodedData = base64_decode($data);
                $ipList = explode(';', $decodedData);

                if (!in_array($ip, $ipList)) {
                    array_push($ipList, $ip);
                    file_put_contents($file, base64_encode(implode(';', $ipList)));
                    OstVisitor::model()->AddVisitor();
                }
                $_SESSION['visitor_count'] = count($ipList);
            }
            $_SESSION['current_user'] = $ip;
        }
    }

    public function filters() {
        return array(
            //<any other filters here>
            array('ext.yiibooster.filters.BoosterFilter - delete')
        );
    }

    public function actionIndex($menu_id = '') {

        $this->render('index');
    }

    public function actionIndex2($menu_id = '') {

        $this->render('index2');
    }

    public function actionSetlang($lang) {
        Yii::app()->session['lang'] = $lang;
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionActList() {
        $model = new OstAct('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OstAct']))
            $model->attributes = $_GET['OstAct'];

        $this->render('actlist', array(
            'model' => $model,
        ));
    }

    public function actionAmendingActList() {
        $model = new OstAmendingAct('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OstAmendingAct']))
            $model->attributes = $_GET['OstAmendingAct'];

        $this->render('amendingactlist', array(
            'model' => $model,
        ));
    }

    public function actionPuaList() {
        $model = new OstPu('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OstPu']))
            $model->attributes = $_GET['OstPu'];

        $this->render('pua', array(
            'model' => $model,
        ));
    }

    public function actionPubList() {
        $model = new OstPu('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OstPu']))
            $model->attributes = $_GET['OstPu'];

        $this->render('pub', array(
            'model' => $model,
        ));
    }

    public function actionLomList() {
        $model = new OstVersionAct('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OstVersionAct']))
            $model->attributes = $_GET['OstVersionAct'];

        $this->render('lomlist', array(
            'model' => $model,
        ));
    }

    public function actionFull() {
        $this->render('full');
    }

    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

}
