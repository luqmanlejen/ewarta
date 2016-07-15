<style>

    .div_foto{
        min-width:50px;
        height:152px;
    }

    .div_foto img { 
        background-color: #FFFFFF;
        border: 1px solid #CCCCCC;
        border-radius: 4px;
        height:150px;    
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
    }

</style>

<script src="<?php echo Yii::app()->baseUrl ?>/ckeditor/ckeditor.js"></script>

<script src="<?php echo Yii::app()->baseUrl ?>/ckeditor/ckfinder/ckfinder.js"></script>

<script>

    function BrowseServer() {
        var finder = new CKFinder();
        finder.basePath = '<?php echo Yii::app()->baseUrl ?>/ckeditor/ckfinder/';
        finder.selectActionFunction = function(fileUrl, data) {
            this.closePopup();
            var photolist = this.getSelectedFiles();
            var folder = this.getSelectedFolder();
            var folderurl = folder.getUrl();
            SetPhotoList(folderurl, photolist);
        };
        finder.popup();
    }

    var global_no = 0;
    function SetPhotoList(folderurl, photolist) {
        var photolist2 = String(photolist);
        var photolist_arr = photolist2.split(",");
        var output = '';
        for (var x = 0; x < photolist_arr.length; x++) {
            global_no++;
            var img = folderurl + photolist_arr[x];
            output += '<div class="photo photo_new photo_' + global_no + '">\n\
                            <img src="' + img + '">\n\
                            <input name="photolist[]" type="hidden" value="' + global_no + '"><br><br>\n\
                            <input name="photolist_sort_' + global_no + '" type="text" value="0" class="form-control" >\n\
                            <input name="photolist_imgurl_' + global_no + '" type="hidden" value="' + img + '" class="photolist">\n\
                            <span class="delete" onclick="DeletePhoto2(' + global_no + ')">X</span>\n\
                       </div>';
        }
        $('#photolist').prepend(output);
    }

    function DeletePhoto2(no) {
        $('.photo_' + no).remove();

    }

</script>

<style>

    #cke_Gal_gal_descr .cke_contents, #cke_GalLang_descr .cke_contents{ height : 200px !important; }
    .pl { overflow:hidden; width:100%; margin-bottom : 5px; }
    .photo { display : inline-block; margin : 10px; position : relative; }
    .photo img { width : 200px; border : 1px solid #D6D6D6; padding : 10px; }
    .photo .delete { 
        font-weight : bold;
        color : white;
        padding : 10px 15px;
        background: #D54346;
        position: absolute !important;
        top: -10px !important;
        right: -10px !important;
        border-radius: 50%; 
        cursor :pointer; 
    }

</style>

<?php
$date = '';

if (!$model->isNewRecord) {

    if ($model->event_dt != '0000-00-00') {
        $date = $model->event_dt;
    }
}
?>
<script src="<?php echo Yii::app()->baseUrl ?>/ckeditor/ckeditor.js"></script>
<script src="<?php echo Yii::app()->baseUrl ?>/ckeditor/ckfinder/ckfinder.js"></script>

<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/jquery-ui.custom.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/chosen.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/datepicker.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/bootstrap-timepicker.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/daterangepicker.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/bootstrap-datetimepicker.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/colorpicker.css" />

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'ost-photo-album-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('class' => 'form-horizontal'))); ?>

    <div class="alert alert-danger"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Field with * are required</div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'title', array('class' => 'control-label')); ?> (English Version)</div>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'title', array('maxlength' => 255, 'class' => 'col-sm-7')); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><label class="control-label required">Title</label> (Malay Version)</div>
        <div class="col-sm-10"><?php echo CHtml::textField('title_my', $model2->title, array('maxlength' => 255, 'class' => 'col-sm-7')); ?></div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'descr', array('class' => 'control-label')); ?> <br>(English Version)</div>
        <div class="col-sm-10">
            <?php echo $form->textArea($model, 'descr'); ?>
            <?php echo $form->error($model, 'descr'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><label class="control-label">Description</label> <br>(Malay Version)</div>
        <div class="col-sm-10"><?php echo CHtml::textArea('descr_my', $model2->descr); ?></div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'event_dt', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <!--<div class="col-sm-4">-->
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
                <?php if (isset($_GET['event_dt']) && $_GET['event_dt'] != '') { ?>
                    <input  class="col-sm-6" style="width:56%" type="text" name="date" value="<?php echo $_GET['event_dt']; ?>" />
                <?php } else { ?>
                    <input class="col-sm-6" style="width:56%" type="text" name="date" value="<?php echo $date ?>" />
                <?php } ?>
            </div>
            <!--</div>-->
            <?php echo $form->error($model, 'event_dt'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <?php if (Yii::app()->controller->action->id == 'update') { ?>
        <div class="form-group">
            <div class="col-sm-2">Photo List</div>
            <div class="col-sm-10">
                <tr>
                    <td colspan="2">
                        <input type="button" value="Upload Image" onclick="BrowseServer();" class="btn btn-primary" style="margin:0 !important;"/>                    
                        <div id="photolist" style="margin-top:10px;">
                            <?php
                            if (sizeof($model5) > 0) {
                                foreach ($model5 as $row5) {
                                    echo '<div class="photo">'
                                    . '<img src="' . $row5->url . '">'
                                    . '<span class="delete" onclick="DeletePhoto(' . $row5->id . ')">X</span>'
                                    . '<br><br>'
                                    . '<input name="photolist_old_sort_' . $row5->id . '" type="text" value="' . $row5->sort . '" class="form-control">'
                                    . '<input name="photolist_old[]" type="hidden" value="' . $row5->id . '">'
                                    . '</div>';
                                }
                            }
                            ?>
                        </div>
                    </td>
                </tr>
            </div>
        </div>
        <div class="space-4"></div>
    <?php } ?>
        
    <div class="form-group">
        <div class="col-sm-2"><label class="control-label required">Sort</label></div>
        <div class="col-sm-10"><?php echo CHtml::textField('sort', $model2->title, array('class' => 'col-sm-1')); ?></div>
    </div>
    <div class="space-4"></div>
    
    <div class="clearfix form-actions no-margin">
        <a href="index.php?r=ostPhotoAlbum/admin" class="btn btn-purple"><i class="ace-icon fa fa-arrow-left bigger-110s"></i>&nbsp;Back</a>&nbsp;&nbsp;
        <button class="btn btn-success" type="button" onclick="window.location.reload()"><i class="ace-icon fa fa-undo bigger-110"></i>&nbsp;Reset</button>&nbsp;&nbsp;
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? '<i class="ace-icon fa fa-plus bigger-110"></i>&nbsp;Add' : '<i class="ace-icon fa fa-pencil bigger-110"></i>&nbsp;Update'; ?></button>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/date-time/bootstrap-datepicker.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/date-time/bootstrap-timepicker.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/date-time/moment.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/date-time/daterangepicker.js"></script>

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/jquery.hotkeys.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/bootstrap-wysiwyg.js"></script>

<script type="text/javascript">

    CKEDITOR.replace('ckeditor');

    function DeletePhoto(id) {

        var r = confirm("Are you sure to delete this photo? \n\Please make sure you have save the form first before proceed");

        if (r == 1)
            window.location = 'index.php?r=OstPhotoAlbum/deletePhoto&id=' + id;

    }

</script>

<script>

    $(function() {

        CKEDITOR.replace('OstPhotoAlbum_descr', {height: 300});
        CKEDITOR.replace('descr_my', {height: 300});

        $('input[name=date]').datepicker({
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
            $('.datepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
        });

    });

</script>