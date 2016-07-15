<?php

/**
 * This is the model class for table "ost_media".
 *
 * The followings are the available columns in table 'ost_media':
 * @property integer $id
 * @property string $media_type
 * @property string $title
 * @property string $img
 * @property string $url
 * @property integer $parent_id
 * @property string $lang
 * @property string $created_dt
 * @property string $created_by
 * @property string $updated_dt
 * @property string $updated_by
 * @property integer $sort
 */
class OstMedia extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ost_media';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title', 'required'),
            array('parent_id, sort', 'numerical', 'integerOnly' => true),
            array('status', 'length', 'max' => 20),
            array('media_type, lang', 'length', 'max' => 10),
            array('title, img, url, created_by, updated_by', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, media_type, title, img, url, parent_id, lang, created_dt, created_by, updated_dt, updated_by, status, sort', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
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
            'media_type' => 'Media Type',
            'title' => 'Title',
            'status' => 'Status',
            'img' => 'Image',
            'url' => 'Url',
            'parent_id' => 'Parent',
            'lang' => 'Language',
            'created_dt' => 'Created Date',
            'created_by' => 'Created By',
            'updated_dt' => 'Updated Date',
            'updated_by' => 'Updated By',
            'sort' => 'Sort',
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
        $criteria->compare('media_type', $this->media_type, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('img', $this->img, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('lang', $this->lang, true);
        $criteria->compare('created_dt', $this->created_dt, true);
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('updated_dt', $this->updated_dt, true);
        $criteria->compare('updated_by', $this->updated_by, true);

        if (isset($_GET['media_type'])) {
            $criteria->addCondition('t.media_type = "' . $_GET['media_type'] . '"');
        }

        $criteria->order = 't.sort DESC';
        
        //if (!isset($_GET['OstMedia_sort']))
        //    $criteria->order = 't.updated_dt DESC';

        $criteria->addCondition("t.lang='en'");

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria, 'pagination' => array('pageSize' => 10)
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OstMedia the static model class
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
        $output = '<img src="images/lang/en.png">&nbsp;';
        $model = ostMedia::model()->findAllByAttributes(array('parent_id' => $this->id));
        if (sizeof($model) > 0) {
            foreach ($model as $row) {
                if ($row['title'] == '')
                    $output .= '<img src="images/lang/my.png" style="opacity:0.2;">&nbsp;';
                else
                    $output .= '<img src="images/lang/my.png">&nbsp;';
            }
        }
        echo $output;
    }
    
    public function displaystatus($id){
        $model = OstMedia::findByPk($id);
        if($model->status == 'psh'){
            return 'Publish';
        } else {
            return 'Archive';
        }
    }
    
}
