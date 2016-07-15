<?php

class PortalTranslation {

    public static function TranslateMenu($id, $title_en) {

        $output = $title_en;

        if (Yii::app()->session['lang'] == 'my') {

            $model = OstMenuPortal::model()->findByAttributes(array('parent_lang' => $id, 'lang' => 'my'));

            if (sizeof($model) > 0 && $model->title != '')
                $output = $model->title;
        }

        return $output;
    }
    
    public static function TranslateArticleTitle($bul_id, $bul_title_en) {

        $output = $bul_title_en;

        if (Yii::app()->session['lang'] == 'my') {

            $model = OstArticles::model()->findByAttributes(array('parent_id' => $bul_id, 'lang' => 'my'));

            if (sizeof($model) > 0 && $model->title != '')
                $output = $model->title;
        }

        return $output;
    }
    
    public static function TranslateArticleContent($bul_id, $bul_content_en) {
              
        $output = $bul_content_en;

        if (Yii::app()->session['lang'] == 'my') {

            $model = OstArticles::model()->findByAttributes(array('parent_id' => $bul_id, 'lang' => 'my'));

            if (sizeof($model) > 0 && $model->content != '')
                $output = $model->content;
        }

        return $output;
    }
    
    public static function TranslateArticles($id, $text_en, $field) {

        $output = $text_en;

        if (Yii::app()->session['lang'] == 'my') {

            $model = OstArticles::model()->findByAttributes(array('parent_id' => $id, 'lang' => 'my'));

            if (sizeof($model) > 0) {

                if ($field == 'title')
                    if ($model->title != '')
                        $output = $model->title;

                if ($field == 'content')
                    if ($model->content != '')
                        $output = $model->content;
            }
        }

        return $output;
    }

    public static function TranslateDate($date) {

        $output = $date;

        $dayInEn = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

        $dayInMy = array('Isnin', 'Selasa', 'Rabu', 'Khamis', 'Jumaat', 'Sabtu', 'Ahad');

        $timeInEn = array('am', 'pm', 'AM', 'PM');

        $timeInMy = array('pg', 'ptg', 'PG', 'PTG');

        if (Yii::app()->session['lang'] == 'my') {

            $output = PortalTranslation::TranslateMonth($date);

            $output = str_replace($timeInEn, $timeInMy, $output);

            $output = str_replace($dayInEn, $dayInMy, $output);
        }

        return $output;
    }

    public static function TranslateMonth($date) {

        $output = $date;

        $monthInEn = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

        $monthInMy = array('Januari', 'Februari', 'Mac', 'April', 'Mei', 'Jun', 'Julai', 'Ogos', 'September', 'Oktober', 'November', 'Disember');

        if (Yii::app()->session['lang'] == 'my')
            $output = str_replace($monthInEn, $monthInMy, $date);

        return $output;
    }
    
    public static function TranslateLomPdf($id) {

        $output = '';

        if (Yii::app()->session['lang'] == 'my') {

            $model3 = OstLom::model()->findByAttributes(array('lom_parent_lang' => $id, 'lom_lang' => 'my'));

            if (sizeof($model3) > 0)
                $output = $model3->id;
        }

        return $output;
    }
    
    public static function TranslateLomTitle($id, $title_en) {

        $output = $title_en;

        if (Yii::app()->session['lang'] == 'my') {

            $model3 = OstLom::model()->findByAttributes(array('lom_parent_lang' => $id, 'lom_lang' => 'my'));

            if (sizeof($model3) > 0 && $model3->lom_title != '')
                $output = $model3->lom_title;
        }

        return $output;
    }
    
    public static function TranslateCatTitle($id, $title_en) {
        $output = $title_en;

        if (Yii::app()->session['lang'] == 'my') {

            $model3 = OstCategories::model()->findByAttributes(array('parent_lang' => $id, 'lang' => 'my'));

            if (sizeof($model3) > 0 && $model3->title != '')
                $output = $model3->title;
        }
        
        return $output;
    }
    
    public static function TranslateMedia($id, $text_en, $field) {

        $output = $text_en;

        if (Yii::app()->session['lang'] == 'my') {

            $model = OstMedia::model()->findByAttributes(array('parent_id' => $id, 'lang' => 'my'));

            if (sizeof($model) > 0) {

                if ($field == 'title')
                    if ($model->title != '')
                        $output = $model->title;

                if ($field == 'img')
                    if ($model->img != '')
                        $output = $model->img;
            }
        }

        return $output;
    }
    
    public static function TranslateGalleryTitle($album_id, $title) {

        $output = $title;

        if (Yii::app()->session['lang'] == 'my') {

            $model = OstPhotoAlbum::model()->findByAttributes(array('parent_id' => $album_id, 'lang' => 'my'));

            if (sizeof($model) > 0 && $model->title != '')
                $output = $model->title;
        }

        return $output;
    }
    
    public static function TranslateGalleryContent($album_id, $title) {

        $output = $title;

        if (Yii::app()->session['lang'] == 'my') {

            $model = OstPhotoAlbum::model()->findByAttributes(array('parent_id' => $album_id, 'lang' => 'my'));

            if (sizeof($model) > 0 && $model->descr != '')
                $output = $model->descr;
        }

        return $output;
    }
    
    public static function TranslateDocAttach($id, $txt_en, $field) {

        $output = $txt_en;

        if (Yii::app()->session['lang'] == 'my') {

            $model = OstPhotoList::model()->findByAttributes(array('album_id' => $id));
            
                if (sizeof($model) > 0) {

//                if ($field == 'doc_title' && $model->doc_title != '')
//                    $output = $model->doc_title;
                if ($field == 'url' && $model->url != ''){
                    $output = $model->url;
                }
//                else if ($field == 'remarks' && $model->remarks != '')
//                    $output = $model->remarks;
                }
            
        }

        return $output;
    }
    
    public static function TranslateFooterTitle($id, $title_en){
        $output = $title_en;
        if (Yii::app()->session['lang'] == 'my') {
            $model = OstMenuPortal::model()->findByAttributes(array('parent_lang'=>$id, 'lang'=>'my'));
            $output = $model->title;
        }
        return $output;
    }
    
    public static function TranslateAnnounceList($id, $type, $title_en){
        $output = $title_en;
        if (Yii::app()->session['lang'] == 'my') {
            if($type == 'act'){
                $model = OstAct::model()->findByPk($id);
                $output = $model->act_name_bm;
            }
            if($type == 'amending'){
                $model = OstAmendingAct::model()->findByPk($id);
                $output = $model->act_name_bm;
            }
            if($type == 'pu'){
                $model = OstPu::model()->findByPk($id);
                $output = $model->sub_act_name_bm;
            }
        }
        return $output;
    }
    
    public static function TranslateActLink($id, $type, $doc_bi){        
        $output = $doc_bi;
        if (Yii::app()->session['lang'] == 'my') {
            if($type == 'act'){
                $model = OstAct::model()->findByPk($id);
                $output = $model->doc_name_bm;
            } else if($type == 'amending'){
                $model = OstAmendingAct::model()->findByPk($id);
                $output = $model->doc_name_bm;
            }
                
        }
        return $output;
    }
}