<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/jquery-ui.custom.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/datepicker.css" />

<?php
$date_proclamation = '';
$date_received = '';

if (!$model->isNewRecord) {
    if ($model->date_proclamation != '0000-00-00') {
        $date_proclamation = $model->date_proclamation;
    }
    if ($model->date_received != '0000-00-00') {
        $date_received = $model->date_received;
    }
}
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'ost-pu-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('class' => 'form-horizontal'))); ?>
    <div class="alert alert-danger"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Field with * are required</div>
    
    <!--PU type-->
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'pu_type_id', array('class' => 'control-label')); ?> </div>
        <div class="col-sm-10">
            <?php echo $form->dropDownList($model, 'pu_type_id', array('1'=>'A', '2'=>'B'),array('class' => 'col-sm-1')); ?>
            <?php echo $form->error($model, 'pu_type_id'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <!--PU status-->
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'status_pu_id', array('class' => 'control-label')); ?> </div>
        <div class="col-sm-10">
            <?php echo $form->dropDownList($model, 'status_pu_id', OstRefList::model()->listRef3(5), array('class' => 'col-sm-2')); ?>
            <?php echo $form->error($model, 'status_pu_id'); ?>
        </div>
    </div>
    <div class="space-4"></div>
    
    <!--Replacemennt PU-->
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'replacement_pu_id', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php
//                echo CHtml::dropDownList('tbl_ref', $model3->tbl_ref, array('ost_act'=>'Act', 'ost_amending_act'=>'Amending Act', 'ost_pu'=>'PU', 'ost_perundangan' => 'Other Law'), array('class' => 'col-sm-2', 'prompt' => '-- Please Choose --', 'ajax' => array(
//                        'type' => 'POST',
//                        'url' => CController::createUrl('ostPu/changeparent'),
//                        'success' => 'function(data){
//                        $("#replacement_pu_id").html(data);
//                    }',
//                )));
//                if($model3->tbl_ref == 'ost_amending_act'){
//                    $list = OstAmendingAct::model()->displayActList();
//                } else if($model3->tbl_ref == 'ost_perundangan'){
//                    $list = OstPerundangan::model()->displayActList();                
//                } else if($model3->tbl_ref == 'ost_pu'){
//                    $list = OstPu::model()->displayActList();
//                } else {
//                    $list = OstAct::model()->displayActList();
//                }
                
                echo CHtml::dropDownList('replacement_pu_id', '', OstPu::model()->displayActList(), array('class' => 'col-sm-7', 'prompt' => '-- Please Choose --'));
                
                if($model->id != ''){
                    $model4 = OstPuReplace::model()->findAll(array('condition' => "replacee_id=$model->id"));
                    if(sizeof($model4) > 0){
                        $output = '<br><br>';
                        $count = 1;
                        foreach($model4 as $row){
                            $pu = OstPu::model()->findByPk($row->replacee_by);
                            $output .= '<div class="col-sm-10">
                                            <div class="col-xs-9 col-lg-9" style="margin-left: -25px;">
                                                <input id="field'.$count.'" class="form-control" type="text" name="replace_pu_add[]" value="'.$pu->sub_act_name_bi.'" readonly="readonly"/>
                                            </div>
                                            <button class="btn btn-sm btn-danger width-5 remove_field_replace_pu">X</button>
                                       </div>';
    //                        <button class="btn btn-sm btn-danger width-5 remove_field_replace_pu" onclick="replace_del();">X</button>
                            $count++;
                        }
                        echo $output;
                    }
                }
            ?>
            <div class="input_fields_wrap_replace_pu">
                <button class="add_field_button_replace_pu btn btn-sm btn-purple">Add Replacement PU</button>
                <div><input type="hidden" name="replace_pu_add[]"></div>                
            </div>
        </div>
    </div>
    
    <!--Related Act-->
    <div class="form-group">
        <div class="col-sm-2">Related Act</div>
        <div class="col-sm-10">
            <?php
                $select = '';
                $list = array();
                if(sizeof($model3) > 0){
                    $select = $model3->tbl_ref;
                    
                    if($model3->tbl_ref == 'ost_amending_act'){
                        $list = OstAmendingAct::model()->displayActList();
                    } else if($model3->tbl_ref == 'ost_perundangan'){
                        $list = OstPerundangan::model()->displayActList();                
                    } else if($model3->tbl_ref == 'ost_pu'){
                        $list = OstPu::model()->displayActList();
                    } else {
                        $list = OstAct::model()->displayActList();
                    }
                }
                echo CHtml::dropDownList('tbl_ref', $select, array('ost_act'=>'Act', 'ost_amending_act'=>'Amending Act', 'ost_pu'=>'PU', 'ost_perundangan' => 'Other Law'), array('class' => 'col-sm-2', 'prompt' => '-- Please Choose --', 'ajax' => array(
                        'type' => 'POST',
                        'url' => CController::createUrl('ostPu/changeparent'),
                        'success' => 'function(data){
                        $("#related_act").html(data);
                    }',
                )));
                
                echo CHtml::dropDownList('related_act', $model->replacement_pu_id, $list, array('class' => 'col-sm-7', 'prompt' => '-- Please Choose --')); 
                
                
                if($model->id != 0){
                    $model5 = OstPuRefAct::model()->findAll(array('condition' => "ref_id=$model->id"));
                    if(sizeof($model5) > 0){
                        $output = '<br><br>';
                        $count = 1;
                        foreach($model5 as $row){
                            $output .= '<div class="col-sm-10">
                                            <div class="col-xs-3 col-lg-3" style="margin-left: -25px; width: 24%">
                                                <input id="field'.$count.'" class="form-control" type="text" name="related_act_add[]" value="'.$row->tbl_ref.'" readonly="readonly"/>
                                            </div>
                                            <div class="col-xs-9 col-lg-9" style="margin-left: -25px;">
                                                <input id="field'.$count.'" class="form-control" type="text" name="related_act_add[]" value="'.OstPu::model()->displayAct($row->tbl_ref, $row->pu_id).'" readonly="readonly"/>
                                            </div>
                                            <button class="btn btn-sm btn-danger width-5 remove_field_related_act">X</button>
                                       </div>';
                            $count++;
                        }
                        echo $output;
                    }
                }
                
            ?>
            <div class="input_fields_wrap_related_act">
                <button class="add_field_button_related_act btn btn-sm btn-purple">Add Related Act</button>
                <div><input type="hidden" name="related_act_add[]"></div>                
            </div>
        </div>
    </div>
