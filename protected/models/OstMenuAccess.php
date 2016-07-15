<?php

/**
 * This is the model class for table "ost_menu_access".
 *
 * The followings are the available columns in table 'ost_menu_access':
 * @property integer $id
 * @property integer $menu_id
 * @property string $role_code
 */
class OstMenuAccess extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ost_menu_access';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('menu_id', 'required'),
            array('menu_id', 'numerical', 'integerOnly' => true),
            array('role_code', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, menu_id, role_code', 'safe', 'on' => 'search'),
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
            'menu_id' => 'Menu',
            'role_code' => 'Roles',
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
        $criteria->compare('menu_id', $this->menu_id);
        $criteria->compare('role_code', $this->role_code, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OstMenuAccess the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function displayRoleCB($menu_id, $ref) {
        $role_arr = OstRefList::model()->listRef3($ref);
        $role_arr2 = OstRefList::model()->listRef3(2);

        $selected_role_arr = array();
        $selected_role_arr2 = array();

        if ($menu_id != '') {
            $model = $this->findAll(array("condition" => "menu_id = " . $menu_id));
            if (sizeof($model) > 0) {
                foreach ($model as $row) {
                    $selected_role_arr[] = $row->role_code;
                }
            }
            if (sizeof($model) > 0) {
                foreach ($model as $row) {
                    $selected_role_arr2[] = $row->role_code;
                }
            }
        }
        
        return CHtml::checkBoxList('OstMenuAccess[role_code][]', $selected_role_arr, $role_arr) . ':-<br><div style="padding-left:20px;">' . CHtml::checkBoxList('OstMenuAccess[role_code][]', $selected_role_arr2, OstRefList::model()->listRef3(2)) . '</div>';
    }

}
