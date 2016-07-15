<?php

class OstPollController extends CmsController {

    public function actionCreate() {
        $model = new OstPoll;
        $model3 = new OstPoll;
        
        if (isset($_POST['OstPoll'])) {
            $model->attributes = $_POST['OstPoll'];

            if ($model->save()) {
                $model3->question = $_POST['question_my'];
                $model3->status = 0;
                $model3->parent_id = $model->id;
                $model3->lang = 'my';
                
                if ($model3->save(false)) {
                    
                    if ($model->status == 1)
                        $this->SetSetatus($model->id);
                    
                    $this->redirect('index.php?r=OstPoll/admin');
                }
            }
        }
        $this->render('create', array('model' => $model, 'model3' => $model3));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model3 = OstPoll::model()->findByAttributes(array('parent_id' => $id));

        if (sizeof($model3) > 0)
            $trans = 1;
        else
            $trans = 0;

        if (isset($_POST['OstPoll'])) {
            $model->attributes = $_POST['OstPoll'];

            if ($model->save()) {
                
                if ($trans == 0)
                    $model3 = new OstPoll;
                if ($trans == 1)
                    $model3 = OstPoll::model()->findByAttributes(array('parent_id' => $id));

                $model3->question = $_POST['question_my'];
                $model3->status = 0;
                $model3->parent_id = $model->id;
                $model3->lang = 'my';

                if ($model3->save(false)) {

                    if ($model->status == 1)
                        $this->SetSetatus($model->id);

                    $this->redirect('index.php?r=OstPoll/admin');
                }
            }
        }
        $model2 = new OstPollAns('search');
        $model2->unsetAttributes();  // clear any default values
        $model2->question_id = $id;

        if (isset($_GET['OstPollAns']))
            $model->attributes = $_GET['OstPollAns'];

        $this->render('update', array('model' => $model, 'model2' => $model2, 'model3' => $model3));
    }

    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model2 = OstPoll::model()->findByAttributes(array('parent_id' => $id));

        $model->delete();
        $model2->delete();
        $model3 = OstPollAns::model()->findAllByAttributes(array('question_id' => $id));

        if (sizeof($model3) > 0) {
            foreach ($model3 as $row3) {
                OstPollAns::model()->deleteAllByAttributes(array('parent_id' => $row3->id));
            }
        }

        OstPollAns::model()->deleteAllByAttributes(array('question_id' => $id));
        $this->redirect('index.php?r=OstPoll/admin');
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('OstPoll');
        $this->render('index', array('dataProvider' => $dataProvider,));
    }

    public function actionAdmin() {
        $model = new OstPoll('search');
        $model->unsetAttributes();
        
        if (isset($_GET['OstPoll']))
            $model->attributes = $_GET['OstPoll'];

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id) {
        $model = OstPoll::model()->findByPk($id);
        
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'poll-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function SetSetatus($id) {
        $model2 = OstPoll::model()->findAll();
        
        foreach ($model2 as $m2) {
            if ($m2->id != $id) {
                $m2->status = 0;
                $m2->update();
            }
        }
    }
}