<?php

class OstPhotoAlbumController extends CmsController {

    public function actionCreate() {
        $model = new OstPhotoAlbum;
        $model2 = new OstPhotoAlbum;

        if (isset($_POST['OstPhotoAlbum'])) {
            $model->attributes = $_POST['OstPhotoAlbum'];

            if (isset($_POST['date']) && $_POST['date'] != '') {
                $date_explode = explode(' - ', $_POST['date']);
                $display_doc_dt = explode('-', $date_explode[0]);
                $model->event_dt = $display_doc_dt[0] . '-' . $display_doc_dt[1] . '-' . $display_doc_dt[2] . ' 00:00:00';
            }

            if ($model->save()) {
                $model2->title = $_POST['title_my'];
                $model2->descr = $_POST['descr_my'];
                $model2->parent_id = $model->id;
                $model2->lang = 'my';
                $model2->save(false);

                OstAuditTrail::model()->insertlog(16, 'create', $model->id);
                $this->redirect("index.php?r=ostPhotoAlbum/admin");
            }
        }

        $this->render('create', array(
            'model' => $model, 'model2' => $model2
        ));
    }

    public function actionUpdate($id) {

        $model = $this->loadModel($id);
        $model2 = OstPhotoAlbum::model()->findByAttributes(array('parent_id' => $model->id));
        $model5 = OstPhotoList::model()->findAllByAttributes(array('album_id' => $id), array('order' => 'sort ASC'));

        if (isset($_POST['OstPhotoAlbum'])) {

            if (isset($_POST['photolist']) && sizeof($_POST['photolist']) > 0) {
                foreach ($_POST['photolist'] as $x) {
                    $model3 = new OstPhotoList;
                    $model3->album_id = $id;
                    $model3->sort = $_POST['photolist_sort_' . $x];
                    $model3->url = $_POST['photolist_imgurl_' . $x];
                    $model3->save(false);
                }
            }

            if (isset($_POST['photolist_old'])) {
                if (sizeof($_POST['photolist_old']) > 0) {
                    foreach ($_POST['photolist_old'] as $y) {
                        $old_id = $y;
                        $old_sort = $_POST['photolist_old_sort_' . $y];
                        OstPhotoList::model()->updateByPk($old_id, array('sort' => $old_sort));
                    }
                }
            }

            $model->attributes = $_POST['OstPhotoAlbum'];

            if (isset($_POST['date']) && $_POST['date'] != '') {
                $date_explode = explode(' - ', $_POST['date']);
                $display_doc_dt = explode('-', $date_explode[0]);
                $model->event_dt = $display_doc_dt[0] . '-' . $display_doc_dt[1] . '-' . $display_doc_dt[2] . ' 00:00:00';
            }

            if ($model->save()) {
                $model2->title = $_POST['title_my'];
                $model2->descr = $_POST['descr_my'];
                $model2->parent_id = $model->id;
                $model2->lang = 'my';
                $model2->save(false);

                //$this->redirect('index.php?r=OstPhotoAlbum/update&id=' . $model->id);
                OstAuditTrail::model()->insertlog(16, 'update', $model->id);
                $this->redirect('index.php?r=OstPhotoAlbum/admin');
            }
        }
        $this->render('update', array('model' => $model, 'model2' => $model2, 'model5' => $model5));
    }

    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $this->loadModel($id)->delete();
        OstPhotoAlbum::model()->deleteAllByAttributes(array('parent_id' => $id));
        OstAuditTrail::model()->insertlog(16, 'delete', $model->id);
        $this->redirect("index.php?r=ostPhotoAlbum/admin");
    }

    public function actionDeletePhoto($id) {
        $model = OstPhotoList::model()->findByPk($id);
        $model2 = OstPhotoAlbum::model()->findByAttributes(array('id' => $model->id));
        $model->delete();
        $this->redirect('index.php?r=ostPhotoAlbum/update&id=' . $model->album_id);
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('OstPhotoAlbum');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new OstPhotoAlbum('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['OstPhotoAlbum']))
            $model->attributes = $_GET['OstPhotoAlbum'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return OstPhotoAlbum the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = OstPhotoAlbum::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param OstPhotoAlbum $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ost-photo-album-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionArchive($id, $media_type = '') {
        OstPhotoAlbum::model()->updateByPk($id, array('status' => 'arc'));
        $this->redirect("index.php?r=OstPhotoAlbum/admin");
    }
    
    public function actionUnarchive($id, $menu_id = '') {
        OstPhotoAlbum::model()->updateByPk($id, array('status' => 'psh'));
        $this->redirect("index.php?r=OstPhotoAlbum/admin");
    }

}
