<?php

/**
 * This is the model class for table "ost_audit_trail".
 *
 * The followings are the available columns in table 'ost_audit_trail':
 * @property integer $id
 * @property string $user_id
 * @property string $action_datetime
 * @property integer $menu_id
 * @property string $action_type
 * @property integer $data_id
 */
class OstAuditTrail extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ost_audit_trail';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, action_datetime, menu_id, action_type', 'required'),
            array('menu_id, data_id', 'numerical', 'integerOnly' => true),
            array('user_id', 'length', 'max' => 255),
            array('action_type', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, action_datetime, menu_id, action_type, data_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'reladmin' => array(self::BELONGS_TO, 'OstUser', '', 'foreignKey' => array('user_id' => 'id')),
            'relmenu' => array(self::BELONGS_TO, 'OstMenu', '', 'foreignKey' => array('menu_id' => 'id')),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'action_datetime' => 'Date',
            'dt_from' => 'Date From',
            'dt_to' => 'Date To',
            'menu_id' => 'Menu',
            'action_type' => 'Action',
            'data_id' => 'Data',
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
        $dt_from = '';
        $dt_to = '';

        if (isset($_GET['daterange']) && $_GET['daterange'] != '') {
            $daterange_explode = explode(' - ', $_GET['daterange']);
            $display_startdt_exp = explode('/', $daterange_explode[0]);
            $display_enddt = explode('/', $daterange_explode[1]);

            $dt_from = $display_startdt_exp[2] . '-' . $display_startdt_exp[1] . '-' . $display_startdt_exp[0];
            $dt_to2 = $display_enddt[2] . '-' . $display_enddt[1] . '-' . $display_enddt[0];
            $dt_to = date('Y-m-d', strtotime($dt_to2 . "+1 days"));

            //$criteria->compare('user_id', $this->user_id, true);

            if ($dt_from != '' && $dt_to == '') {
                //date from -> now
                $criteria->addCondition("action_datetime >= '$dt_from'");
            } else if ($dt_from == '' && $dt_to != '') {
                //beginning -> date to
                $criteria->addCondition("action_datetime <= '$dt_to'");
            } else if ($dt_from != '' && $dt_to != '') {
                //date from -> date to
                $criteria->addCondition("action_datetime BETWEEN '$dt_from' AND '$dt_to'");
            }
            $criteria->compare('action_datetime', $this->action_datetime);
        }

        $criteria->compare('t.user_id', $this->user_id);

        //$criteria->with = array('relmenu');

        if ($this->menu_id != 0)
            $criteria->compare('t.menu_id', $this->menu_id);

//        else if($this->user_id != ''){
//            $criteria->compare('user_id', $this->user_id, true);
//        }
//        
//        else if($this->menu_id != ''){
//            if (isset($this->menu_id) && $this->menu_id != '') {
//                $criteria->with = array('relmenu');
//                $criteria->compare('relmenu.id', $this->menu_id);
//            }
//            $criteria->compare('user_id', $this->user_id, true);
//        }
//        if (isset($_GET['daterange']) && $_GET['daterange'] != '') {
//            $daterange_explode = explode(' - ', $_GET['daterange']);
//            $display_startdt_exp = explode('/', $daterange_explode[0]);
//            $display_enddt = explode('/', $daterange_explode[1]);
//
//            $dt_from = $display_startdt_exp[2] . '-' . $display_startdt_exp[1] . '-' . $display_startdt_exp[0];
//            $dt_to2 = $display_enddt[2] . '-' . $display_enddt[1] . '-' . $display_enddt[0];
//            $dt_to = date('Y-m-d', strtotime($dt_to2 . "+1 days"));
//
//            if ($dt_from != '' && $dt_to == '') {
//                //date from -> now
//                $criteria->addCondition("action_datetime >= '$dt_from'");
//            } else if ($dt_from == '' && $dt_to != '') {
//                //beginning -> date to
//                $criteria->addCondition("action_datetime <= '$dt_to'");
//            } else if ($dt_from != '' && $dt_to != '') {
//                //date from -> date to
//                $criteria->addCondition("action_datetime BETWEEN '$dt_from' AND '$dt_to'");
//            }
//            $criteria->compare('action_datetime', $this->action_datetime);
//            
//            if (isset($this->menu_id) && $this->menu_id != '') {
//                $criteria->with = array('relmenu');
//                $criteria->compare('relmenu.id', $this->menu_id);
//            }
//            $criteria->compare('user_id', $this->user_id, true);
//        }

        if (!isset($_GET['OstAuditTrail_sort']))
            $criteria->order = 'action_datetime DESC';

        return new CActiveDataProvider($this, array('criteria' => $criteria, 'pagination' => array('pageSize' => 10)));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OstAuditTrail the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function insertlog($menu_id, $action_type, $data_id) {
        $model = new OstAuditTrail;
        $model->user_id = Yii::app()->session['user_id'];
        $model->action_datetime = new CDbExpression('NOW()');
        $model->menu_id = $menu_id;
        $model->action_type = $action_type;
        $model->data_id = $data_id;
        $model->save();
    }

    public function displaydetail($menu_id) {
        $model = OstMenu::model()->findByPk($menu_id);
        if($model->parent_menu != 0){
            $parent_menu = OstMenu::model()->findByPk($model->parent_menu);
            echo $parent_menu->title.": ";
        }
        echo $model->title;
    }

}
