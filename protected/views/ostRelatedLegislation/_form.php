<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/jquery-ui.custom.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/datepicker.css" />


<?php
$date_proclamation = '';
$date_consent = '';
$date_effective = '';
$date_received = '';

if (!$model->isNewRecord) {
    if ($model->date_proclamation != '0000-00-00') { $date_proclamation = $model->date_proclamation; }
     if ($model->date_effective != '0000-00-00') { $date_effective = $model->date_effective; }
 
}
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'ost-related-legislation-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('class' => 'form-horizontal'))); ?>
    <div class="alert alert-danger"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Field with * are required</div>
    
	 
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'gn_no', array('class' => 'control-label')); ?> </div>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'gn_no', array('maxlength' => 255, 'class' => 'col-sm-3')); ?>
            <?php echo $form->error($model, 'gn_no'); ?>
        </div>
    </div>
    <div class="space-4"></div>
	
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'related_type', array('class' => 'control-label')); ?> </div>
        <div class="col-sm-10">
            <?php
                echo CHtml::dropDownList('related_type', $model->related_type, array('ost_act'=>'Act', 'ost_amending_act'=>'Amending Act', 'ost_pu'=>'PU', 'ost_perundangan' => 'Other Law'), array('class' => 'col-sm-2', 'ajax' => array(
                        'type' => 'POST',
                        'url' => CController::createUrl('OstRelatedLegislation/changeparent'),
                        'success' => 'function(data){
                        $("#related_id").html(data);
                    }',
                )));
            ?>
            <?php echo $form->error($model, 'related_type'); ?>
            
            <?php // echo $form->dropDownList($model, 'id_ref', OstAct::model()->displayActList() ,array('class' => 'col-sm-7')); ?>
            <?php 
                if($model->related_type == 'ost_amending_act'){
                    $list = OstAmendingAct::model()->displayActList();
                } else if($model->related_type == 'ost_perundangan'){
                    $list = OstPerundangan::model()->displayActList();
				} else if($model->related_type == 'ost_pu'){
                    $list = OstPu::model()->displayActList();
					
                } else {
                    $list = OstAct::model()->displayActList();
                }
                echo CHtml::dropDownList('related_id', $model->related_id, $list, array('class' => 'col-sm-7'));
                //echo $form->dropDownList($model, 'id_ref', OstAmendingAct::model()->displayActList(), array('class' => 'col-sm-7'));
            ?>
            <?php echo $form->error($model, 'related_id'); ?>
        </div>
    </div>
    <div class="space-4"></div>
    
	 <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'title_bm', array('class' => 'control-label')); ?> </div>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'title_bm', array('maxlength' => 255, 'class' => 'col-sm-3')); ?>
            <?php echo $form->error($model, 'title_bm'); ?>
        </div>
    </div>
    <div class="space-4"></div>
	
	 <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'title_bi', array('class' => 'control-label')); ?> </div>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'title_bi', array('maxlength' => 255, 'class' => 'col-sm-3')); ?>
            <?php echo $form->error($model, 'title_bi'); ?>
        </div>
    </div>
    <div class="space-4"></div>
	
	
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'date_proclamation', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">            
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                    </span>
                    <?php if(isset($_GET['date_proclamation']) && $_GET['date_proclamation'] != '') { ?>
                        <input  class="col-sm-3" type="text" name="date_proclamation" value="<?php echo $_GET['date_proclamation']; ?>" />
                    <?php } else { ?>
                        <input class="col-sm-3" type="text" name="date_proclamation" value="<?php echo $date_proclamation ?>" />
                    <?php }?>
                </div>
            <?php echo $form->error($model, 'date_proclamation'); ?>
        </div>
    </div>
    <div class="space-4"></div>

	 <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'date_effective', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">            
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                    </span>
                    <?php if(isset($_GET['date_effective']) && $_GET['date_effective'] != '') { ?>
                        <input  class="col-sm-3" type="text" name="date_effective" value="<?php echo $_GET['date_effective']; ?>" />
                    <?php } else { ?>
                        <input class="col-sm-3" type="text" name="date_effective" value="<?php echo $date_effective ?>" />
                    <?php }?>
                </div>
            <!--</div>-->
            <?php echo $form->error($model, 'date_effective'); ?>
        </div>
    </div>
    <div class="space-4"></div>
	
	
      
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'doc_name_bi', array('class' => 'control-label')); ?> (English Version)</div>
        <div class="col-sm-10">
            <div class="col-sm-6">
                <div class=" col-xs-10 col-lg-10" style="margin-left: -25px; width: 88%;">
                    <?php echo $form->textField($model, 'doc_name_bi', array('class' => 'form-control form-control-medium', 'id' => 'doc', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($model, 'doc_name_bi'); ?>
                </div>
                <div class="col-xs-2 col-lg-2">
                    <input type="button" value="Upload Document" onclick="BrowseServer();" class="btn btn-sm btn-success width-200"/>
                </div>
            </div>
        </div>
    </div>
    <div class="space-4"></div>
    
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'doc_name_bm', array('class' => 'control-label')); ?> (Malay Version)</div>
        <div class="col-sm-10">
            <div class="col-sm-6">
                <div class=" col-xs-10 col-lg-10" style="margin-left: -25px; width: 88%;">
                    <?php echo $form->textField($model, 'doc_name_bm', array('class' => 'form-control form-control-medium', 'id' => 'doc_bm', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($model, 'doc_name_bm'); ?>
                </div>
                <div class="col-xs-2 col-lg-2">
                    <input type="button" value="Upload Document" onclick="BrowseServer2();" class="btn btn-sm btn-success width-200"/>
                </div>
            </div>
        </div>
    </div>
    <div class="space-4"></div>
    
  
  
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'remarks_bi', array('class' => 'control-label')); ?> (English Version)</div>
        <div class="col-sm-10">
            <?php echo $form->textArea($model, 'remarks_bi', array('rows'=>4,'class' => 'col-sm-7')); ?>
            <?php echo $form->error($model, 'remarks_bi'); ?>
        </div>
    </div>
    <div class="space-4"></div>
    
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'remarks_bm', array('class' => 'control-label')); ?> (Malay Version)</div>
        <div class="col-sm-10">
            <?php echo $form->textArea($model, 'remarks_bm', array('rows'=>4,'class' => 'col-sm-7')); ?>
            <?php echo $form->error($model, 'remarks_bm'); ?>
        </div>
    </div>
    <div class="space-4"></div>

	
	  
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'publish', array('class' => 'control-label')); ?> </div>
        <div class="col-sm-10">
            <?php echo $form->dropDownList($model, 'publish', array('0'=>'Draft', '1'=>'Publish'),array('class' => 'col-sm-3')); ?>
            <?php echo $form->error($model, 'publish'); ?>
        </div>
    </div>
    <div class="space-4"></div>
	
	
    
    <div class="clearfix form-actions no-margin">
        <a href="index.php?r=OstRelatedLegislation/admin" class="btn btn-purple"><i class="ace-icon fa fa-arrow-left bigger-110s"></i>&nbsp;Back</a>&nbsp;&nbsp;
        <button class="btn btn-success" type="button" onclick="window.location.reload()"><i class="ace-icon fa fa-undo bigger-110"></i>&nbsp;Reset</button>&nbsp;&nbsp;
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? '<i class="ace-icon fa fa-plus bigger-110"></i>&nbsp;Add' : '<i class="ace-icon fa fa-pencil bigger-110"></i>&nbsp;Update'; ?></button>
    </div>
    
    <?php $this->endWidget(); ?>

