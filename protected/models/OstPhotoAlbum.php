<?php

/**
 * This is the model class for table "ost_photo_album".
 *
 * The followings are the available columns in table 'ost_photo_album':
 * @property integer $id
 * @property string $title
 * @property string $descr
 * @property string $event_dt
 * @property integer $parent_id
 * @property string $lang
 * @property string $created_dt
 * @property string $created_by
 * @property string $updated_dt
 * @property string $updated_by
 * @property integer $sort
 */
class OstPhotoAlbum extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ost_photo_album';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, descr', 'required'),
			array('parent_id, sort', 'numerical', 'integerOnly'=>true),
			array('title, created_by, updated_by', 'length', 'max'=>255),
			array('lang', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, descr, event_dt, parent_id, lang, created_dt, created_by, updated_dt, updated_by, sort', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'reladmin' => array(self::BELONGS_TO, 'OstUser', '', 'foreignKey' => array('updated_by' => 'id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'descr' => 'Description',
			'event_dt' => 'Event Date',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('descr',$this->descr,true);
		$criteria->compare('event_dt',$this->event_dt,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('lang',$this->lang,true);
		$criteria->compare('created_dt',$this->created_dt,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated_dt',$this->updated_dt,true);
		$criteria->compare('updated_by',$this->updated_by,true);
                $criteria->compare('sort',$this->sort,true);
                
                $criteria->addCondition("t.lang = 'en'");
                $criteria->order = 't.sort ASC';
                
//                if (!isset($_GET['OstPhotoAlbum_sort']))
//                    $criteria->order = 't.updated_dt DESC';
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria, 'pagination'=> array('pageSize'=>10)
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OstPhotoAlbum the static model class
	 */
	public static function model($className=__CLASS__)
	{
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
        $model = OstPhotoAlbum::model()->findAllByAttributes(array('parent_id' => $this->id));
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
        $model = OstPhotoAlbum::findByPk($id);
        if($model->status == 'psh'){
            return 'Publish';
        } else {
            return 'Archive';
        }
    }
}
