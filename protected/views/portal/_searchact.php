<style>
    .row{
        margin: 5px;
    }
</style>
<?php
$no_act = 'No Act';
$act_name = 'Act Name';
$range = 'Date Range';

if(Yii::app()->session['lang'] == 'my'){
    $no_act = 'No Akta';
    $act_name = 'Nama Akta';
    $range = 'Julat tarikh';
}

$name = '';
$start = '';//date('Y-m-d');
if (isset($_GET['start']))
    $start = $_GET['start'];
$end = '';//date('Y-m-d');
if (isset($_GET['end']))
    $end = $_GET['end'];
if (isset($_GET['act_name']))
    $name = $_GET['act_name'];
?>

<?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'get',)); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-2"><b><?php echo $no_act; ?></b></div>
        <div class="col-sm-2"><?php echo $form->textField($model, 'no_act', array('size' => 60, 'class' => 'form-control')); ?></div>
    </div>
    <div class="pace-4"></div>
    
    <div class="row">
        <div class="col-sm-2"><b><?php echo $act_name; ?></b></div>
        <div class="col-sm-8">
            <?php echo CHtml::textField('act_name', $name, array('size' => 60, 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="pace-4"></div>
    
    <div class="row">
        <div class="col-sm-2">
            <div style="padding-top:7px;">
                <b><?php echo $range; ?></b>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="input-daterange input-group">
                <input type="text" class="form-control" name="start" readonly value="<?php echo $start; ?>"/>
                <span class="input-group-addon"><i class="fa fa-long-arrow-right"></i></span>
                <input type="text" class="form-control" name="end" readonly value="<?php echo $end; ?>"/>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <button class="btn btn-primary width-10" type="submit"><i class="ace-icon fa fa-search" style="color:white"></i></button>
            <a href="index.php?r=portal/actList" class="btn btn-info width-10"><i class="ace-icon fa fa-undo" style="color:white"></i></a>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/custom/css/datepicker.css" />
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/custom/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    jQuery(function($) {
        $('.input-daterange').datepicker({autoclose: true, format: "yyyy-mm-dd"});
    });
</script>