<div class="row">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'get',)); ?>

    &nbsp;&nbsp;
    <input type="hidden" name="cat_id" value="<?php echo $_GET['cat_id'] ?>"/>
    <?php echo $form->label($model, 'label'); ?>
    <?php echo $form->textField($model, 'label', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>

    <button class="btn btn-sm btn-warning width-10" type="submit" ><i class="ace-icon fa fa-search"></i>&nbsp;Search</button>
    <!--<a href="index.php?r=ostRefList/list&cat_id=<?php //echo $_GET['cat_id']?>&OstRefList[label]" class="btn btn-sm btn-warning width-10"><i class="ace-icon fa fa-search"></i>&nbsp;Search</a>-->
    <a href="index.php?r=ostRefList/list&cat_id=<?php echo $_GET['cat_id']; ?>" class="btn btn-sm btn-success width-10"><i class="ace-icon fa fa-undo"></i>&nbsp;Reset</a>
    <a href="index.php?r=ostRefList/create&cat_id=<?php echo $_GET['cat_id']; ?>" class="btn btn-sm btn-primary width-10"><i class="ace-icon fa fa-plus"></i>&nbsp;Add</a>
    <a href="index.php?r=ostRef/admin" class="btn btn-sm btn-purple width-10"><i class="ace-icon fa fa-arrow-left"></i>&nbsp;Back</a>    
    
    <?php $this->endWidget(); ?>
</div>

<!--//ostRefList%2Flist&OstRefList%5Blabel%5D=-->