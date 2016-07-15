<?php

/**
 * This is the model class for table "ost_lom".
 *
 * The followings are the available columns in table 'ost_lom':
 * @property integer $id
 * @property string $lom_type
 * @property string $lom_no
 * @property integer $lom_year
 * @property integer $lom_cat
 * @property string $lom_title
 * @property string $lom_doc
 * @property integer $lom_rev
 * @property integer $lom_year_rev
 * @property integer $lom_parent_act
 * @property integer $lom_parent_lang
 * @property string $lom_lang
 * @property string $created_dt
 * @property string $created_by
 * @property string $updated_dt
 * @property string $updated_by
 * @property integer $hits
 * @property integer $online
 */
class OstLom extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ost_lom';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('lom_type, lom_no, lom_year', 'required'),
            array('lom_year, lom_cat, lom_rev, lom_year_rev, lom_parent_act, lom_parent_lang, hits, online, reprint', 'numerical', 'integerOnly' => true),
            array('lom_type, lom_lang', 'length', 'max' => 10),
            array('lom_no, lom_title, lom_doc, created_by, updated_by', 'length', 'max' => 255),
            array('created_dt, updated_dt,lom_doc,lom_cat,lom_parent_act, lom_type', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, lom_type, lom_no, lom_year, lom_cat, lom_title, lom_doc, lom_rev, lom_year_rev, lom_parent_act, lom_parent_lang, lom_lang, created_dt, created_by, updated_dt, updated_by, hits, online', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'categories_rel' => array(self::BELONGS_TO, 'OstCategories', array('lom_cat' => 'id')),
            'author_rel' => array(self::BELONGS_TO, 'OstUser', array('updated_by' => 'id')),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'lom_type' => 'Publication Type',
            'lom_no' => 'No.',
            'lom_year' => 'Year',
            'lom_cat' => 'Category',
            'lom_title' => 'Title',
            'lom_title_my' => 'Title',
            'lom_doc' => 'Document',
            'lom_doc_my' => 'Document',
            'lom_rev' => 'Revised',
            'lom_year_rev' => 'Revised Year',
            'lom_parent_act' => 'Under Act',
            'lom_parent_lang' => 'Parent Lang',
            'lom_lang' => 'Language',
            'created_dt' => 'Created Date',
            'created_by' => 'Created By',
            'updated_dt' => 'Updated Date',
            'updated_by' => 'Updated By',
            'hits' => 'Hits',
            'online' => 'Online Version',
            'reprint' => 'Reprint',
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

//		$criteria->compare('id',$this->id);
//		$criteria->compare('lom_type',$this->lom_type,true);
//		$criteria->compare('lom_no',$this->lom_no,true);
//		$criteria->compare('lom_year',$this->lom_year);
//		$criteria->compare('lom_cat',$this->lom_cat);
        $criteria->compare('lom_title', $this->lom_title, true);
//		$criteria->compare('lom_doc',$this->lom_doc,true);
//		$criteria->compare('lom_rev',$this->lom_rev);
//		$criteria->compare('lom_year_rev',$this->lom_year_rev);
//		$criteria->compare('lom_parent_act',$this->lom_parent_act);
//		$criteria->compare('lom_parent_lang',$this->lom_parent_lang);
//		$criteria->compare('lom_lang',$this->lom_lang,true);
//		$criteria->compare('created_dt',$this->created_dt,true);
//		$criteria->compare('created_by',$this->created_by,true);
//		$criteria->compare('updated_dt',$this->updated_dt,true);
//		$criteria->compare('updated_by',$this->updated_by,true);

        if ($this->lom_no != 0)
            $criteria->addcondition('t.lom_no = ' . $this->lom_no);
        $criteria->addCondition("t.lom_lang = 'en'");

        if ($this->lom_no === '')
            $criteria->compare('lom_title', $this->lom_title, true);

        if (!isset($_GET['OstLom_sort'])) {
            $criteria->order = 't.updated_dt DESC';
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria, 'pagination' => array('pageSize' => 10)
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
        
        //$sql = OstAct::model()->findAll(array('condition' => "date_proclamation >= '$start' AND date_proclamation <= '$end'"));
        //echo sizeof($sql);
        
        if(isset($_GET['start']) && isset($_GET['end'])){
            $criteria->addCondition("date_proclamation >= '$start' AND date_proclamation <= '$end'");
        }
        
        if (!isset($_GET['OstLom_sort']))
            $criteria->order = 't.lom_no ASC';
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OstLom the static model class
     */
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

    public function displaylang() {
        $output = '';
        $model = OstLom::model()->findByPk($this->id);
        $model2 = OstLom::model()->findByAttributes(array('lom_parent_lang' => $this->id));
        
        if($model->lom_doc != ''){
            $output .= '<img src="images/lang/en.png">&nbsp;';
        } else {
            $output .= '<img src="images/lang/en.png" style="opacity:0.2;">&nbsp;';
        }
        if($model2->lom_doc != ''){
            $output .= '<img src="images/lang/my.png">&nbsp;';
        } else {
            $output .= '<img src="images/lang/my.png" style="opacity:0.2;">&nbsp;';
        }

        echo $output;

//        $output = '<img src="images/lang/en.png">&nbsp;';
//        $model = OstLom::model()->findAllByAttributes(array('lom_parent_lang' => $this->id));
//        if (sizeof($model) > 0) {
//            foreach ($model as $row) {
//                if ($row['lom_doc'] == '')
//                    $output .= '<img src="images/lang/my.png" style="opacity:0.2;">&nbsp;';
//                else
//                    $output .= '<img src="images/lang/my.png">&nbsp;';
//            }
//        }
//        echo $output;
    }

//    public function getparent() {
//        $output = array('0' => '-- Please Choose --');
////        if ($parent_cat != '') {
//            $model = $this->findAll(array("condition" => "lom_cat=0 AND lom_lang='en' AND lom_type='act' ORDER BY updated_dt DESC"));            
//            if (sizeof($model) > 0) {
//                foreach ($model as $row) {
//                    $output[$row->id] = $row->lom_title;
//                    $this->getsub($row->id, $output, 0);
//                }
//            }
////        }
//        return $output;
//    }
//    public function getsub($lom_cat, &$output, $count) {
//
//        $model = $this->findAll(array("condition" => "lom_cat=$lom_cat AND lom_lang='en' AND lom_type='act' ORDER BY updated_dt DESC"));
//        if (sizeof($model) > 0) {
//            $count++;
//            foreach ($model as $key => $row) {
//                $output[$row->id] = $this->getmarker($count) . ' ' . ($key + 1) . '. ' . $row->lom_title;
//                $this->getsub($row->id, $output, $count);
//            }
//        }
//
//        return $output;
//    }
//    public function getmarker($total) {
//        $marker = '';
//        for ($x = 0; $x < $total; $x++) {
//            $marker.= '__';
//        }
//        return $marker;
//    }

    public function getcategory() {
        //$model = OstCategories::model()->findAll(array("condition"=>"SELECT * FROM ost_categories"));
        //return CHtml::listData($model, 'type', 'title');

        $sql = "SELECT id, title FROM ost_categories WHERE type='act' ORDER BY id ASC";
        $conn = Yii::app()->db->createCommand($sql);
        $rs = $conn->query();


        $moduleArray = CHtml::listData($rs, 'id', 'title');

        return $moduleArray;
    }

    public function getparent() {
        $output = array('0' => '-- Please Choose --');
//        if ($parent_cat != '') {
        $model = OstCategories::model()->findAll(array("condition" => "parent_cat=0 AND type='act' ORDER BY id ASC"));
        if (sizeof($model) > 0) {
            foreach ($model as $row) {
                $output[$row->id] = $row->title;
            }
        }
//        }
        return $output;
    }

    public function getparent2() {
        $output = array('0' => '-- Please Choose --');
//        if ($parent_cat != '') {
        $model = OstCategories::model()->findAll(array("condition" => "parent_cat=0 AND type='act' ORDER BY id ASC"));
        if (sizeof($model) > 0) {
            foreach ($model as $row) {
                $output[$row->id] = $row->title;
                $this->getsub($row->id, $output, 0);
            }
        }
//        }
        return $output;
    }

    public function getsub($list, &$output, $count) {

        $model = OstCategories::model()->findAll(array("condition" => "parent_cat=$list AND type='act' ORDER BY id ASC"));
        if (sizeof($model) > 0) {
            $count++;
            foreach ($model as $key => $row) {
                $output[$row->id] = $this->getmarker($count) . ' ' . ($key + 1) . '. ' . $row->title;
                $this->getsub($row->id, $output, $count);
            }
        }

        return $output;
    }

    public function getmarker($total) {
        $marker = '';
        for ($x = 0; $x < $total; $x++) {
            $marker.= '__';
        }
        return $marker;
    }

    public function displaytype($lom_type) {
        $model = OstRefList::model()->findAll(array('condition' => 'cat_id=6'));
        $model2 = OstLom::model()->findByAttributes(array('lom_type'=>$lom_type));
        
        foreach ($model as $row){
            if($model2->lom_type == 75){
                return 'Peraturan/Kaedah/Subdisiari';
            } else if($model2->lom_type == 77){
                return 'Federal Constitution';
            } else {
                return 'Act';
            }
        }
        
    }

    public function displayrev() {

        if ($this->lom_rev === '1')
            return $this->lom_year_rev;
        else {
            $this->lom_year_rev = '';
            return $this->lom_year_rev;
        }
    }

    public function getactname($lom_parent_act) {

        $output = '';

        $model = OstLom::model()->findAll(array("condition" => "lom_no='$lom_parent_act' AND lom_type='act' AND online=0"));

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                $output.= $row->lom_title;
            }
        }

        return $output;
    }

    public function getparent3() {
        $output = array('0' => '-- Please Choose --');

//        if ($lom_type != '') {

        $model = OstCategories::model()->findAll(array("condition" => "parent_cat='0' AND type='act' ORDER BY id ASC"));

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                $output[$row->id] = $row->title;

                $this->getsub($row->id, $output, 0);
            }
        }
//        }

        return $output;
    }
    
    public function getlomtype() {
        $output = array('0' => '--Please Choose--');
//        if ($parent_cat != '') {
        $model = OstRefList::model()->findAll(array("condition" => "cat_id=6 ORDER BY sort ASC"));
        if (sizeof($model) > 0) {
            foreach ($model as $row) {
                $output[$row->id] = $row->label;
                //$this->getsub($row->id, $output, 0);
            }
        }
//        }
        return $output;
    }

}
