<?php

/**
 * This is the model class for table "ost_ref_list".
 *
 * The followings are the available columns in table 'ost_ref_list':
 * @property integer $id
 * @property string $code
 * @property string $label
 * @property integer $sort
 * @property integer $cat_id
 * @property integer $parent_id
 * @property string $lang
 * @property string $created_dt
 * @property string $created_by
 * @property string $updated_dt
 * @property string $updated_by
 */
class OstRefList extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ost_ref_list';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('code, label, sort', 'required'),
            array('sort, cat_id, parent_id', 'numerical', 'integerOnly' => true),
            array('code, lang', 'length', 'max' => 10),
            array('label, created_by, updated_by', 'length', 'max' => 255),
            array('created_dt, updated_dt', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, code, label, sort, cat_id, parent_id, lang, created_dt, created_by, updated_dt, updated_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            //'cat_rel' => array(self::BELONGS_TO, 'OstRef',array('id'=>'cat_id')),
            //'cat_rel' => array(self::HAS_ONE, 'OstRef', 'id'),
            'cat_rel' => array(self::HAS_ONE, 'OstRef', array('cat' => 'cat_id')),
            'reladmin' => array(self::BELONGS_TO, 'OstUser', '', 'foreignKey' => array('updated_by' => 'id')),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'code' => 'Code',
            'label' => 'Label',
            'sort' => 'Sort',
            'cat_id' => 'Category',
            'parent_id' => 'Parent',
            'lang' => 'Language',
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
    public function search($id) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('label', $this->label, true);
        $criteria->compare('sort', $this->sort);
        $criteria->compare('cat_id', $id);
        $criteria->compare('parent_id', $this->parent_id);
        //$criteria->compare('lang', $this->lang, true);
        $criteria->compare('created_dt', $this->created_dt, true);
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('updated_dt', $this->updated_dt, true);
        $criteria->compare('updated_by', $this->updated_by, true);

        $criteria->with = array('cat_rel');

        $criteria->addCondition("t.lang = 'en'");

        if (!isset($_GET['OstRefList_sort']))
            $criteria->order = 't.updated_dt DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria, 'pagination' => array('pageSize' => 10)
        ));
    }

    public function searchList() {
        $criteria = new CDbCriteria;
        $criteria->compare('label', $this->label, true);
        $criteria->addCondition("t.parent_id = '5'");
        if (!isset($_GET['OstRefList_sort']))
            $criteria->order = 't.created_dt DESC';

        return new CActiveDataProvider($this, array('criteria' => $criteria,));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OstRefList the static model class
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

    public function getdescr() {
        echo $this->code;
    }

    public function displaylang($id) {
        $output = '';
        $model = OstRefList::model()->findAll(array("condition" => "cat_id='8'"));
        if (sizeof($model) > 0) {
            foreach ($model as $row) {
                if ($row->code == 'en') {
                    $output .= '<img src="images/lang/en.png">&nbsp;';
                } else {
                    $model2 = $this->findByAttributes(array('parent_id' => $id));
                    if (sizeof($model2) > 0 && $model2->label != '') {
                        $output .= '<img src="images/lang/my.png">&nbsp;';
                    } else {
                        $output .= '<img src="images/lang/my.png" style="opacity:0.2;">&nbsp;';
                    }
                }
            }
        }
        echo $output;
    }

    public function listRef3($cat_id) {
        //$models = OstRef::model()->findAll("cat='$cat' ORDER BY id ASC");
        $models = OstRefList::model()->findAll("cat_id='$cat_id' ORDER BY sort ASC");
        return CHtml::listData($models, 'code', 'label');
    }

    public function getRefLabel($cat_id, $code) {
        $model = OstRefList::model()->findByAttributes(array('cat_id' => $cat_id, 'code' => $code));
        return $model['label'];
    }

    public function getTranslation($code) {
        $output = '';
        $model = OstRefList::model()->findByAttributes(array('cat_id' => 7, 'code' => $code));
        $output = $model->label;
        if (Yii::app()->session['lang'] == 'my') {
            $model2 = OstRefList::model()->findByAttributes(array('parent_id' => $model->id));
            $output = $model2->label;
        }
        return $output;
    }

}