<!--    <div class="form-group">
        <div class="col-sm-2">Related Act</div>
        <div class="col-sm-10">
            <div class="input_fields_wrap_related_act">
                <button class="add_field_button_related_act btn btn-sm btn-purple">Add Related Act</button>
                <div><input type="hidden" name="related_act_add[]"></div>                
            </div>
        </div>
    </div>-->
    
    <!--PU no-->
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'pu_no', array('class' => 'control-label')); ?> </div>
        <div class="col-sm-10">
            <?php echo $form->textfield($model, 'pu_no', array('class' => 'col-sm-7')); ?>
            <span style="padding:5px">
                <?php
                    $row = OstPu::model()->findAll(array( 'condition' => 'pu_no', 'order' => 'pu_no DESC'));
                    if(sizeof($row) > 0){
                        echo $row[0]->pu_no." latest PU number.";
                    }
                ?>
            </span>
            <?php echo $form->error($model, 'pu_no'); ?>
        </div>
    </div>
    <div class="space-4"></div>
    
    <!--PU year-->
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'pu_year', array('class' => 'control-label')); ?> </div>
        <div class="col-sm-10">
            <?php echo $form->textfield($model, 'pu_year', array('class' => 'col-sm-2')); ?>
            <?php echo $form->error($model, 'pu_year'); ?>
        </div>
    </div>
    <div class="space-4"></div>
    
    <!--Highlight PU-->
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'highlight_pu', array('class' => 'control-label')); ?> </div>
        <div class="col-sm-10">
            <?php echo $form->dropDownList($model, 'highlight_pu', array('0'=>'False', '1'=>'True'),array('class' => 'col-sm-2')); ?>
            <?php echo $form->error($model, 'highlight_pu'); ?>
        </div>
    </div>
    <div class="space-4"></div>
    
    <!--Date Proclamation-->
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'date_proclamation', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">            
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
                <?php if (isset($_GET['date_proclamation']) && $_GET['date_proclamation'] != '') { ?>
                    <input  class="col-sm-3" type="text" name="date_proclamation" value="<?php echo $_GET['date_proclamation']; ?>" />
                <?php } else { ?>
                    <input class="col-sm-3" type="text" name="date_proclamation" value="<?php echo $date_proclamation ?>" />
                <?php } ?>
            </div>
            <?php echo $form->error($model, 'date_proclamation'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <!--Sub Act Name BM-->
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'sub_act_name_bm', array('class' => 'control-label')); ?> (Malay version)</div>
        <div class="col-sm-10">
            <?php echo $form->textfield($model, 'sub_act_name_bm', array('class' => 'col-sm-7')); ?>
            <?php echo $form->error($model, 'sub_act_name_bm'); ?>
        </div>
    </div>
    <div class="space-4"></div>
    
    <!--Sub Act Name BM-->
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'sub_act_name_bi', array('class' => 'control-label')); ?> (English Version)</div>
        <div class="col-sm-10">
            <?php echo $form->textfield($model, 'sub_act_name_bi', array('class' => 'col-sm-7')); ?>
            <?php echo $form->error($model, 'sub_act_name_bi'); ?>
        </div>
    </div>
    <div class="space-4"></div>
    
    <!--pdf-->
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'doc_name_pdf', array('class' => 'control-label')); ?> (PDF)</div>
        <div class="col-sm-10">
            <div class="col-sm-7">
                <div class=" col-xs-8 col-lg-8" style="margin-left: -25px;">
                    <?php echo $form->textField($model, 'doc_name_pdf', array('class' => 'form-control form-control-medium', 'id' => 'pdf_bm', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($model, 'doc_name_pdf'); ?>
                </div>
                <div class="col-xs-2 col-lg-2">
                    <input type="button" value="Upload Document" onclick="BrowseServerPDF();" class="btn btn-sm btn-success width-200"/>
                </div>
            </div>
        </div>
    </div>
    <!--add pdf-->
    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <div class="input_fields_wrap_pdf">
                <button class="add_field_button_pdf btn btn-sm btn-warning">Add PDF</button>
                <div><input type="hidden" name="pdf_add[]"></div>
                <?php 
                $id = 0;;
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
                $model2 = OstPuDocument::model()->findAll(array('condition' => "pu_id=$id AND doc_type=1"));
                if(sizeof($model2)>0){
                    $output = '';
                    $count = 1;
                    foreach($model2 as $row2){
                        $output .= '<div class="col-sm-7">
                                        <div class="col-xs-8 col-lg-8" style="margin-left: -25px;"><input id="field'.$count.'" class="form-control" type="text" name="pdf_add[]" value="'.$row2->document.'" readonly="readonly"/></div>
                                        <input type="text" class="btn btn-sm btn-danger width-5 remove_field_pdf" value="X">
                                        <input type="button" value="Upload Document" onclick="BrowseFile('.$count.')" class="btn btn-sm btn-success width-200"/>
                                   </div>';
                        $count++;
                    }
                    echo $output;
                }
                ?>
            </div>
        </div>
    </div>
    
    <!--words-->
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'doc_name_word', array('class' => 'control-label')); ?> (Word)</div>
        <div class="col-sm-10">
            <div class="col-sm-7">
                <div class=" col-xs-8 col-lg-8" style="margin-left: -25px;">
                    <?php echo $form->textField($model, 'doc_name_word', array('class' => 'form-control form-control-medium', 'id' => 'word_bm', 'readonly' => 'readonly')); ?>
                    <?php echo $form->error($model, 'doc_name_word'); ?>
                </div>
                <div class="col-xs-2 col-lg-2">
                    <input type="button" value="Upload Document" onclick="BrowseServerWord();" class="btn btn-sm btn-success width-200"/>
                </div>
            </div>
        </div>
    </div>
    <!--add word-->
    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <div class="input_fields_wrap_word">
                <button class="add_field_button_word btn btn-sm btn-warning">Add Word</button>
                <div><input type="hidden" name="word_add[]"></div>
                <?php 
                $model_word = OstPuDocument::model()->findAll(array('condition' => "pu_id=$id AND doc_type=2"));
                if(sizeof($model_word)>0){
                    $output = '';
                    $count = 1;
                    foreach($model_word as $row_word){
                        $output .= '<div class="col-sm-7">
                                        <div class="col-xs-8 col-lg-8" style="margin-left: -25px;"><input id="field'.$count.'" class="form-control" type="text" name="word_add[]" value="'.$row_word->document.'" readonly="readonly"/></div>
                                        <input type="text" class="btn btn-sm btn-danger width-5 remove_field_pdf" value="X">
                                        <input type="button" value="Upload Document" onclick="BrowseFile('.$count.')" class="btn btn-sm btn-success width-200"/>
                                   </div>';
                        $count++;
                    }
                    echo $output;
                }
                ?>
            </div>
        </div>
    </div>
    <div class="space-4"></div>
    
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'date_received', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">            
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
                <?php if (isset($_GET['date_received']) && $_GET['date_received'] != '') { ?>
                    <input  class="col-sm-3" type="text" name="date_received" value="<?php echo $_GET['date_received']; ?>" />
                <?php } else { ?>
                    <input class="col-sm-3" type="text" name="date_received" value="<?php echo $date_received ?>" />
                <?php } ?>
            </div>
            <?php echo $form->error($model, 'date_received'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <!--Pages-->
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'pages', array('class' => 'control-label')); ?> </div>
        <div class="col-sm-10">
            <?php echo $form->textfield($model, 'pages', array('class' => 'col-sm-1')); ?>
            <?php echo $form->error($model, 'pages'); ?>
        </div>
    </div>
    <div class="space-4"></div>
    
    <!--Ministry-->
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'ministry_id', array('class' => 'control-label')); ?> </div>
        <div class="col-sm-10">
            <?php // echo $form->textfield($model, 'ministry_id', array('class' => 'col-sm-7')); ?>
            <?php echo $form->dropDownList($model, 'ministry_id', OstRefList::model()->listRef3(3), array('prompt' => '-- Please Choose --','class' => 'col-sm-7')); ?>
            <?php echo $form->error($model, 'ministry_id'); ?>
        </div>
    </div>
    <div class="space-4"></div>
    
    <!--Publish-->
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'publish', array('class' => 'control-label')); ?> </div>
        <div class="col-sm-10">
            <?php echo $form->dropDownList($model, 'publish', array('0'=>'Draft', '1'=>'Publish'),array('class' => 'col-sm-2')); ?>
            <?php echo $form->error($model, 'publish'); ?>
        </div>
    </div>
    <div class="space-4"></div>
    
    <div class="clearfix form-actions no-margin">
        <a href="index.php?r=ostPu/admin" class="btn btn-purple"><i class="ace-icon fa fa-arrow-left bigger-110s"></i>&nbsp;Back</a>&nbsp;&nbsp;
        <button class="btn btn-success" type="button" onclick="window.location.reload()"><i class="ace-icon fa fa-undo bigger-110"></i>&nbsp;Reset</button>&nbsp;&nbsp;
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? '<i class="ace-icon fa fa-plus bigger-110"></i>&nbsp;Add' : '<i class="ace-icon fa fa-pencil bigger-110"></i>&nbsp;Update'; ?></button>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/date-time/bootstrap-datepicker.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/date-time/daterangepicker.js"></script>

