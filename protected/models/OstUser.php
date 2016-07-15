<?php

/**
 * This is the model class for table "ost_user".
 *
 * The followings are the available columns in table 'ost_user':
 * @property integer $id
 * @property integer $hrstafperibadi_id
 * @property string $name
 * @property string $ic_no
 * @property string $email
 * @property string $pwd
 * @property integer $status
 * @property string $notes
 * @property string $created_dt
 * @property string $created_by
 * @property string $updated_dt
 * @property string $updated_by
 */
class OstUser extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ost_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, ic_no, email, pwd, status', 'required'),
            array('hrstafperibadi_id, status', 'numerical', 'integerOnly' => true),
            array('name, email, pwd, created_by, updated_by', 'length', 'max' => 255),
            array('ic_no', 'length', 'max' => 20),
            array('email', 'email'),
            array('ic_no', 'unique'),
            array('hrstafperibadi_id, notes, created_dt, created_by, updated_dt, updated_by', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, hrstafperibadi_id, name, ic_no, email, pwd, status, notes, created_dt, created_by, updated_dt, updated_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array('reladmin' => array(self::BELONGS_TO, 'OstUser', '', 'foreignKey' => array('updated_by' => 'id')),);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'hrstafperibadi_id' => 'Hrstafperibadi',
            'name' => 'Name',
            'ic_no' => 'IC No',
            'email' => 'Email',
            'pwd' => 'Password',
            'status' => 'Status',
            'notes' => 'Notes',
            'created_dt' => 'Created Dt',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('name', $this->name, true);

        if (!isset($_GET['OstUser_sort']))
            $criteria->order = 'updated_dt DESC';

        return new CActiveDataProvider($this, array('criteria' => $criteria, 'pagination' => array('pageSize' => 10)));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OstUser the static model class
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

    public function getstatus() {
        if ($this->status == 1)
            echo '<font color="#629B58">Active</font>';
        else
            echo '<font color="#B74635">Not Active</font>';
    }

    public function getroles() {

        $output = '';

        $role1 = array();

        $model = OstUserRole::model()->findAll(array("condition" => "user_id=$this->id AND role_code NOT LIKE 'adm%'"));

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                $role1[] = OstRefList::model()->getRefLabel(1, $row['role_code']);
            }

            $output .= implode(', ', $role1);
        }

        $role2 = array();

        $model2 = OstUserRole::model()->findAll(array("condition" => "user_id=$this->id AND role_code LIKE 'adm_%'"));

        if (sizeof($model2) > 0) {

            foreach ($model2 as $row2) {

                $role2[] = OstRefList::model()->getRefLabel(2, $row2['role_code']);
            }

            if ($output != '')
                $output.= '<br>';

            $output.= 'Administrator : ';

            $output .= implode(', ', $role2);
        }

        echo $output;
    }

    public function getroles2($cat_id, $user_id) {
        
        $output = array();
        
        if($cat_id == 1)
            $model = OstUserRole::model()->findAll(array("condition" => "user_id=$this->id AND role_code NOT LIKE 'adm_%'"));
        if($cat_id == 2)
            $model = OstUserRole::model()->findAll(array("condition" => "user_id=$this->id AND role_code LIKE 'adm_%'"));
        
        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                $output[] = $row['role_code'];
            }

        }
        
        return $output;

    }
    
    public function getUserList() {
        $sql = "SELECT id,name FROM ost_user WHERE status=1 ORDER BY id DESC";
        $conn = Yii::app()->db->createCommand($sql);
        $rs = $conn->query();
        $moduleArray = CHtml::listData($rs, 'id', 'name');
        return $moduleArray;
    }

}
