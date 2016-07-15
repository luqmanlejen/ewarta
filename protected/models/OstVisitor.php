<?php

/**
 * This is the model class for table "ost_visitor".
 *
 * The followings are the available columns in table 'ost_visitor':
 * @property integer $id
 * @property string $dtvisit
 * @property integer $total
 */
class OstVisitor extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ost_visitor';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('total', 'numerical', 'integerOnly' => true),
            array('dtvisit', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, dtvisit, total', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'dtvisit' => 'Dtvisit',
            'total' => 'Total',
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
        $criteria->compare('dtvisit', $this->dtvisit, true);
        $criteria->compare('total', $this->total);

        return new CActiveDataProvider($this, array('criteria' => $criteria,));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OstVisitor the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function AddVisitor() {

        date_default_timezone_set('Asia/Kuala_Lumpur');

        $today = date('Y-m-d');

        $model = $this->findByAttributes(array('dtvisit' => $today));

        if (sizeof($model) > 0) {

            //update

            $model2 = $this->findByPk($model->id);

            $model2->total = (1 + $model->total);

            $model2->save();
        } else {

            //add new

            $model2 = new OstVisitor;

            $model2->dtvisit = $today;

            $model2->total = 1;

            $model2->save();
        }
    }

    public function GetAll() {

        date_default_timezone_set('Asia/Kuala_Lumpur');

        $model = $this->findAll();

        $total = 0;

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                $total+= (int) $row->total;
            }
        }

        return $total;
    }

    public function GetToday() {

        date_default_timezone_set('Asia/Kuala_Lumpur');

        $today = date('Y-m-d');

        $model = $this->findAll(array("condition" => "dtvisit='$today'"));

        $total = 0;

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                $total+= (int) $row->total;
            }
        }

        return $total;
    }

    public function GetYesterday() {

        date_default_timezone_set('Asia/Kuala_Lumpur');

        $yesterday = date("Y-m-d", strtotime('-1 days'));

        $model = $this->findAll(array("condition" => "dtvisit='$yesterday'"));

        $total = 0;

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                $total+= (int) $row->total;
            }
        }

        return $total;
    }

    public function GetThisMonth() {

        date_default_timezone_set('Asia/Kuala_Lumpur');

        $model = $this->findAll(array("condition" => "YEAR(dtvisit)=" . date('Y') . " AND MONTH(dtvisit)=" . date('m')));

        $total = 0;

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                $total+= (int) $row->total;
            }
        }

        return $total;
    }

    public function GetLastMonth() {

        date_default_timezone_set('Asia/Kuala_Lumpur');

        $model = $this->findAll(array("condition" => "YEAR(dtvisit)=" . date('Y') . " AND MONTH(dtvisit)=" . date("m", strtotime('-1 month'))));

        $total = 0;

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                $total+= (int) $row->total;
            }
        }

        return $total;
    }

    public function GetThisWeek() {

        $startday = date("Y-m-d", strtotime('Last Monday'));

        $lastday = date("Y-m-d", strtotime('Next Sunday'));

        date_default_timezone_set('Asia/Kuala_Lumpur');

        $model = $this->findAll(array("condition" => "dtvisit BETWEEN '$startday' AND '$lastday'"));

        $total = 0;

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                $total+= (int) $row->total;
            }
        }

        return $total;
    }

    public function GetLastWeek() {

        $lastday = date("Y-m-d", strtotime('Sunday Last Week'));

        $startday = date('Y-m-d', (strtotime('-6 day', strtotime($lastday))));

        date_default_timezone_set('Asia/Kuala_Lumpur');

        $model = $this->findAll(array("condition" => "dtvisit BETWEEN '$startday' AND '$lastday'"));

        $total = 0;

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                $total+= (int) $row->total;
            }
        }

        return $total;
    }

}
