<?php

/**
 * This is the model class for table "ost_ref".
 *
 * The followings are the available columns in table 'ost_ref':
 * @property integer $id
 * @property string $code
 * @property string $cat
 * @property string $descr
 * @property string $created_dt
 * @property string $created_by
 * @property string $updated_dt
 * @property string $updated_by
 */
class OstRef extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ost_ref';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('code, cat, descr', 'required'),
            array('code', 'length', 'max' => 10),
            array('cat, created_by, updated_by', 'length', 'max' => 255),
            array('created_dt, created_by, updated_dt, updated_by', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, code, cat, descr, created_dt, created_by, updated_dt, updated_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            //'list_rel' => array(self::BELONGS_TO, 'OstRefList', array('id' => 'cat_id')),
            //'reladmin' => array(self::BELONGS_TO, 'OstUser', '', 'foreignKey' => array('updated_by' => 'user_id')),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'code' => 'Code',
            'cat' => 'Category',
            'descr' => 'Description',
            'created_dt' => 'Created Date',
            'created_by' => 'Created By',
            'updated_dt' => 'Updated Date',
            'updated_by' => 'Updated By',
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
        $criteria->compare('code', $this->code, true);
        $criteria->compare('cat', $this->cat, true);
        $criteria->compare('descr', $this->descr, true);
        $criteria->compare('created_dt', $this->created_dt, true);
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('updated_dt', $this->updated_dt, true);
        $criteria->compare('updated_by', $this->updated_by, true);
        
        if (!isset($_GET['OstRef_sort']))
            $criteria->order = 'cat ASC';
        
        return new CActiveDataProvider($this, array('criteria' => $criteria, 'pagination' => array('pageSize' => 10)));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RefCat the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave() {
        $this->updated_by = Yii::app()->session['user_id'];//Yii::app()->user->id;;
        $this->updated_dt = new CDbExpression('NOW()');
        if ($this->isNewRecord) {
            $this->created_by = Yii::app()->session['user_id'];//Yii::app()->user->id;
            $this->created_dt = new CDbExpression('NOW()');
        }
        return parent::beforeSave();
    }
    
    public function getdescr() {
        echo $this->descr;
    }
}