<script>
            $(function () {
                $('input[name=daterange]').daterangepicker({
                    format: 'YYYY-MM-DD',
                    'applyClass': 'btn-sm btn-success',
                    'cancelClass': 'btn-sm btn-default',
                    locale: {
                        applyLabel: 'Apply',
                        cancelLabel: 'Cancel',
                    }
                }).prev().on(ace.click_event, function () {
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
                }).prev().on(ace.click_event, function () {
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
                }).prev().on(ace.click_event, function () {
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
                }).prev().on(ace.click_event, function () {
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
                }).prev().on(ace.click_event, function () {
                    $(this).next().focus();
                });

                $(document).one('ajaxloadstart.page', function (e) {
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

            function BrowseServerPDF() {
                var finder = new CKFinder();
                finder.basePath = '<?php echo Yii::app()->baseUrl ?>/ckeditor/ckfinder/';
                finder.selectActionFunction = SetFileFieldPDF;
                finder.popup();
            }
            function SetFileFieldPDF(fileUrl) {
                $('#pdf_bm').val(fileUrl);
                $('#doc_name_pdf').val(fileUrl);
            }
            function BrowseServerWord() {
                var finder = new CKFinder();
                finder.basePath = '<?php echo Yii::app()->baseUrl ?>/ckeditor/ckfinder/';
                finder.selectActionFunction = SetFileFieldWord;
                finder.popup();
            }
            function SetFileFieldWord(fileUrl) {
                $('#word_bm').val(fileUrl);
                $('#doc_name_word').val(fileUrl);
            }

            function BrowseFile(x) {

                var finder = new CKFinder();
                finder.basePath = '<?php echo Yii::app()->baseUrl ?>/ckeditor/ckfinder/';
                finder.selectActionFunction = SetFileFieldWordwq;
                finder.popup();

                function SetFileFieldWordwq(fileurl) {
                    $("#field" + x).val(fileurl);
                }
            }

            $(document).ready(function () {
                var max_fields = 100;
                //start pdf
                var wrapper_pdf = $(".input_fields_wrap_pdf");
                var add_button_pdf = $(".add_field_button_pdf");
                var x = 1;
                $(add_button_pdf).click(function (e) {
                    e.preventDefault();
                    if (x < max_fields) {
                        x++;
                        $(wrapper_pdf).append('<div class="col-sm-7">\n\
                                        <div class="col-xs-8 col-lg-8" style="margin-left: -25px;"><input id="field' + x + '" class="form-control" type="text" name="pdf_add[]" value="" readonly="readonly"/></div>\n\
                                        <input type="text" class="btn btn-sm btn-danger width-5 remove_field_pdf" value="X">\n\
                                        <input type="button" value="Upload Document" onclick="BrowseFile(' + x + ')" class="btn btn-sm btn-success width-200"/>\n\
                                   </div>');
                    }
                });
                $(wrapper_pdf).on("click", ".remove_field_pdf", function (e) {
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                });
                //end pdf
                
                //start words
                var wrapper_word = $(".input_fields_wrap_word");
                var add_button_word = $(".add_field_button_word");
                var x = 1;
                $(add_button_word).click(function (e) {
                    e.preventDefault();
                    if (x < max_fields) {
                        x++;
                        $(wrapper_word).append('<div class="col-sm-7">\n\
                                        <div class="col-xs-8 col-lg-8" style="margin-left: -25px;"><input id="field' + x + '" class="form-control" type="text" name="word_add[]" value="" readonly="readonly"/></div>\n\
                                        <input type="text" class="btn btn-sm btn-danger width-5 remove_field_word" value="X">\n\
                                        <input type="button" value="Upload Document" onclick="BrowseFile(' + x + ')" class="btn btn-sm btn-success width-200"/>\n\
                                   </div>');
                    }
                });
                $(wrapper_word).on("click", ".remove_field_word", function (e) {
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                });
                //end word
                
                //start replacement add
                var wrapper_replace_pu = $(".input_fields_wrap_replace_pu");
                var add_button_replace_pu = $(".add_field_button_replace_pu");
                var x = 1;
                                
                var t = $("#replacement_pu_id :selected").select().text();
                var a = $("#tbl_ref :selected").select().text();
                $("#tbl_ref").change(function() {
                    a = $("#tbl_ref :selected").select().text();
                });
                $("#replacement_pu_id").change(function() {
                    t = $("#replacement_pu_id :selected").select().text();
                });
                $(add_button_replace_pu).click(function (e) {
                    e.preventDefault();
                    if (x < max_fields) {
                        x++;
                        $(wrapper_replace_pu).append('<div class="col-sm-10">\n\
                                        <div class="col-xs-9 col-lg-9" style="margin-left: -25px;">\n\
                                            <input id="field' + x + '" class="form-control" type="text" name="replace_pu_add[]" value="'+t+'" readonly="readonly"/>\n\
                                        </div>\n\
                                        <input type="text" class="btn btn-sm btn-danger width-5 remove_field_replace_pu" value="X">\n\
                                   </div>');
                    }
                });
                $(wrapper_replace_pu).on("click", ".remove_field_replace_pu", function (e) {
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                });
                $('.remove_field_replace_pu').click(function(e) {
                    alert(1);
                    e.preventDefault();
                    $(this).parent('div').remove();
                });
                //end replacement add
                
                //start related act
                var wrapper_related_act = $(".input_fields_wrap_related_act");
                var add_button_related_act = $(".add_field_button_related_act");
                var x = 1;
                                
                var t = $("#related_act :selected").select().text();
                var a = $("#tbl_ref :selected").select().text();
                $("#tbl_ref").change(function() {
                    a = $("#tbl_ref :selected").select().text();
                });
                $("#related_act").change(function() {
                    t = $("#related_act :selected").select().text();
                });
                $(add_button_related_act).click(function (e) {
                    e.preventDefault();
                    if (x < max_fields) {
                        x++;
                        $(wrapper_related_act).append('<div class="col-sm-10">\n\
                                        <div class="col-xs-3 col-lg-3" style="margin-left: -25px; width: 24%">\n\
                                            <input id="field' + x + '" class="form-control" type="text" name="related_act_add[]" value="'+a+'" readonly="readonly"/>\n\
                                        </div>\n\
                                        <div class="col-xs-9 col-lg-9" style="margin-left: -25px;">\n\
                                            <input id="field' + x + '" class="form-control" type="text" name="related_act_add[]" value="'+t+'" readonly="readonly"/>\n\
                                        </div>\n\
                                        <input type="text" class="btn btn-sm btn-danger width-5 remove_field_related_act" value="X">\n\
                                   </div>');
                    }
                });
                $(wrapper_related_act).on("click", ".remove_field_related_act", function (e) {
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                });
                $('.remove_field_related_act').click(function (e) {
                    e.preventDefault();
                    $(this).parent('div').remove();
                });
                //end related act
            });
</script>