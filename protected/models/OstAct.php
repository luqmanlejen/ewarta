<?php

/**
 * This is the model class for table "ost_act".
 *
 * The followings are the available columns in table 'ost_act':
 * @property integer $id
 * @property string $date_proclamation
 * @property integer $highlight_act
 * @property integer $no_act
 * @property string $act_name_bi
 * @property string $act_name_bm
 * @property string $doc_name_bi
 * @property string $doc_name_bm
 * @property string $date_consent
 * @property string $date_effective
 * @property string $remarks_bm
 * @property integer $pages
 * @property string $date_received
 * @property integer $publish
 * @property integer $user_id
 * @property integer $ministry_id
 * @property integer $unit_id
 * @property integer $created_by
 * @property string $created_dt
 * @property integer $updated_by
 * @property string $updated_dt
 * @property string $remarks_bi
 * @property integer $hits
 * @property integer $year
 * @property integer $isactive
 * @property integer $idasal
 */
class OstAct extends CActiveRecord {

    public function tableName() {
        return 'ost_act';
    }

    public function rules() {
        return array(
            array('highlight_act, no_act, pages, publish, user_id, ministry_id, unit_id, created_by, updated_by, hits, year, isactive, idasal', 'numerical', 'integerOnly' => true),
            array('act_name_bi, act_name_bm, doc_name_bi, doc_name_bm', 'length', 'max' => 250),
            array('date_proclamation, date_consent, date_effective, remarks_bm, date_received, created_dt, updated_dt, remarks_bi', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, date_proclamation, highlight_act, no_act, act_name_bi, act_name_bm, doc_name_bi, doc_name_bm, date_consent, date_effective, remarks_bm, pages, date_received, publish, user_id, ministry_id, unit_id, created_by, created_dt, updated_by, updated_dt, remarks_bi, hits, year, isactive, idasal', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'reladmin' => array(self::BELONGS_TO, 'OstUser', '', 'foreignKey' => array('updated_by' => 'id')),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'date_proclamation' => 'Date Proclamation',
            'highlight_act' => 'Highlight Act',
            'no_act' => 'No Act',
            'act_name_bi' => 'Act Name',
            'act_name_bm' => 'Act Name',
            'doc_name_bi' => 'Document Name',
            'doc_name_bm' => 'Document Name',
            'date_consent' => 'Date Consent',
            'date_effective' => 'Date Effective',
            'pages' => 'Pages',
            'date_received' => 'Date Received',
            'publish' => 'Publish',
            'user_id' => 'User',
            'ministry_id' => 'Ministry',
            'unit_id' => 'Unit',
            'created_by' => 'Created By',
            'created_dt' => 'Created Date',
            'updated_by' => 'Updated By',
            'updated_dt' => 'Updated Date',
            'remarks_bm' => 'Remarks',
            'remarks_bi' => 'Remarks',
            'hits' => 'Hits',
            'year' => 'Year',
            'isactive' => 'Isactive',
            'idasal' => 'Idasal',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('date_proclamation', $this->date_proclamation, true);
        $criteria->compare('highlight_act', $this->highlight_act);
        $criteria->compare('no_act', $this->no_act);
        $criteria->compare('act_name_bi', $this->act_name_bi, true);
        $criteria->compare('act_name_bm', $this->act_name_bm, true);
        $criteria->compare('doc_name_bi', $this->doc_name_bi, true);
        $criteria->compare('doc_name_bm', $this->doc_name_bm, true);
        $criteria->compare('date_consent', $this->date_consent, true);
        $criteria->compare('date_effective', $this->date_effective, true);
        $criteria->compare('remarks_bm', $this->remarks_bm, true);
        $criteria->compare('pages', $this->pages);
        $criteria->compare('date_received', $this->date_received, true);
        $criteria->compare('publish', $this->publish);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('ministry_id', $this->ministry_id);
        $criteria->compare('unit_id', $this->unit_id);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('created_dt', $this->created_dt, true);
        $criteria->compare('updated_by', $this->updated_by);
        $criteria->compare('updated_dt', $this->updated_dt, true);
        $criteria->compare('remarks_bi', $this->remarks_bi, true);
        $criteria->compare('hits', $this->hits);
        $criteria->compare('year', $this->year);
        $criteria->compare('isactive', $this->isactive);
        $criteria->compare('idasal', $this->idasal);

        $criteria->addCondition("isactive = 0");
        
        if (!isset($_GET['OstAct_sort']))
            $criteria->order = 't.no_act ASC';
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    public function search_portal() {
        $criteria = new CDbCriteria;
        $start = '0000-00-00';
        $end = '0000-00-00';
        if(isset($_GET['start'])){
            $start = $_GET['start'];
        }
        if(isset($_GET['end'])){
            $end = $_GET['end'];
        }
        
        $criteria->compare('no_act', $this->no_act);
        
        if(isset($_GET['act_name']) && $_GET['act_name'] != ''){
            $act_name = $_GET['act_name'];
            if(Yii::app()->session['lang'] == 'my'){
                $criteria->compare('act_name_bm', $act_name, true);
            } else {
                $criteria->compare('act_name_bi', $act_name, true);
            }
        }
        
        if(isset($_GET['start']) && isset($_GET['end'])){
            if($_GET['start'] != ''){
                $criteria->addCondition("date_proclamation >= '$start'");
            } 
            if($_GET['end'] != '') {
                $criteria->addCondition("date_proclamation <= '$end'");
            }
            if($_GET['start'] != '' && $_GET['end'] != ''){
                $criteria->addCondition("date_proclamation >= '$start' AND date_proclamation <= '$end'");
            }
        }
        
        $criteria->addCondition("publish = 1");
        $criteria->addCondition("isactive = 0");
        
        if (!isset($_GET['OstAct_sort']))
            $criteria->order = 't.no_act ASC';
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function beforeSave() {
        $this->updated_by = Yii::app()->session['user_id'];
        $this->updated_dt = new CDbExpression('NOW()');
        if ($this->isNewRecord) {
            $this->created_by = Yii::app()->session['user_id'];
            $this->created_dt = new CDbExpression('NOW()');
        }
        return parent::beforeSave();
    }

    public function displaylang($id) {
        $output = '';
        $model = OstAct::model()->findByPk($id);
        if (sizeof($model) > 0) {
            if ($model->act_name_bi != '') {
                $output .= '<img src="images/lang/en.png">&nbsp;';
            } else {
                $output .= '<img src="images/lang/en.png" style="opacity:0.2;">&nbsp;';
            }
            if ($model->act_name_bm != '') {
                $output .= '<img src="images/lang/my.png">&nbsp;';
            } else {
                $output .= '<img src="images/lang/my.png" style="opacity:0.2;">&nbsp;';
            }
        }
        echo $output;
    }
    public function displayActName($id) {
        $output = '';
        $model = OstAct::model()->findByPk($id);
        if(sizeof($model) > 0){
            if ($model->act_name_bi != '' && $model->doc_name_bi != '') {
                $output .= "<b><a href='$model->doc_name_bi' target='_blank'>".$model->act_name_bi."</a></b>";
                $output .= "<br>";
            } else {
                $output .= "<b>".$model->act_name_bi."</b>";
                $output .= "<br>";
            }
            if ($model->act_name_bm != '' && $model->doc_name_bm != '') {
                $output .= "<a href='$model->doc_name_bm' target='_blank'>".$model->act_name_bm."</a>";
            } else {
                $output .= $model->act_name_bm;
            }
        }
        echo $output;
    }
    
    public function displayActList() {
        $output = '';
        $models = OstAct::model()->findAll(array('order' => 'act_name_bi ASC'));
        $output = CHtml::listData($models, 'id', 'act_name_bi');
        if(Yii::app()->session['lang'] == 'my'){
            $models = OstAct::model()->findAll(array('order' => 'act_name_bm ASC'));
            $output = CHtml::listData($models, 'id', 'act_name_bm');
        }
        return $output;
    }
    
    public function displayPortalActTitle($id) {
        $output = '';
        $model = OstAct::model()->findByPk($id);
        $remarks = 'No remarks.';
        if($model->remarks_bi != ''){
            $remarks = $model->remarks_bi;
        }
        $output = "<b><a href='$model->doc_name_bi' target='_blank'>".$model->act_name_bi."</a></b><br>
                    Remark: $remarks";
        
        if(Yii::app()->session['lang'] == 'my'){
            $remarks = 'Tiada Catatan.';
            if($model->remarks_bi != ''){
                $remarks = $model->remarks_bi;
            }
            $output = "<b><a href='$model->doc_name_bm' target='_blank'>".$model->act_name_bm."</a></b><br>
                        Catatan: $remarks";
        }
        echo $output;
    }    
    
    public function displayDate($date){
        $output = 'No date found.';
        if($date != '' && $date != '0000-00-00'){
            echo Yii::app()->dateFormatter->format("dd/MM/y", strtotime($date));
        } else if($date == '0000-00-00'){
            if(Yii::app()->session['lang'] == 'my'){
                $output = 'Tiada tarikh dijumpai.';
            }
        }else {
            if(Yii::app()->session['lang'] == 'my'){
                $output = 'Tiada tarikh dijumpai.';
            }
        }
        echo $output;
    }
    
    public function displayRelatedLegislation($id){
        $output = 'No results found.';
        $model = OstRelatedLegislation::model()->findByAttributes(array('related_id'=>$id));
        if(sizeof($model) > 0){
            $output = $model->gn_no;
        } else {
            if(Yii::app()->session['lang'] == 'my'){
                $output = 'Tiada maklumat dijumpai.';
            }
        }
        echo $output;
    }
}