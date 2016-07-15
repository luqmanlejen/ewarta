<?php

class CmsController extends CController {

    public function init() {
        Yii::app()->theme = "admin";
        parent::init();
    }

}