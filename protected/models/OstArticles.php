<?php

/**
 * This is the model class for table "ost_articles".
 *
 * The followings are the available columns in table 'ost_articles':
 * @property integer $id
 * @property integer $menu_id
 * @property string $approval_sts
 * @property string $title
 * @property string $content
 * @property string $display_type
 * @property string $display_startdt
 * @property string $display_enddt
 * @property string $inform_user
 * @property integer $parent_id
 * @property string $lang
 * @property string $created_dt
 * @property string $created_by
 * @property string $updated_dt
 * @property string $updated_by
 * @property string $view_latest
 */
class OstArticles extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ost_articles';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('menu_id, title, content, display_type', 'required'),
            array('menu_id, parent_id, view_latest', 'numerical', 'integerOnly' => true),
            array('approval_sts, display_type, lang', 'length', 'max' => 10),
            array('title, created_by, updated_by', 'length', 'max' => 255),
            array('inform_user, created_dt, created_by, updated_dt, updated_by, display_startdt, display_enddt', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, menu_id, approval_sts, title, content, display_type, display_startdt, display_enddt, inform_user, parent_id, lang, created_dt, created_by, updated_dt, updated_by, view_latest', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array('reladmin' => array(self::BELONGS_TO, 'OstUser', '', 'foreignKey' => array('updated_by' => 'id')), 'relmenu' => array(self::BELONGS_TO, 'OstMenuPortal', '', 'foreignKey' => array('menu_id' => 'id')));
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'menu_id' => 'Menu',
            'approval_sts' => 'Approval Status',
            'title' => 'Title',
            'content' => 'Content',
            'display_type' => 'Display Type',
            'display_startdt' => 'Display Start Date',
            'display_enddt' => 'Display End Date',
            'inform_user' => 'Inform User',
            'parent_id' => 'Parent',
            'lang' => 'Language',
            'created_dt' => 'Created Dt',
            'created_by' => 'Created By',
            'updated_dt' => 'Updated Date',
            'updated_by' => 'Updated By',
            'view_latest' => 'view_latest',
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

        $criteria->compare('title', $this->title, true);

        $criteria->addCondition("t.parent_id=0");

        if (OstArticles::model()->chckdvsn() == 'y')
            $criteria->addCondition("t.menu_id IN (" . OstArticles::model()->getdvsnmenu() . ")");

        if (isset($_GET['menu_id']))
            $criteria->addCondition("t.menu_id=" . $_GET['menu_id']);
        else
            $criteria->addCondition("t.menu_id NOT IN (190,192,194)");

        if (!isset($_GET['OstArticles_sort']))
            $criteria->order = 't.updated_dt DESC';

        return new CActiveDataProvider($this, array('criteria' => $criteria, 'pagination' => array('pageSize' => 10)));
    }

    public function search_from_portal() {

        $criteria = new CDbCriteria;

        $criteria->addCondition("t.parent_id=0 AND t.lang='en' AND t.approval_sts='publish' AND (t.display_type='p' OR (t.display_type='t' AND DATE(t.display_startdt)<=DATE(NOW()) AND DATE(t.display_enddt)>=DATE(NOW())))");

        $criteria->addCondition("t.menu_id=" . PortalElement::encrypt_decrypt('decrypt', $_GET['menu_id']));

        $criteria->order = 't.created_dt DESC';

        return new CActiveDataProvider($this, array('criteria' => $criteria, 'pagination' => array('pageSize' => 10)));
    }

    public function searchApprover() {

        $criteria = new CDbCriteria;

        $criteria->compare('title', $this->title, true);

        $criteria->addCondition("t.parent_id=0");

        $criteria->addCondition("t.approval_sts='pending'");

        if (!isset($_GET['OstArticles_sort']))
            $criteria->order = 't.updated_dt DESC';

        return new CActiveDataProvider($this, array('criteria' => $criteria, 'pagination' => array('pageSize' => 10)));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OstArticles the static model class
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

    public function chckdvsn() {

        if (isset(Yii::app()->session['user_id'])) {

            $user_id = Yii::app()->session['user_id'];

            $model = OstUserRole::model()->findAll(array("condition" => "user_id=$user_id AND role_code LIKE '%dvsn_%'"));

            if (sizeof($model) > 0)
                return 'y';
            else
                return 'n';
        }
    }

    public function getdvsnmenu() {

        $output = array();

        $user_id = Yii::app()->session['user_id'];

        //get user role

        $model = OstUserRole::model()->findAll(array("condition" => "user_id=$user_id AND role_code LIKE '%dvsn_%'"));

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                //get menu under the role

                $model2 = OstMenuAccess::model()->findAll(array("condition" => "role_code LIKE '%" . $row->role_code . "%'"));

                if (sizeof($model2) > 0) {

                    foreach ($model2 as $row2) {

                        $output[] = "'" . $row2->menu_id . "'";
                    }
                }
            }
        }

        return implode(',', $output);
    }

    public function chckmenuapprovalsts($menu_id) {

        $model = OstMenuPortal::model()->findByPk($menu_id);

        if (sizeof($model) > 0) {

            if ($model->required_approval == 1)
                return 'y';
            else
                return 'n';
        }
    }

    public function displaylang() {

        $output = '<img src="images/lang/en.png">&nbsp;';

        $model = OstArticles::model()->findAllByAttributes(array('parent_id' => $this->id));

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                if ($row['title'] == '' || $row['content'] == '')
                    $output .= '<img src="images/lang/my.png" style="opacity:0.2;">&nbsp;';
                else
                    $output .= '<img src="images/lang/my.png">&nbsp;';
            }
        }

        echo $output;
    }

    public function displaytype() {

        if ($this->display_type == 'p')
            return 'Permanent';

        if ($this->display_type == 't')
            return 'Temporary';
    }

    public function chckupdate($approval_sts) {

        $status = "n";

        if (OstArticles::model()->chckdvsn() == "n")
            $status = "y";
        else if (OstArticles::model()->chckdvsn() == "y") {
            if ($approval_sts == 'draft' || $approval_sts == 'rework')
                $status = "y";
        }

        return $status;
    }

    public function getarticle_from_portal() {

        $url = 'index.php?r=portal2/article&menu_id=' . PortalElement::encrypt_decrypt('encrypt', $this->menu_id) . '&artikel_id=' . PortalElement::encrypt_decrypt('encrypt', $this->id);

        $output = '<a href="' . $url . '">' . PortalTranslation::TranslateArticles($this->id, $this->title, 'title') . '</a>';

        echo $output;
    }

    public function get_last_updated() {

        $output = '';

        $model = OstArticles::model()->findAll(array("order" => "updated_dt DESC", "limit" => "1"));

        if (sizeof($model) > 0) {

            foreach ($model as $row) {

                $output = PortalTranslation::TranslateDate(date("l, d F Y, h:i A", strtotime($row->updated_dt)));
            }
        }

        return $output;
    }

    public function displaytitleNbreadcrumbs() {

        $output = $this->title . '<br>' . OstMenuPortal::model()->getbreadcrumbs($this->menu_id);

        echo $output;
    }

}