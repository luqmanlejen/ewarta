<?php

/**
 * This is the model class for table "ost_version_act".
 *
 * The followings are the available columns in table 'ost_version_act':
 * @property integer $id
 * @property integer $act_id
 * @property integer $version_act_id
 * @property string $created_dt
 * @property string $created_by
 * @property string $updated_dt
 * @property string $updated_by
 * @property integer $publish
 * @property string $doc_name_bi
 * @property string $doc_name_bm
 * @property string $remarks
 * @property integer $isactive
 * @property integer $hits
 * @property string $version_year
 */
class OstVersionAct extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ost_version_act';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('act_id, version_act_id, publish, isactive, hits', 'numerical', 'integerOnly' => true),
            array('created_by, updated_by', 'length', 'max' => 50),
            array('doc_name_bi, doc_name_bm', 'length', 'max' => 150),
            array('remarks_bi, remarks_bm', 'length', 'max' => 255),
            array('version_year', 'length', 'max' => 4),
            array('created_dt, updated_dt', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, act_id, version_act_id, created_dt, created_by, updated_dt, updated_by, publish, doc_name_bi, doc_name_bm, remarks_bi, remarks_bm, isactive, hits, version_year', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'reladmin' => array(self::BELONGS_TO, 'OstUser', '', 'foreignKey' => array('updated_by' => 'id')),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'act_id' => 'Act',
            'version_act_id' => 'Version Act',
            'created_dt' => 'Created Dt',
            'created_by' => 'Created By',
            'updated_dt' => 'Updated Dt',
            'updated_by' => 'Updated By',
            'publish' => 'Publish',
            'doc_name_bi' => 'Doc Name Bi',
            'doc_name_bm' => 'Doc Name Bm',
            'remarks_bi' => 'Remarks',
            'remarks_bm' => 'Remarks',
            'isactive' => 'Isactive',
            'hits' => 'Hits',
            'version_year' => 'Version Year',
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
        $criteria->compare('act_id', $this->act_id);
        $criteria->compare('version_act_id', $this->version_act_id);
        $criteria->compare('created_dt', $this->created_dt, true);
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('updated_dt', $this->updated_dt, true);
        $criteria->compare('updated_by', $this->updated_by, true);
        $criteria->compare('publish', $this->publish);
        $criteria->compare('doc_name_bi', $this->doc_name_bi, true);
        $criteria->compare('doc_name_bm', $this->doc_name_bm, true);
        $criteria->compare('remarks_bi', $this->remarks_bi, true);
        $criteria->compare('remarks_bm', $this->remarks_bm, true);
        $criteria->compare('isactive', $this->isactive);
        $criteria->compare('hits', $this->hits);
        $criteria->compare('version_year', $this->version_year, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public function search_portal() {
        $criteria = new CDbCriteria;
        $start = '0000-00-00';
        $end = '0000-00-00';
        
        $criteria->compare('act_id', $this->act_id, true);
        $criteria->compare('version_act_id', $this->version_act_id, true);
        
        if(isset($_GET['start'])){
            $start = $_GET['start'];
        }
        if(isset($_GET['end'])){
            $end = $_GET['end'];
        }
        
        //$sql = OstAct::model()->findAll(array('condition' => "date_proclamation >= '$start' AND date_proclamation <= '$end'"));
        //echo sizeof($sql);
        
        if (!isset($_GET['OstVersionAct_sort']))
            $criteria->order = 't.act_id ASC';
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OstVersionAct the static model class
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

    public function displaylang($id) {
        $output = '';
        $model = OstVersionAct::model()->findByPk($id);
        if (sizeof($model) > 0) {
            if ($model->doc_name_bi != '') {
                $output .= '<img src="images/lang/en.png">&nbsp;';
            } else {
                $output .= '<img src="images/lang/en.png" style="opacity:0.2;">&nbsp;';
            }
            if ($model->doc_name_bm != '') {
                $output .= '<img src="images/lang/my.png">&nbsp;';
            } else {
                $output .= '<img src="images/lang/my.png" style="opacity:0.2;">&nbsp;';
            }
        }
        echo $output;
    }

    public function getVersionActType($code) {
        $output = '';
        $model = OstRefList::model()->findByAttributes(array('cat_id'=>6, 'code'=>$code));
        $output = $model->label;
        if(Yii::app()->session['lang'] ==  'my'){
            $model2 = OstRefList::model()->findByAttributes(array('parent_id'=>$model->id));
            $output = $model2->label;
        }
        echo $output;
    }
    
    public function displayPortalActTitle($id) {
        $output = '';
        $model = OstAct::model()->findByPk($id);
        
        $remarks = 'No remarks.';
        if($model->remarks_bi != ''){
            $remarks = $model->remarks_bi;
        }
        $output .= "<b><a href='$model->doc_name_bi' target='_blank'>".$model->act_name_bi."</a></b><br>
                    Remark: $remarks<br><br>";
        
        $remarks = 'Tiada Catatan.';
        if($model->remarks_bi != ''){
            $remarks = $model->remarks_bi;
        }
        $output .= "<b><a href='$model->doc_name_bm' target='_blank'>".$model->act_name_bm."</a></b><br>
                    Catatan: $remarks";
        
        echo $output;
    }   
}
