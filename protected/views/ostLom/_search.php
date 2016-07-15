<div class="row">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'get',)); ?>

    &nbsp;&nbsp;
    <?php echo $form->label($model, 'lom_title'); ?>
    <?php echo $form->textField($model, 'lom_title', array('size' => 40, 'maxlength' => 255, 'class' => 'form-control')); ?>
    
    <?php echo $form->label($model, 'lom_no'); ?>
    <?php echo $form->textField($model, 'lom_no', array('size' => 25, 'maxlength' => 255, 'class' => 'form-control')); ?>
    
    <button class="btn btn-sm btn-warning width-10" type="submit"><i class="ace-icon fa fa-search"></i>&nbsp;Search</button>
    <a href="index.php?r=ostLom/admin" class="btn btn-sm btn-success width-10"><i class="ace-icon fa fa-undo"></i>&nbsp;Reset</a>
    <a href="index.php?r=ostLom/create" class="btn btn-sm btn-primary width-10"><i class="ace-icon fa fa-plus"></i>&nbsp;Add</a>
    <br><br>
    
    &nbsp;&nbsp;
    <?php echo $form->label($model, 'total_hits'); ?>:
    <?php 
    $hits = OstLom::model()->findAll();
    $total = 0;
    foreach ($hits as $hit) {
        $num = (int)$hit->hits;
        $total = $total + $num;
    }
    echo "<b><span style='color: red'>&nbsp;".$total."</span></b>";
    ?>
    <?php // echo $form->textField($model, 'lom_no', array('size' => 15, 'maxlength' => 255, 'class' => 'form-control', 'readonly'=>'readonly', 'value' => '50 000')); ?> hits
    
    
    <?php $this->endWidget(); ?>
    
</div>
