<?php

class OstPollAnsController extends CmsController {

    public function actionCreate($id) {

        $model = new OstPollAns;

        $model2 = new OstPollAns;

        if (isset($_POST['OstPollAns'])) {

            $model->attributes = $_POST['OstPollAns'];
            
            $model->answer = $_POST['OstPollAns']['answer'];

            $model->question_id = $id;

            if ($model->save()) {

                $model2->answer = $_POST['answer_my'];

                $model2->parent_id = $model->id;

                $model2->lang = 'my';

                if ($model2->save(false)) {

                        $this->redirect("index.php?r=OstPoll/update&id=" . $id);
                }
            }
        }

        $this->render('create', array('model' => $model, 'model2' => $model2));
    }

    public function actionUpdate($id, $question_id) {

        $model = $this->loadModel($id);

        $model2 = OstPollAns::model()->findByAttributes(array('parent_id' => $model->id));

        if (sizeof($model2) > 0)
            $trans = 1;
        else
            $trans = 0;

        if (isset($_POST['OstPollAns'])) {

            $model->attributes = $_POST['OstPollAns']['answer'];
            $model->answer = $_POST['OstPollAns']['answer'];

            if ($model->save()) {

                if ($trans == 0)
                    $model2 = new OstPollAns;
                if ($trans == 1)
                    $model2 = OstPollAns::model()->findByAttributes(array('parent_id' => $model->id));

                $model2->answer = $_POST['answer_my'];

                $model2->parent_id = $model->id;

                $model2->lang = 'my';

                if ($model2->save(false)) {

                    
                        $this->redirect('index.php?r=OstPoll/update&id=' . $question_id);
                }
            }
        }

        $this->render('update', array('model' => $model, 'model2' => $model2));
    }

    public function actionDelete($id) {

        $model = $this->loadModel($id);

        $model2 = OstPollAns::model()->findByAttributes(array('parent_id' => $model->id));

        

            $model->delete();

            $model2->delete();

            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        
    }

    public function actionIndex() {

        $dataProvider = new CActiveDataProvider('OstPollAns');

        $this->render('index', array('dataProvider' => $dataProvider,));
    }

    public function actionAdmin() {

        $model = new OstPollAns('search');

        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['OstPollAns']))
            $model->attributes = $_GET['OstPollAns'];

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id) {

        $model = OstPollAns::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        return $model;
    }

    protected function performAjaxValidation($model) {

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ost-poll-ans-form') {

            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

}