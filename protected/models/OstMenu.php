<?php

/**
 * This is the model class for table "ost_menu".
 *
 * The followings are the available columns in table 'ost_menu':
 * @property integer $id
 * @property string $title
 * @property integer $parent_menu
 * @property integer $sort
 * @property string $url
 * @property string $menu_type
 * @property integer $parent_lang
 * @property string $lang
 * @property integer $hide_ind
 * @property integer $required_approval
 * @property string $created_dt
 * @property string $created_by
 * @property string $updated_dt
 * @property string $updated_by
 */
class OstMenu extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ost_menu';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, sort', 'required'),
            array('parent_menu, sort, parent_lang, hide_ind, required_approval', 'numerical', 'integerOnly' => true),
            array('title, url, created_by, updated_by', 'length', 'max' => 255),
            array('menu_type, lang', 'length', 'max' => 10),
            array('created_dt, updated_dt', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, parent_menu, sort, url, menu_type, parent_lang, lang, hide_ind, required_approval, created_dt, created_by, updated_dt, updated_by', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'modul' => array(self::HAS_ONE, 'OstMenu', array('parent_menu' => 'id')),
            'reladmin' => array(self::BELONGS_TO, 'OstUser', '', 'foreignKey' => array('updated_by' => 'id'))
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'parent_menu' => 'Parent',
            'sort' => 'Sort',
            'url' => 'Url',
            'menu_type' => 'Menu Type',
            'parent_lang' => 'Parent Lang',
            'lang' => 'Language',
            'hide_ind' => 'Hide Ind',
            'required_approval' => 'Required Approval',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('parent_menu', $this->parent_menu);
        $criteria->compare('sort', $this->sort);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('menu_type', $this->menu_type, true);
        $criteria->compare('parent_lang', $this->parent_lang);
        $criteria->compare('lang', $this->lang, true);
        $criteria->compare('hide_ind', $this->hide_ind);
        $criteria->compare('required_approval', $this->required_approval);
        $criteria->compare('created_dt', $this->created_dt, true);
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('updated_dt', $this->updated_dt, true);
        $criteria->compare('updated_by', $this->updated_by, true);

        if (!isset($_GET['OstMenu_sort']))
            $criteria->order = 't.updated_dt DESC';

        $criteria->addCondition("t.menu_type='cms'");

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria, 'pagination' => array('pageSize' => 10),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OstMenu the static model class
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

    public function displaylang($id) {
        $output = '';
        $model = OstRefList::model()->findAll(array("condition" => "cat_id='1'"));
        if (sizeof($model) > 0) {
            foreach ($model as $row) {
                if ($row->lang == 'en') {
                    $output .= '<img src="images/lang/en.png">&nbsp;';
                } else {
                    $model2 = $this->findByAttributes(array('parent_menu' => $id));
                    if (sizeof($model2) > 0 && $model2->title != '') {
                        $output .= '<img src="images/lang/my.png">&nbsp;';
                    } else {
                        $output .= '<img src="images/lang/my.png" style="opacity:0.2;">&nbsp;';
                    }
                }
            }
        }
        echo $output;
    }

    public function getModul() {
        $sql = "SELECT id,title FROM ost_menu WHERE parent_menu=0 AND menu_type='cms' ORDER BY sort ASC";
        $conn = Yii::app()->db->createCommand($sql);
        $rs = $conn->query();
        $moduleArray = CHtml::listData($rs, 'id', 'title');
        return $moduleArray;
    }
    
    public function getparent($menu_type) {

        $output = array('0' => '-- Please Choose --');

        if ($menu_type != '') {

            $model = $this->findAll(array("condition" => "menu_type='$menu_type' AND parent_menu=0 AND lang='en' ORDER BY sort ASC"));

            if (sizeof($model) > 0) {
                
                foreach ($model as $row) {

                    $output[$row->id] = $row->title;
                    
                    $this->getsub($row->id, $output, 0);
                }
            }
        }

        return $output;
    }
    
    public function getsub($parent_menu, &$output, $count) {

        $model = $this->findAll(array("condition" => "parent_menu=$parent_menu AND lang='en' ORDER BY sort ASC"));

        if (sizeof($model) > 0) {

            $count++;
            
            foreach ($model as $key => $row) {
                
                $output[$row->id] = $this->getmarker($count) . ' ' . ($key + 1) . '. ' . $row->title;
                
                $this->getsub($row->id, $output, $count);
            }
        }

        return $output;
    }
    
    public function getmarker($total) {

        $marker = '';

        for ($x = 0; $x < $total; $x++) {

            $marker.= '__';
        }

        return $marker;
    }
}
