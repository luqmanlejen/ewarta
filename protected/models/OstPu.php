<?php

/**
 * This is the model class for table "ost_pu".
 *
 * The followings are the available columns in table 'ost_pu':
 * @property integer $id
 * @property string $date_created
 * @property integer $created_by
 * @property integer $pu_type_id
 * @property integer $status_pu_id
 * @property integer $replacement_pu_id
 * @property integer $pu_no
 * @property string $pu_year
 * @property integer $highlight_pu
 * @property string $date_proclamation
 * @property string $sub_act_name_bm
 * @property string $sub_act_name_bi
 * @property string $doc_name_pdf
 * @property string $doc_name_word
 * @property string $date_received
 * @property integer $pages
 * @property integer $officer_maker_id
 * @property integer $ministry_id
 * @property integer $unit_id
 * @property string $updated_dt
 * @property integer $updated_by
 * @property integer $isactive
 * @property integer $publish
 * @property integer $hits
 */
class OstPu extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ost_pu';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('created_by, pu_type_id, status_pu_id, replacement_pu_id, pu_no, highlight_pu, pages, officer_maker_id, ministry_id, unit_id, updated_by, isactive, publish, hits', 'numerical', 'integerOnly' => true),
            array('pu_year', 'length', 'max' => 4),
            array('sub_act_name_bm, sub_act_name_bi', 'length', 'max' => 255),
            array('doc_name_pdf, doc_name_word', 'length', 'max' => 200),
            array('date_created, date_proclamation, date_received, updated_dt', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, date_created, created_by, pu_type_id, status_pu_id, replacement_pu_id, pu_no, pu_year, highlight_pu, date_proclamation, sub_act_name_bm, sub_act_name_bi, doc_name_pdf, doc_name_word, date_received, pages, officer_maker_id, ministry_id, unit_id, updated_dt, updated_by, isactive, publish, hits', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'date_created' => 'Date Created',
            'created_by' => 'Created By',
            'pu_type_id' => 'Pu Type',
            'status_pu_id' => 'Status PU',
            'replacement_pu_id' => 'Replacement PU',
            'pu_no' => 'PU No',
            'pu_year' => 'Pu Year',
            'highlight_pu' => 'Highlight PU',
            'date_proclamation' => 'Date Proclamation',
            'sub_act_name_bm' => 'Sub Act Name',
            'sub_act_name_bi' => 'Sub Act Name',
            'doc_name_pdf' => 'Document Name',
            'doc_name_word' => 'Document Name',
            'date_received' => 'Date Received',
            'pages' => 'Pages',
            'officer_maker_id' => 'Officer',
            'ministry_id' => 'Ministry',
            'unit_id' => 'Unit',
            'updated_dt' => 'Updated Dt',
            'updated_by' => 'Updated By',
            'isactive' => 'Isactive',
            'publish' => 'Publish',
            'hits' => 'Hits',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('date_created', $this->date_created, true);
        $criteria->compare('created_by', $this->created_by);
        $criteria->compare('pu_type_id', $this->pu_type_id);
        $criteria->compare('status_pu_id', $this->status_pu_id);
        $criteria->compare('replacement_pu_id', $this->replacement_pu_id);
        $criteria->compare('pu_no', $this->pu_no);
        $criteria->compare('pu_year', $this->pu_year, true);
        $criteria->compare('highlight_pu', $this->highlight_pu);
        $criteria->compare('date_proclamation', $this->date_proclamation, true);
        $criteria->compare('sub_act_name_bm', $this->sub_act_name_bm, true);
        $criteria->compare('sub_act_name_bi', $this->sub_act_name_bi, true);
        $criteria->compare('doc_name_pdf', $this->doc_name_pdf, true);
        $criteria->compare('doc_name_word', $this->doc_name_word, true);
        $criteria->compare('date_received', $this->date_received, true);
        $criteria->compare('pages', $this->pages);
        $criteria->compare('officer_maker_id', $this->officer_maker_id);
        $criteria->compare('ministry_id', $this->ministry_id);
        $criteria->compare('unit_id', $this->unit_id);
        $criteria->compare('updated_dt', $this->updated_dt, true);
        $criteria->compare('updated_by', $this->updated_by);
        $criteria->compare('isactive', $this->isactive);
        $criteria->compare('publish', $this->publish);
        $criteria->compare('hits', $this->hits);
        
        $criteria->addCondition('isactive=1');
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public function search_portal() {
        $criteria = new CDbCriteria;
        $start = '0000-00-00';
        $end = '0000-00-00';
        
        $criteria->addCondition('pu_type_id=1');
        
        $criteria->compare('pu_no', $this->pu_no, true);
        
        if(isset($_GET['pu_title']) && $_GET['pu_title'] != ''){
            $pu_title = $_GET['pu_title'];
            if(Yii::app()->session['lang'] == 'en'){
                $criteria->addCondition("sub_act_name_bi LIKE '%$pu_title%'");
            }
            if(Yii::app()->session['lang'] == 'my'){
                $criteria->addCondition("sub_act_name_bm LIKE '%$pu_title%'");
            }
        }
        
        if(isset($_GET['start'])){
            $start = $_GET['start'];
        }
        if(isset($_GET['end'])){
            $end = $_GET['end'];
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
        
        if (!isset($_GET['OstPu_sort']))
            $criteria->order = 't.pu_no ASC';
        
        $criteria->addCondition("isactive = 1");
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    public function search_portal2() {
        $criteria = new CDbCriteria;
        $start = '0000-00-00';
        $end = '0000-00-00';
        
        $criteria->addCondition('pu_type_id=2');
        
        $criteria->compare('pu_no', $this->pu_no, true);
        
        if(isset($_GET['pu_title']) && $_GET['pu_title'] != ''){
            $pu_title = $_GET['pu_title'];
            if(Yii::app()->session['lang'] == 'en'){
                $criteria->addCondition("sub_act_name_bi LIKE '%$pu_title%'");
            }
            if(Yii::app()->session['lang'] == 'my'){
                $criteria->addCondition("sub_act_name_bm LIKE '%$pu_title%'");
            }
        }
        
        if(isset($_GET['start'])){
            $start = $_GET['start'];
        }
        if(isset($_GET['end'])){
            $end = $_GET['end'];
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
        
        if (!isset($_GET['OstPu_sort']))
            $criteria->order = 't.pu_no ASC';
        
        $criteria->addCondition("isactive = 1");
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OstPu the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function beforeSave() {
        $this->updated_by = Yii::app()->session['user_id'];
        $this->updated_dt = new CDbExpression('NOW()');
        if ($this->isNewRecord) {
            $this->created_by = Yii::app()->session['user_id'];
            $this->date_created = new CDbExpression('NOW()');
        }
        return parent::beforeSave();
    }
    
    public function displayActList() {
        $output = '';
        $models = OstPu::model()->findAll(array('order' => 'sub_act_name_bi ASC'));
        $output = CHtml::listData($models, 'id', 'sub_act_name_bi');
        if(Yii::app()->session['lang'] == 'my'){
            $models = OstPu::model()->findAll(array('order' => 'sub_act_name_bm ASC'));
            $output = CHtml::listData($models, 'id', 'sub_act_name_bm');
        }
        return $output;
    }
    
    public function displayAct($ref, $id){
        $output = '';
        if ($ref == 'Act') {
            $model = OstAct::model()->findByPk($id);
            $output = $model->act_name_bi;
        }
        if ($ref == 'Amending Act') {
            $model = OstAmendingAct::model()->findByPk($id);
            $output = $model->act_name_bi;
        }
        if ($ref == 'Pu') {
            $model = OstPu::model()->findByPk($id);
            $output = $model->sub_act_name_bi;
        }
        if ($ref == 'Other Law') {
            $model = OstPerundangan::model()->findByPk($id);
            $output = $model->act_name_bi;
        }
        return $output;
    }
    
    public function displayPortalActTitle($id) {
        $output = '';
        $model = OstPu::model()->findByPk($id);

        $output = "<b><a href='#' target='_blank'>".$model->sub_act_name_bi."</a></b>";
        
        if(Yii::app()->session['lang'] == 'my'){
            $output = "<b><a href='$model->doc_name_pdf' target='_blank'>".$model->sub_act_name_bm."</a></b>";
//            $model2 = OstPuDocument::model()->findAll(array('condition' => "pu_id=$model->id"));
//            if(sizeof($model2) > 0){
//                foreach ($model2 as $row){                    
//                    $output .= "<br><br><b><a href='$row->document' target='_blank'>".$model->sub_act_name_bm."</a></b>";
//                }
//            }
        }
        echo $output;
    }    
    
    public function displayDate($date){
        if($date != ''){
            echo Yii::app()->dateFormatter->format("dd/MM/y", strtotime($date));
        } else {
            $output = 'No date found.';
            if(Yii::app()->session['lang'] == 'my'){
                $output = 'Tiada tarikh dijumpai.';
            }
            echo $output;
        }
    }
    
    public function displayRelatedLegislation($id){
        $output = '';
        $model = OstRelatedLegislation::model()->findByAttributes(array('related_id'=>$id));
        if(sizeof($model) > 0){
            $output = $model->gn_no;
        } else {
            $output = 'No results found.';
            if(Yii::app()->session['lang'] == 'my'){
                $output = 'Tiada maklumat dijumpai.';
            }
        }
        echo $output;
    }
    
    public function displayDownload($id){
        $output = '';
        $title = '';
        $type = '';
        $img='';
        $model = OstPu::model()->findByPk($id);
        
        $arr = explode('pdf', $model->doc_name_pdf);
        $output = '<a href="index.php?r=ostPu/download&id='.$model->id.'" title="'.$arr[0].'pdf"><i class="fa fa-file-pdf-o fa-2x"></i> '. OstRefList::model()->getTranslation("lang") .'</a>';
        
        $model2 = OstPuDocument::model()->findAll(array('condition' => "pu_id=$model->id"));
        if(sizeof($model2) > 0){
            foreach ($model2 as $row){  
                $arr2 = explode('pdf', $row->document);
                if(sizeof($arr2) > 1){
                    $title = $arr2[0];
                    $type='pdf';
                    $img='<i class="fa fa-file-pdf-o fa-2x"></i>';
                    $output .= "<br><br><a href='$row->document' target='_blank' title='$title$type'>$img". OstRefList::model()->getTranslation("lang") ."</a>";
                }
            }
        }
            
        echo $output;
    }
}