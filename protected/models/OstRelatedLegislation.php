<?php

/**
 * This is the model class for table "ost_related_legislation".
 *
 * The followings are the available columns in table 'ost_related_legislation':
 * @property integer $id
 * @property integer $gn_no
 * @property integer $related_id
 * @property string $related_type
 * @property string $title_bm
 * @property string $title_bi
 * @property string $date_proclamation
 * @property string $date_effective
 * @property string $doc_name_bm
 * @property string $doc_name_bi
 * @property string $remarks_bm
 * @property string $remarks_bi
 * @property integer $publish
 * @property string $created_dt
 * @property string $created_by
 * @property string $updated_dt
 * @property string $updated_by
 * @property integer $hits
 */
class OstRelatedLegislation extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ost_related_legislation';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('gn_no, related_id, publish, hits', 'numerical', 'integerOnly' => true),
            array('related_type, title_bm, title_bi, doc_name_bm, doc_name_bi, remarks_bm, remarks_bi, created_by, updated_by', 'length', 'max' => 255),
            array('date_proclamation, date_effective, created_dt, updated_dt', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, gn_no, related_id, related_type, title_bm, title_bi, date_proclamation, date_effective, doc_name_bm, doc_name_bi, remarks_bm, remarks_bi, publish, created_dt, created_by, updated_dt, updated_by, hits', 'safe', 'on' => 'search'),
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
            'gn_no' => 'Gn No',
            'related_id' => 'Related',
            'related_type' => 'Related Type',
            'title_bm' => 'Title Bm',
            'title_bi' => 'Title Bi',
            'date_proclamation' => 'Date Proclamation',
            'date_effective' => 'Date Effective',
            'doc_name_bm' => 'Doc Name Bm',
            'doc_name_bi' => 'Doc Name Bi',
            'remarks_bm' => 'Remarks Bm',
            'remarks_bi' => 'Remarks Bi',
            'publish' => 'Publish',
            'created_dt' => 'Created Dt',
            'created_by' => 'Created By',
            'updated_dt' => 'Updated Dt',
            'updated_by' => 'Updated By',
            'hits' => 'Hits',
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
        $criteria->compare('gn_no', $this->gn_no);
        $criteria->compare('related_id', $this->related_id);
        $criteria->compare('related_type', $this->related_type, true);
        $criteria->compare('title_bm', $this->title_bm, true);
        $criteria->compare('title_bi', $this->title_bi, true);
        $criteria->compare('date_proclamation', $this->date_proclamation, true);
        $criteria->compare('date_effective', $this->date_effective, true);
        $criteria->compare('doc_name_bm', $this->doc_name_bm, true);
        $criteria->compare('doc_name_bi', $this->doc_name_bi, true);
        $criteria->compare('remarks_bm', $this->remarks_bm, true);
        $criteria->compare('remarks_bi', $this->remarks_bi, true);
        $criteria->compare('publish', $this->publish);
        $criteria->compare('created_dt', $this->created_dt, true);
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('updated_dt', $this->updated_dt, true);
        $criteria->compare('updated_by', $this->updated_by, true);
        $criteria->compare('hits', $this->hits);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OstRelatedLegislation the static model class
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

}
