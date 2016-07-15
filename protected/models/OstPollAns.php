<?php

/**
 * This is the model class for table "ost_poll_ans".
 *
 * The followings are the available columns in table 'ost_poll_ans':
 * @property integer $id
 * @property integer $question_id
 * @property string $answer
 * @property integer $parent_id
 * @property string $lang
 */
class OstPollAns extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ost_poll_ans';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question_id, parent_id', 'numerical', 'integerOnly'=>true),
			array('answer', 'length', 'max'=>255),
			array('lang', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, question_id, answer, parent_id, lang', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'question_id' => 'Question',
			'answer' => 'Answer',
			'parent_id' => 'Parent',
			'lang' => 'Lang',
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
		$criteria->compare('question_id',$this->question_id);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('lang',$this->lang,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OstPollAns the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function displaylang() {
        $output = '<img src="images/lang/en.png">&nbsp;';
        $model = OstPollAns::model()->findAllByAttributes(array('parent_id' => $this->id));
        if (sizeof($model) > 0) {
            foreach ($model as $row) {
                if ($row['answer'] == '')
                    $output .= '<img src="images/lang/my.png" style="opacity:0.2;">&nbsp;';
                else
                    $output .= '<img src="images/lang/my.png">&nbsp;';
            }
        }
        echo $output;
        }
}
