<?php

class MainController extends Controller {
    
    public function actionChangeColor($color) {
        if ($color != 'reset')
            Yii::app()->session['color'] = $color;
        else
            Yii::app()->session['color'] = '';

        $this->redirect(Yii::app()->request->urlReferrer);
    }
    
    public function actionChangeSize($size) {
        if ($size == 'i')
            $newsize = (int) Yii::app()->session['size'] + 1;

        if ($size == 'n')
            $newsize = '0';

        if ($size == 'd')
            $newsize = (int) Yii::app()->session['size'] - 1;

        Yii::app()->session['size'] = $newsize;
        $this->redirect(Yii::app()->request->urlReferrer);
    }
    
    public function actionChangeContrast($minmax) {
        if ($minmax == 'normal')
            Yii::app()->session['contrast'] = '';
        else
            Yii::app()->session['contrast'] = $minmax;

        $this->redirect(Yii::app()->request->urlReferrer);
    }
}
?>