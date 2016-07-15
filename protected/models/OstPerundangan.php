<?php

/**
 * This is the model class for table "ost_perundangan".
 *
 * The followings are the available columns in table 'ost_perundangan':
 * @property integer $id
 * @property string $no_act
 * @property string $act_name_bi
 * @property string $act_name_bm
 * @property string $doc_name_bi
 * @property string $doc_name_bm
 * @property string $remarks_bm
 * @property integer $pages
 * @property integer $publish
 * @property integer $user_id
 * @property integer $created_by
 * @property string $created_dt
 * @property integer $updated_by
 * @property string $updated_dt
 * @property string $remarks_bi
 * @property integer $hits
 * @property integer $year
 * @property integer $isactive
 * @property integer $idasal
 * @property integer $act_type
 */
class OstPerundangan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ost_perundangan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pages, publish, user_id, created_by, updated_by, hits, year, isactive, idasal, act_type', 'numerical', 'integerOnly'=>true),
			array('no_act, act_name_bi, act_name_bm, doc_name_bi, doc_name_bm', 'length', 'max'=>250),
			array('remarks_bm, created_dt, updated_dt, remarks_bi', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, no_act, act_name_bi, act_name_bm, doc_name_bi, doc_name_bm, remarks_bm, pages, publish, user_id, created_by, created_dt, updated_by, updated_dt, remarks_bi, hits, year, isactive, idasal, act_type', 'safe', 'on'=>'search'),
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
			'no_act' => 'No Act',
			'act_name_bi' => 'Act Name Bi',
			'act_name_bm' => 'Act Name Bm',
			'doc_name_bi' => 'Doc Name Bi',
			'doc_name_bm' => 'Doc Name Bm',
			'remarks_bm' => 'Remarks Bm',
			'pages' => 'Pages',
			'publish' => 'Publish',
			'user_id' => 'User',
			'created_by' => 'Created By',
			'created_dt' => 'Created Dt',
			'updated_by' => 'Updated By',
			'updated_dt' => 'Updated Dt',
			'remarks_bi' => 'Remarks Bi',
			'hits' => 'Hits',
			'year' => 'Year',
			'isactive' => 'Isactive',
			'idasal' => 'Idasal',
			'act_type' => 'Act Type',
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
		$criteria->compare('no_act',$this->no_act,true);
		$criteria->compare('act_name_bi',$this->act_name_bi,true);
		$criteria->compare('act_name_bm',$this->act_name_bm,true);
		$criteria->compare('doc_name_bi',$this->doc_name_bi,true);
		$criteria->compare('doc_name_bm',$this->doc_name_bm,true);
		$criteria->compare('remarks_bm',$this->remarks_bm,true);
		$criteria->compare('pages',$this->pages);
		$criteria->compare('publish',$this->publish);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_dt',$this->created_dt,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_dt',$this->updated_dt,true);
		$criteria->compare('remarks_bi',$this->remarks_bi,true);
		$criteria->compare('hits',$this->hits);
		$criteria->compare('year',$this->year);
		$criteria->compare('isactive',$this->isactive);
		$criteria->compare('idasal',$this->idasal);
		$criteria->compare('act_type',$this->act_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OstPerundangan the static model class
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

    public function displaylang($id) {
        $output = '';
        $model = OstPerundangan::model()->findByPk($id);
        if (sizeof($model) > 0) {
            if ($model->act_name_bi != '') {
                $output .= '<img src="images/lang/en.png">&nbsp;';
            } else {
                $output .= '<img src="images/lang/en.png" style="opacity:0.2;">&nbsp;';
            }
            if ($model->act_name_bm != '') {
                $output .= '<img src="images/lang/my.png">&nbsp;';
            } else {
                $output .= '<img src="images/lang/my.png" style="opacity:0.2;">&nbsp;';
            }
        }
        echo $output;
    }
    public function displayActName($id) {
        $output = '';
        $model = OstPerundangan::model()->findByPk($id);
        if(sizeof($model) > 0){
            if ($model->act_name_bi != '' && $model->doc_name_bi != '') {
                $output .= "<b><a href='$model->doc_name_bi' target='_blank'>".$model->act_name_bi."</a></b>";
                $output .= "<br>";
            } else {
                $output .= "<b>".$model->act_name_bi."</b>";
                $output .= "<br>";
            }
            if ($model->act_name_bm != '' && $model->doc_name_bm != '') {
                $output .= "<a href='$model->doc_name_bm' target='_blank'>".$model->act_name_bm."</a>";
            } else {
                $output .= $model->act_name_bm;
            }
        }
        echo $output;
    }
    
    public function displayActList() {
        $output = '';
        $models = OstPerundangan::model()->findAll();
        $output = CHtml::listData($models, 'id', 'act_name_bi');
        if(Yii::app()->session['lang'] == 'my'){
            $output = CHtml::listData($models, 'id', 'act_name_bm');
        }
        return $output;
    }
}
