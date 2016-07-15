<div class="row">

    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'get',)); ?>

    
    <div class="col-sm-6">
        <div class="col-sm-2"><div style="padding-top:7px;"><?php echo $form->label($model, 'title'); ?></div></div>
        <div class="col-sm-10"><?php echo $form->textField($model, 'title', array('size' => 60, 'class' => 'col-sm-12')); ?></div>
    </div>
    
    <div class="col-sm-6">
        <div class="col-sm-2"><div style="padding-top:7px;"><?php echo $form->label($model, 'tahun'); ?></div></div>
        <div class="col-sm-10"><?php echo $form->dropdownlist($model, 'event_dt', OstRefList::model()->listRef3('9'), array('prompt' => '-- Please Choose --', 'class' => 'col-sm-12')); ?></div>
    </div>
    
    <div class="col-sm-12">&nbsp;</div>
    
    <div class="col-sm-6">
        <div class="col-sm-12">
            <button class="btn btn-sm btn-warning width-25" type="submit"><i class="ace-icon fa fa-search"></i>&nbsp;Search</button>
            <a href="index.php?r=ostPhotoAlbum/admin" class="btn btn-sm btn-success width-25"><i class="ace-icon fa fa-undo"></i>&nbsp;Reset</a>
            <a href="index.php?r=ostPhotoAlbum/create" class="btn btn-sm btn-primary width-25"><i class="ace-icon fa fa-plus"></i>&nbsp;Add</a>
        </div>
    </div>
    
    <?php $this->endWidget(); ?>

</div>