<?php
include 'header.php';
?>
<style>
    .div_foto{
        min-width:50px;
        max-height:152px;
    }

    .div_foto img { 
        background-color: #FFFFFF;
        border: 1px solid #CCCCCC;
        border-radius: 4px;
        max-height:150px;
        max-width: 100%;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
    }
    .div_foto2{
        min-width:50px;
        max-height:152px;
    }

    .div_foto2 img { 
        background-color: #FFFFFF;
        border: 1px solid #CCCCCC;
        border-radius: 4px;
        max-height:150px;
        max-width: 100%;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
    }
</style>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'ost-media-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('class' => 'form-horizontal'))); ?>

    <div class="alert alert-danger"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Field with * are required</div>
    <!--Title-->
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'title', array('class' => 'control-label')); ?> (English Version)</div>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'title', array('maxlength' => 255, 'class' => 'col-sm-12')); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
    </div>
    <div class="space-4"></div>
    <div class="form-group">
        <div class="col-sm-2"><label class="control-label">Title</label> (Malay Version)</div>
        <div class="col-sm-10"><?php echo CHtml::textField('title_my', $model2->title, array('maxlength' => 255, 'class' => 'col-sm-12')); ?></div>
    </div>
    <div class="space-4"></div>
    
    <?php if($_GET['media_type'] != 'background') { ?>
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'url', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <div class="form-group" style="margin-bottom: 0">
                <div class="col-sm-8"><?php echo $form->textField($model, 'url', array('maxlength' => 255, 'class' => 'col-sm-12')); ?></div>
                <div class="col-sm-4"><input type="button" value="Upload" onclick="BrowseServer3();" class="btn btn-sm btn-success width-200"/></div>
            </div>
            <?php if($_GET['media_type'] == 'slider' || $_GET['media_type'] == 'slider2') { ?>
            <p style="color:red;"><b>Note :</b> Set url to slider image. Insert <b><i>'http://'</i></b> for each outside url</p>
            <?php } ?>
        </div>
    </div>
    <div class="space-4"></div>
    <?php } ?>
    
    <!--Image-->
    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'img', array('class' => 'control-label')); ?> (English Version) </div>
        <div class="col-sm-10">
            <?php echo $form->hiddenField($model, 'img'); ?>
            <?php if (isset($model->img) && $model->img != '') { ?>
                <div class="div_foto"><img src="<?php echo $model->img; ?>"></div>
            <?php } else { ?>
                <div class="div_foto"><img src="images/no_image.png"></div>
            <?php } ?>
                
            <div class="space-4"></div>
            <input type="button" value="Upload Image" onclick="BrowseServer();" class="btn btn-sm btn-success" style="width:200px;"/>
            <!--<span style="color:red; position: absolute; padding: 8px 10px;">-->
            <br><p style="color:red;"><b>Note :</b> Optimal resolution for the Image is 885px X 200px. Only Image with png, jpg and jpeg format are allowed</p>
            <!--</span>-->
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><label class="control-label">Image</label> (Malay Version) </div>
        <div class="col-sm-10">
            <?php echo CHtml::hiddenField('img_url_my', $model2->img); ?>
            <?php if (isset($model2->img) && $model2->img != '') { ?>
                <div class="div_foto2"><img src="<?php echo $model2->img; ?>"></div>
            <?php } else { ?>
                <div class="div_foto2"><img src="images/no_image.png"></div>
            <?php } ?>
            <div class="space-4"></div>
            <input type="button" value="Upload Image" onclick="BrowseServer2();" class="btn btn-sm btn-success" style="width:200px;"/>
            <!--<span style="color:red; position: absolute; padding: 8px 10px;">-->
            <br><p style="color:red;"><b>Note :</b> Optimal resolution for the Image is 885px X 200px. Only Image with png, jpg and jpeg format are allowed</p>
            <!--</span>-->
        </div>                
    </div>
    <div class="space-4"></div>

    <div class="clearfix form-actions no-margin">
        <a href="index.php?r=ostMedia/admin&media_type=<?php echo $_GET['media_type']; ?>" class="btn btn-purple"><i class="ace-icon fa fa-arrow-left bigger-110s"></i>&nbsp;Back</a>&nbsp;&nbsp;
        <button class="btn btn-success" type="button" onclick="window.location.reload()"><i class="ace-icon fa fa-undo bigger-110"></i>&nbsp;Reset</button>&nbsp;&nbsp;
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? '<i class="ace-icon fa fa-plus bigger-110"></i>&nbsp;Add' : '<i class="ace-icon fa fa-pencil bigger-110"></i>&nbsp;Update'; ?></button>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->

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

                    function BrowseServer3() {

                        var finder = new CKFinder();

                        finder.basePath = '<?php echo Yii::app()->baseUrl ?>/ckeditor/ckfinder/';

                        finder.selectActionFunction = SetFileField3;

                        finder.popup();
                    }

                    function SetFileField(fileUrl) {

                        $('.div_foto').html('<img src="' + fileUrl + '">');

                        $('#OstMedia_img').val(fileUrl);

                        //$('#img_url').val(fileUrl);
                    }

                    function SetFileField2(fileUrl) {

                        $('.div_foto2').html('<img src="' + fileUrl + '">');

                        //$('#img_my').val(fileUrl);

                        $('#img_url_my').val(fileUrl);
                    }

                    function SetFileField3(fileUrl) {

                        //$('.div_foto').html('<img src="' + fileUrl + '">');

                        $('#OstMedia_url').val(fileUrl);

                        //$('#link_url').val(fileUrl);
                    }

</script>