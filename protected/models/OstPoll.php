<?php

/**
 * This is the model class for table "ost_poll".
 *
 * The followings are the available columns in table 'ost_poll':
 * @property integer $id
 * @property string $question
 * @property integer $status
 * @property integer $parent_id
 * @property string $lang
 * @property string $created_dt
 * @property string $created_by
 * @property string $updated_dt
 * @property string $updated_by
 */
class OstPoll extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ost_poll';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('created_dt, created_by, updated_dt, updated_by', 'required'),
			array('status, parent_id', 'numerical', 'integerOnly'=>true),
			array('question, created_by, updated_by', 'length', 'max'=>255),
			array('lang', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, question, status, parent_id, lang, created_dt, created_by, updated_dt, updated_by', 'safe', 'on'=>'search'),
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
                    'relmenu' => array(self::BELONGS_TO, 'OstMenuPortal', '', 'foreignKey' => array('menu_id' => 'id')),
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
			'question' => 'Question',
			'status' => 'Status',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('question',$this->question,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('lang',$this->lang,true);
		$criteria->compare('created_dt',$this->created_dt,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated_dt',$this->updated_dt,true);
		$criteria->compare('updated_by',$this->updated_by,true);

		if (!isset($_GET['OstPoll_sort']))
                    $criteria->order = 't.updated_dt DESC';
                
                $criteria->addCondition("t.parent_id = '0'");
                $criteria->addCondition("t.lang='en'");
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria, 'pagination' => array('pageSize' => 10)
                    ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OstPoll the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function displaylang() {
        $output = '<img src="images/lang/en.png">&nbsp;';
        $model = OstPoll::model()->findAllByAttributes(array('parent_id' => $this->id));
        if (sizeof($model) > 0) {
            foreach ($model as $row) {
                if ($row['question'] == '')
                    $output .= '<img src="images/lang/my.png" style="opacity:0.2;">&nbsp;';
                else
                    $output .= '<img src="images/lang/my.png">&nbsp;';
            }
        }
        echo $output;
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
    
}
