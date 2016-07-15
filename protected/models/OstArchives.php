<?php

/**
 * This is the model class for table "ost_archives".
 *
 * The followings are the available columns in table 'ost_archives':
 * @property integer $id
 * @property string $value
 * @property string $label
 */
class OstArchives extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ost_archives';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('label', 'length', 'max'=>100),
                        array('value', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, value', 'safe', 'on'=>'search'),
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
                    'label_rel' => array(self::BELONGS_TO, 'OstRefList', array('value' => 'id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'value' => 'Value',
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
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OstArchives the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
    public function displaylist($menu_id, $ref) {
        $role_arr = OstRefList::model()->listRef3($ref);
        $selected_role_arr = array();
        
        echo $menu_id;
        if ($menu_id != '') {
            $model = $this->findAll(array("condition" => "id = " . $menu_id));
            if (sizeof($model) > 0) {
                foreach ($model as $row) {
                    $selected_role_arr[] = $row->value;
                }
            }
        }
        print_r($selected_role_arr);
            return CHtml::checkBoxList('OstArchives[value][]', $selected_role_arr, $role_arr);
    }
    
    public function getlist(){
        $model = OstArchives::model()->findAll();
        return CHtml::listData(OstArchives::model()->findAll(), 'id', 'value');
    }
}
