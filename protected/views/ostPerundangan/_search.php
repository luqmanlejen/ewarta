<div class="row">

    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'get',)); ?>

    &nbsp;&nbsp;
    <?php echo $form->label($model, 'no_act'); ?>
    <?php echo $form->textField($model, 'no_act', array('size' => 60, 'class' => 'form-control')); ?>

    <button class="btn btn-sm btn-warning width-10" type="submit"><i class="ace-icon fa fa-search"></i>&nbsp;Search</button>
    <a href="index.php?r=ostPerundangan/admin" class="btn btn-sm btn-success width-10"><i class="ace-icon fa fa-undo"></i>&nbsp;Reset</a>
    <a href="index.php?r=ostPerundangan/create" class="btn btn-sm btn-primary width-10"><i class="ace-icon fa fa-plus"></i>&nbsp;Add</a>

    <?php $this->endWidget(); ?>

</div>