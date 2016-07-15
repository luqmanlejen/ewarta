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
class OstMenuPortal extends CActiveRecord {

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
            array('parent_menu, sort, parent_lang, hide_ind, required_approval', 'numerical', 'integerOnly' => true),
            array('title, url, created_by, updated_by', 'length', 'max' => 255),
            array('menu_type, lang', 'length', 'max' => 10),
            array('created_dt, updated_dt', 'safe'),
            array('title, hide_ind, sort, menu_type, required_approval', 'required'),
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
        return array('reladmin' => array(self::BELONGS_TO, 'OstUser', '', 'foreignKey' => array('updated_by' => 'id')),);
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
            'menu_type' => 'Position',
            'parent_lang' => 'Parent Lang',
            'lang' => 'Lang',
            'hide_ind' => 'Display Status',
            'required_approval' => 'Required Approval',
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

//        $criteria->compare('id', $this->id);
//        $criteria->compare('parent_menu', $this->parent_menu);
//        $criteria->compare('sort', $this->sort);
//        $criteria->compare('url', $this->url, true); 
//        $criteria->compare('parent_lang', $this->parent_lang);
//        $criteria->compare('lang', $this->lang, true);
//        $criteria->compare('hide_ind', $this->hide_ind);
//        $criteria->compare('required_approval', $this->required_approval);

        $criteria->compare('menu_type', $this->menu_type, true);

        $criteria->compare('title', $this->title, true);

        $criteria->addCondition("t.lang='en' AND menu_type!='cms'");

        if (!isset($_GET['OstMenuPortal_sort']))
            $criteria->order = 't.updated_dt DESC';

        return new CActiveDataProvider($this, array('criteria' => $criteria, 'pagination' => array('pageSize' => 10)));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OstMenuPortal the static model class
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

    public function getdvsn() {

        $output = array();

        $model = OstMenuAccess::model()->findAll(array("condition" => "menu_id=$this->id"));

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                $output[] = $row['role_code'];
            }
        }

        return $output;
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

    public function getparentfordvsn($menu_type) {

        $output = array('0' => '-- Please Choose --');

        if ($menu_type != '') {

            $model = $this->findAll(array("condition" => "menu_type='$menu_type' AND parent_menu=0 AND lang='en' AND id IN (" . OstArticles::model()->getdvsnmenu() . ") ORDER BY sort ASC"));

            if (sizeof($model) > 0) {

                foreach ($model as $row) {

                    $output[$row->id] = $row->title;

                    $this->getsubfordvsn($row->id, $output, 0);
                }
            }
        }

        return $output;
    }

    public function getsubfordvsn($parent_menu, &$output, $count) {

        $model = $this->findAll(array("condition" => "parent_menu=$parent_menu AND lang='en' AND id IN (" . OstArticles::model()->getdvsnmenu() . ") ORDER BY sort ASC"));

        if (sizeof($model) > 0) {

            $count++;

            foreach ($model as $key => $row) {

                $output[$row->id] = $this->getmarker($count) . ' ' . ($key + 1) . '. ' . $row->title;

                $this->getsubfordvsn($row->id, $output, $count);
            }
        }

        return $output;
    }

    public function displaytitleNbreadcrumbs() {

        $output = $this->title . '<br>' . $this->getbreadcrumbs($this->id);

        echo $output;
    }

    public function getbreadcrumbs($menu_id) {

        $output = '<span style="color:gray;font-size: 11px;">';

        $menu_parent_id = PortalElement::GetMenuParent($menu_id);

        $arr[] = $menu_id;

        while ($menu_parent_id != '0') {

            $menu_id = $menu_parent_id;

            $menu_parent_id = PortalElement::GetMenuParent($menu_id);

            $arr[] = $menu_id;
        }

        $arr[] = 94;

        if (sizeof($arr) > 0) {

            $loop = sizeof($arr) - 1;

            for ($x = $loop; $x >= 0; $x--) {

                $model = OstMenuPortal::model()->findByPK($arr[$x]);

                if (sizeof($model) > 0)
                    $output .= $model->title;

                if ($x != '')
                    $output .= ' &raquo; ';
            }
        }

        $output.= '</span>';

        return $output;
    }

}