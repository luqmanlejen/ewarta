<?php

class CommonElement {
    
    public static function encrypt_decrypt($action, $string) {

        $output = false;

        $encrypt_method = "AES-256-CBC";

        $secret_key = '{my0p3n$0f+!}';

        $secret_iv = '[!#P3r4ngk4An#]';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'encrypt') {

        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);

        $output = base64_encode($output);
        } else if ($action == 'decrypt') {

        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }
    
    public function get_from_categories($type, $val) {

        $output = '';

        if ($type == 1)
            $model1 = CmsCategories::model()->findAll(array("condition" => "cat_type = '" . $val . "' AND published = 'y' ", "order" => "sort ASC"));

        else if ($type == 2)
            $model1 = CmsCategories::model()->findAll(array("condition" => "id = '" . $val . "' AND published = 'y'", "order" => "sort ASC"));

        if ($model1 != '') {

            foreach ($model1 as $row1)
                 $model2 = CmsBulletin::model()->findAllBySql("SELECT * FROM cms_bulletin WHERE cat = '" . $row1->id . "' AND status = 'y' ORDER BY sort ASC");

                
                $summary = '';

                $content = '';

                $bul_id = 0;

                $title = '';

                $img = '';

                if ($model2 != '') {

                    foreach ($model2 as $row2) {

                        $summary = $row2->summary;

                        $bul_id = $row2->id;

                        $title = $row2->title;

                        if ($row2->img_src != '')
                            $img = $row2->img_src;

                        $model3 = CmsBulletinContent::model()->findBySql("SELECT * FROM cms_bulletin_content WHERE bulletin_id = " . $row2->id );

                        if ($model3 != '')
                            $content = $model3->content;

                        $output[] = array(
                            "cat_id" => $row1->id,
                            "target" => $row1->target,
                            "img" => $img,
                            "summary" => $summary,
                            "content" => $content,
                            "title" => $title,
                            "loc" => $row1->menu_loc,
                            "bul_id" => $bul_id
                        );
                    }
                }
            }
            
        return $output;
    }

    public function get_from_bulletin($bul_id) {

        $model = CmsBulletin::model()->findByPK($bul_id);

        $model2 = CmsBulletinContent::model()->findBySql("SELECT * FROM cms_bulletin_content WHERE bulletin_id = " . $model->id);

        $content = '';
        $content_id = '';

        if ($model2 != '') {
            $content = $model2->content;
            $content_id = $model2->id;
        }

        $output = '';

        $output[] = array(
            "bul_id" => $bul_id,
            "title" => $model->title,
            "summary" => $model->summary,
            "cat_id" => $model->cat,
            "img" => $model->img_src,
            "content" => $content,
            "content_id" => $content_id
        );

        return $output;
    }

    public function get_from_media($media_cat) {

        $output = '';

        $model = CmsMedia::model()->findAll(array("condition" => "media_cat = '" . $media_cat . "'", "order" => "media_sort ASC"));

        if ($model != '') {

            foreach ($model as $row) {

                $output[] = array(
                    "media_id" => $row->media_id,
                    "media_title" => $row->media_title,
                    "media_desc" => $row->media_desc,
                    "media_img" => $row->media_img,
                    "media_link" => $row->media_link,
                    "media_date" => $row->media_date,
                    "media_parentid" => $row->media_parentid,
                    "media_sort" => $row->media_sort);
            }
        }

        return $output;
    }

    public function get_from_media2($media_parentid) {

        $output = '';

        $model = CmsMedia::model()->findAll(array("condition" => "media_parentid = '" . $media_parentid . "'", "order" => "media_sort ASC"));

        if ($model != '') {

            foreach ($model as $row) {

                $output[] = array(
                    "media_id" => $row->media_id,
                    "media_title" => $row->media_title,
                    "media_desc" => $row->media_desc,
                    "media_img" => $row->media_img,
                    "media_link" => $row->media_link,
                    "media_date" => $row->media_date,
                    "media_parentid" => $row->media_parentid,
                    "media_sort" => $row->media_sort);
            }
        }

        return $output;
    }

    function getnextid($modelname, $tablename, $idname) {

        $nextid = 0;

        $rows = $modelname::model()->findBySql('SELECT ' . $idname . ' FROM ' . $tablename . ' ORDER BY ' . $idname . ' DESC LIMIT 1');

        $nextid = $rows[$idname] + 1;

        return $nextid;
    }

    public function get_from_ostref($code, $cat) {

        $model = OstRef::model()->findBySql("SELECT * FROM ost_ref WHERE cat='" . $cat . "' AND code='" . $code . "'");

        return $model['descr'];
    }

    function list_ref($cat, $name = 'ref', $id = 'ref', $val = '0', $prop = 'class="t4"', $opt1 = 'Y') {

        $sql = "SELECT * FROM ost_ref WHERE cat = '$cat' ORDER BY sort";

        //echo $sql;

        $oDb = new query();

        $rs = $oDb->execute($sql);

        $str = "<select name='$name' id='$id' $prop >";

        if ($opt1 == 'Y')
            $str .= "<option value='0'>--Sila Pilih--</option>";

        while ($row = mysql_fetch_array($rs)) {

            $sel = '';

            //echo 'val='.trim($val).'='.trim($row['code']);

            if (trim($val) == trim($row['code'])) {

                $sel = 'selected';
            }

            $code = $row['code'];

            $str .= "<option $sel value='$code'>" . $row['descr'] . "</option>";
        }

        $str .= "</select>";

        return $str;
    }

    function get_date_full() {

        $sql = "select date_format(now(),'%d %M %Y'), date_format(now(),'%Y-%m-%d'), date_format(now(),'%d-%m-%Y'),date_format(now(),'%m/%Y'),date_format(now(),'%Y') ";

        $result = mysql_query($sql);

        if ($rowfield = mysql_fetch_array($result)) { //ada data
            $tarikh_semasa = $rowfield[0];

            $tarikh_db = $rowfield[1];

            $tarikh_semasa1 = $rowfield[2];

            $bulan_tahun = $rowfield[3];

            $tahun = $rowfield[4];
        }

        return array($tarikh_semasa, $tarikh_db, $tarikh_semasa1, $bulan_tahun, $tahun);
    }

    public function getModulAccess() {

        $sql = "select a.modul_id as code,b.descr from modul_access a inner join ost_ref b on b.code=a.modul_id where b.cat='mod' and a.up_id='" . Yii::app()->session['user_id'] . "' order by b.sort";

        $modarr = Yii::app()->db->createCommand($sql)->queryAll();

        //return array(''=>'--Sila Pilih--') + CHtml::listData($modarr, 'code', 'descr');

        return CHtml::listData($modarr, 'code', 'descr');
    }

}

?>
