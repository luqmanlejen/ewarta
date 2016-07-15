<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/webshim/js-webshim/minified/polyfiller.js"></script>

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/remote-list.min.js"></script>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'ost-lom-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('class' => 'form-horizontal'))); ?>

    <div class="alert alert-danger"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Field with * are required</div>

    <?php echo $form->hiddenField($model, 'id'); ?>

    <div class="form-group">
        <div class="col-sm-3"><?php echo $form->labelEx($model, 'lom_type', array('class' => 'control-label')); ?></div>
        <div class="col-sm-9">
            <?php
            if ($model->lom_type == 'act')
                echo 'Act';
            else
                echo 'Citation';
            ?>
            <?php echo $form->hiddenField($model, 'lom_type', array('class' => 'col-sm-7', 'readonly' => 'readonly')); ?>
            <?php // echo $form->dropdownlist($model, 'lom_type', array('act' => 'Act', 'cit' => 'Citation'), array('onchange'=>'change()', 'id'=>'lom_type_choose','class'=>'col-sm-2','prompt'=>'--Please Choose--')); ?>
            <?php echo $form->error($model, 'lom_type'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group" id="section_no">
        <div class="col-sm-3"><?php echo $form->labelEx($model, 'lom_no', array('class' => 'control-label')); ?></div>
        <div class="col-sm-9">
            <?php echo $form->textField($model, 'lom_no', array('class' => 'col-sm-2', 'size' => 20, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'lom_no'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group" id="section_year">
        <div class="col-sm-3"><?php echo $form->labelEx($model, 'lom_year', array('class' => 'control-label')); ?></div>
        <div class="col-sm-9">
            <?php echo $form->textField($model, 'lom_year', array('class' => 'col-sm-2')); ?>
            <?php echo $form->error($model, 'lom_year'); ?>
        </div>
    </div>
    <div class="space-4"></div> 

    <div class="form-group" id="section_cit">
        <div class="col-sm-3"><?php echo $form->labelEx($model, 'lom_parent_act', array('class' => 'control-label')); ?></div>
        <div class="col-sm-1">
            <?php echo $form->textField($model, 'lom_parent_act', array('maxlength' => 3, 'class' => 'col-sm-12')); ?>
            <?php echo $form->error($model, 'lom_parent_act'); ?>
        </div>
        <div class="col-sm-8"><?php echo CHtml::textField('act_name', OstLom::model()->getactname($model->lom_parent_act), array('class' => 'col-sm-12', 'readonly' => 'readonly')); ?></div>
    </div>
    <div class="space-4"></div>

    <div class="form-group" id="section_title_en">
        <div class="col-sm-3"><?php echo $form->labelEx($model, 'lom_title', array('class' => 'control-label')); ?> (English Version)</div>
        <div class="col-sm-9">
            <?php echo $form->textField($model, 'lom_title', array('class' => 'col-sm-12')); ?>
            <?php echo $form->error($model, 'lom_title'); ?>
        </div>
    </div>
    <div class="space-4"></div>        

    <!--upload document-->
    <div class="form-group" id="section_doc_en">
        <div class="col-sm-3"><?php echo $form->labelEx($model, 'lom_doc', array('class' => 'control-label')); ?> (English Version)</div>
        <div class="col-sm-9">
            <div class="form-group" style="margin-bottom: 0">
                <div class="col-sm-5">
                    <?php // echo $form->textField($model, 'doc_url', array('maxlength' => 255, 'class' => 'col-sm-12')); ?>
                    <?php // echo $form->error($model, 'doc_url'); ?>

                    <input type="hidden" id="lom_doc" name="OstLom[lom_doc]" value="<?php echo $model->lom_doc; ?>">
                    <?php if (isset($model->lom_doc)) { ?>
                        <input class="col-sm-12" readonly="readonly" type="text" id="doc" class="form-control" value="<?php echo $model->lom_doc ?>">
                    <?php } else { ?>
                        <input class="col-sm-12" readonly="readonly" type="text" id="doc" class="form-control" value="">
                    <?php } ?>
                    <?php echo $form->error($model, 'lom_doc'); ?>
                </div>
                <div class="col-sm-4">
                    <input type="button" value="Upload Document" onclick="BrowseServer();" class="btn btn-sm btn-success width-200"/>
                </div>
                <div class="col-sm-3"></div>

            </div>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group" id="section_title_my">
        <div class="col-sm-3"><label class="control-label">Title</label> (Malay Version)</div>
        <div class="col-sm-9"><?php echo CHtml::textField('lom_title_my', $model2->lom_title, array('maxlength' => 255, 'class' => 'col-sm-12')); ?></div>
    </div>
    <div class="space-4"></div>

    <!--upload document malay-->
    <div class="form-group" id="section_doc_my">
        <div class="col-sm-3"><label class="control-label">Document </label> (Malay Version)</div>
        <div class="col-sm-9">
            <div class="form-group" style="margin-bottom: 0">
                <div class="col-sm-5">
                    <?php // echo CHtml::textField('doc_url_my', $model2->title, array('maxlength' => 255, 'class' => 'col-sm-12')); ?>
                    <?php echo CHtml::hiddenField('lom_doc_my', $model2->lom_doc, array('class' => 'form-control form-control-medium')); ?>
                    <?php if (isset($model2->lom_doc)) { ?>
                        <input class="col-sm-12" readonly="readonly" type="text" id="doc_my" class="form-control" value="<?php echo $model2->lom_doc ?>"/>
                    <?php } else { ?>
                        <input class="col-sm-12" readonly="readonly" type="text" id="doc_my" class="form-control" value=""/>
                    <?php } ?>
                    <?php // echo $form->error($model2, 'lom_doc_my'); ?>
                </div>
                <div class="col-sm-4">
                    <input type="button" value="Upload Document" onclick="BrowseServer2();" class="btn btn-sm btn-success width-200"/>
                </div>
                <div class="col-sm-3"></div>
            </div>   
        </div>                
    </div>
    <div class="space-4"></div>

    <div class="clearfix form-actions no-margin">
        <a href="index.php?r=OstLom/admin" class="btn btn-purple"><i class="ace-icon fa fa-arrow-left bigger-110s"></i>&nbsp;Back</a>&nbsp;&nbsp;
        <button class="btn btn-success" type="button" onclick="window.location.reload()"><i class="ace-icon fa fa-undo bigger-110"></i>&nbsp;Reset</button>&nbsp;&nbsp;
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? '<i class="ace-icon fa fa-plus bigger-110"></i>&nbsp;Add' : '<i class="ace-icon fa fa-pencil bigger-110"></i>&nbsp;Update'; ?></button>
    </div>
    <script>
                        $(function() {
                            $('#OstLom_lom_parent_act').remoteList({
                                minLength: 0,
                                maxLength: 0,
                                source: "../agcportal/act.php",
                                renderItem: function(value, label, data) {
                                    return value;
                                },
                                select: function() {
                                    var option = $(this).remoteList('selectedOption').label;
                                    var option_split = option.split("<-->");
                                    var id = option_split[0];
                                    var lom_title = option_split[1];

                                    $('#OstLom_id').val(id);
                                    $('#OstLom_lom_title').val(lom_title)
                                }
                            });
                        });
    </script>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script src="<?php echo Yii::app()->baseUrl ?>/ckeditor/ckeditor.js"></script>
<script src="<?php echo Yii::app()->baseUrl ?>/ckeditor/ckfinder/ckfinder.js"></script>

<script>

    function BrowseServer() {

        var finder = new CKFinder();

        finder.basePath = '<?php echo Yii::app()->baseUrl ?>/ckeditor/ckfinder/';

        finder.selectActionFunction = SetFileField;

        finder.popup();
    }

    function BrowseServer2() {

        var finder = new CKFinder();

        finder.basePath = '<?php echo Yii::app()->baseUrl ?>/ckeditor/ckfinder/';

        finder.selectActionFunction = SetFileField2;

        finder.popup();
    }

    function SetFileField(fileUrl) {

        //$('.div_foto').html('<img src="' + fileUrl + '">');

        $('#doc').val(fileUrl);

        $('#lom_doc').val(fileUrl);
    }

    function SetFileField2(fileUrl) {

        //$('.div_foto').html('<img src="' + fileUrl + '">');

        $('#doc_my').val(fileUrl);

        $('#lom_doc_my').val(fileUrl);
    }

</script>

<script>
    $(function() {
        $('#OstLom_lom_parent_act').change(function() {
            var lom_no = $(this).val();
            $.ajax({
                type: "post",
                url: "index.php?r=ostLom/getactname",
                data: 'lom_no=' + lom_no,
                async: false,
                success: function(data) {
                    $('#act_name').val(data);
                }
            });
        });
    });
</script>