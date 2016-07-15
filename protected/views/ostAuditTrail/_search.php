<?php
if(isset($_GET['daterange'])){
    $daterange = '';
}

if (!empty($model->action_datetime)) {
    if (isset($_POST['action_datetime']) && $_POST['action_datetime'] != '') {
        //$display_startdt_exp = explode('-', $model->action_datetime);
//        $display_display_enddt = explode('-', $model->action_datetime);
//        $daterange = $display_startdt_exp[2] . '/' . $display_startdt_exp[1] . '/' . $display_startdt_exp[0] . ' - ' . $display_display_enddt[2] . '/' . $display_display_enddt[1] . '/' . $display_display_enddt[0];
        $daterange = '0000-00-00 00:00:00';
    }    
    
    $daterange = '00/00/0000 00:00:00';
}
//$daterange = '';
//
//if (!$model->isNewRecord) {
//    if ($model->publish_startdt != '0000-00-00 00:00:00' && $model->publish_enddt != '0000-00-00 00:00:00') {
//        $publish_startdt_exp = explode('-', $model->publish_startdt);
//        $publish_publish_enddt = explode('-', $model->publish_enddt);
//        $daterange = $publish_startdt_exp[0] . '-' . $publish_startdt_exp[1] . '-' . $publish_startdt_exp[2] . ' - ' . $publish_publish_enddt[0] . '-' . $publish_publish_enddt[1] . '-' . $publish_publish_enddt[2];
//    }
//}
?>

<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/jquery-ui.custom.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/chosen.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/datepicker.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/bootstrap-timepicker.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/daterangepicker.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/bootstrap-datetimepicker.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/colorpicker.css" />

<div class="row">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'get',)); ?>
    
    <div class="col-xs-12 row"><div class=" form-group">
        <div class="col-xs-3" style="padding-right: 130px;">
            <div class="col-xs-3" style="padding-top: 5px; padding-right: 20px; margin-left:-25px">
                <?php echo $form->label($model ,'action_datetime')?>
            </div>
            
            <div class="col-xs-3">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                    </span>                    
                    <?php if(isset($_GET['daterange'])){ ?>
                    <input id="dateoutput" class="" style="width:195px; margin-left: 0px;" type="text" name="daterange" placeholder="Display Date Range" value="<?php echo $_GET['daterange']; ?>"/>
                    <?php } else {// echo $form->textField($model, 'action_datetime', array('label'=>'daterange', 'placeholder'=>'Display Date Range')); ?>
                    <input id="dateoutput" class="" style="width:195px; margin-left: 0px;" type="text" name="daterange" placeholder="Display Date Range" value="<?php // echo $_GET['daterange']; ?>"/>
                    <?php }// echo $form->textField($model, 'action_datetime', array('label'=>'daterange', 'placeholder'=>'Display Date Range')); ?>
                </div>
            </div>
        </div>
        
            <?php echo $form->label($model, 'menu_id', array('class' => '')); ?>
            <?php echo $form->dropDownList($model, 'menu_id', OstMenu::model()->getparent('cms'), array('class' => 'form-control')); ?>        
        
        
        <?php echo $form->label($model, 'user_id', array('class' => '')); ?>
        <?php echo $form->dropDownList($model, 'user_id', OstUser::model()->getUserList(), array('class' => 'form-control', 'prompt'=>'--Please Choose--')); ?>
        
            <button class="btn btn-sm btn-warning width-10" type="submit"><i class="ace-icon fa fa-search"></i>&nbsp;Search</button>
            <a href="index.php?r=ostAuditTrail/admin" class="btn btn-sm btn-success width-10"><i class="ace-icon fa fa-undo"></i>&nbsp;Reset</a>
        
    </div></div>


<!--<table class="row" cellpading="0" cellspacing="0" width="100%">
    <tr><td><?php echo $form->label($model ,'action_datetime')?></td>
    
        <td width="20%">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                    </span>                    
                    <?php if(isset($_GET['daterange'])){ ?>
                    <input id="dateoutput" class="col-sm-6" style="width:170px; margin-left: 0px;" type="text" name="daterange" placeholder="Display Date Range" value="<?php echo $_GET['daterange']; ?>"/>
                    <?php } else {// echo $form->textField($model, 'action_datetime', array('label'=>'daterange', 'placeholder'=>'Display Date Range')); ?>
                    <input id="dateoutput" class="col-sm-6" style="width:170px; margin-left: 0px;" type="text" name="daterange" placeholder="Display Date Range" value="<?php // echo $_GET['daterange']; ?>"/>
                    <?php }// echo $form->textField($model, 'action_datetime', array('label'=>'daterange', 'placeholder'=>'Display Date Range')); ?>
                </div>
            </div>
        </td>
    
    
        <td width="25%">
            <?php echo $form->label($model, 'menu_id', array('class' => '')); ?>
            <?php echo $form->dropDownList($model, 'menu_id', OstMenu::model()->getparent('cms'), array('class' => 'form-control')); ?>
        </td>
    
    
        <td width="30%">
            <?php echo $form->label($model, 'user_id', array('class' => '')); ?>
            <?php echo $form->dropDownList($model, 'user_id', OstUser::model()->getUserList(), array('class' => 'form-control', 'prompt'=>'--Please Choose--')); ?>
        </td>
    
    
        <td width="20%">
            <button class="btn btn-sm btn-warning width-50" type="submit"><i class="ace-icon fa fa-search"></i>&nbsp;Search</button>
        </td>
        <td width="20%">
            <a href="index.php?r=ostAuditTrail/admin" class="btn btn-sm btn-success width-150"><i class="ace-icon fa fa-undo"></i>&nbsp;Reset</a>
        </td>
    
    </div></div>
</table>-->
    

    
    
   

    <?php $this->endWidget(); ?>
</div>

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/date-time/bootstrap-datepicker.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/date-time/bootstrap-timepicker.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/date-time/moment.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/date-time/daterangepicker.js"></script>

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/jquery.hotkeys.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/bootstrap-wysiwyg.js"></script>

<script>
    $(function() {

        $('input[name=daterange]').daterangepicker({
            format: 'DD/MM/YYYY',
            onSelect: function(dateText, inst){
                var date = $.daterangepicker.parseDate(inst.settings.dateFormat || $.daterangepicker._defaults.dateFormat, dateText, inst.settings);
                    var dateText1 = $.daterangepicker.formatDate("D, d M yy", date, inst.settings);
                    date.setDate(date.getDate() + 7);
                    var dateText2 = $.daterangepicker.formatDate("D, d M yy", date, inst.settings);
                    $("#dateoutput").html("Chosen date is <b>" + dateText1 + "</b>; chosen date + 7 days yields <b>" + dateText2 + "</b>");
            },
            'applyClass': 'btn-sm btn-success',
            'cancelClass': 'btn-sm btn-default',
            locale: {
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
            }            
        }).prev().on(ace.click_event, function() {
            $(this).next().focus();
        });

        $(document).one('ajaxloadstart.page', function(e) {
            $('textarea[class*=autosize]').trigger('autosize.destroy');
            $('.limiterBox,.autosizejs').remove();
            $('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
            $('input[name=daterange]').daterangepicker("setDate", new Date());
        });
        
        
    });

</script>