</div><!-- form -->

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/date-time/bootstrap-datepicker.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/date-time/daterangepicker.js"></script>

<script>
    $(function() {
        $('input[name=daterange]').daterangepicker({
            format: 'YYYY-MM-DD',
            'applyClass': 'btn-sm btn-success',
            'cancelClass': 'btn-sm btn-default',
            locale: {
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
            }
        }).prev().on(ace.click_event, function() {
            $(this).next().focus();
        });
        
        $('input[name=date_proclamation]').datepicker({
            format: 'yyyy-mm-dd',
            'applyClass': 'btn-sm btn-success',
            'cancelClass': 'btn-sm btn-default',
            locale: {
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
            }
        }).prev().on(ace.click_event, function() {
            $(this).next().focus();
        });
        $('input[name=date_consent]').datepicker({
            format: 'yyyy-mm-dd',
            'applyClass': 'btn-sm btn-success',
            'cancelClass': 'btn-sm btn-default',
            locale: {
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
            }
        }).prev().on(ace.click_event, function() {
            $(this).next().focus();
        });
        $('input[name=date_effective]').datepicker({
            format: 'yyyy-mm-dd',
            'applyClass': 'btn-sm btn-success',
            'cancelClass': 'btn-sm btn-default',
            locale: {
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
            }
        }).prev().on(ace.click_event, function() {
            $(this).next().focus();
        });
        $('input[name=date_received]').datepicker({
            format: 'yyyy-mm-dd',
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
            $('.datepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
        });
    });

</script>

<script src="<?php echo Yii::app()->baseUrl ?>/ckeditor/ckfinder/ckfinder.js"></script>
<script>
    
    function BrowseServer() {
        var finder = new CKFinder();
        finder.basePath = '<?php echo Yii::app()->baseUrl ?>/ckeditor/ckfinder/';
        finder.selectActionFunction = SetFileField;
        finder.popup();
    }
    function SetFileField(fileUrl) {
        $('#doc').val(fileUrl);
        $('#doc_name_bi').val(fileUrl);
    }
    
    function BrowseServer2() {
        var finder = new CKFinder();
        finder.basePath = '<?php echo Yii::app()->baseUrl ?>/ckeditor/ckfinder/';
        finder.selectActionFunction = SetFileField2;
        finder.popup();
    }
    function SetFileField2(fileUrl) {
        $('#doc_bm').val(fileUrl);
        $('#doc_url_bm').val(fileUrl);
    }
    
    $("#ref2").hide();
    $("#ref3").hide();
    
</script>