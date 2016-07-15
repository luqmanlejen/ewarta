<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/webshim/js-webshim/minified/polyfiller.js"></script>

<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/remote-list.min.js"></script>

<style>
    mark, .mark {padding:0 !important;background-color: #F2DEDE !important;color: #A94442;}
</style>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'ost-user-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('class' => 'form-horizontal'))); ?>

    <div class="alert alert-danger"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Field with * are required</div>

    <?php echo $form->hiddenField($model, 'hrstafperibadi_id'); ?>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php
            if (!$model->isNewRecord)
                echo $form->textField($model, 'name', array('maxlength' => 255, 'class' => 'col-sm-7'));
            else {
                $nametxt = '';
                if (isset($_POST['OstUser']) && $_POST['OstUser']['name'] != '')
                    $nametxt = $_POST['OstUser']['name'];
                echo '<input maxlength="255" class="col-sm-7" name="OstUser[name]" id="OstUser_name" type="text" data-list-highlight="true" data-list-value-completion="true" autocomplete="off" value="' . $nametxt . '">';
            }
            ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'ic_no', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'ic_no', array('maxlength' => 20, 'class' => 'col-sm-3')); ?>
            <?php echo $form->error($model, 'ic_no'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'email', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'email', array('maxlength' => 255, 'class' => 'col-sm-7')); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'pwd', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php //echo $form->passwordField($model, 'pwd', array('maxlength' => 255, 'class' => 'col-sm-3')); ?>
            <input maxlength="255" class="col-sm-3" name="OstUser[pwd]" id="OstUser_pwd" type="password">
            <?php
            if (!$model->isNewRecord) {
                echo '<br><br>Note : Enter the new password only if you want to update the password. Otherwise, leave the password field blank.';
            }
            ?>
            <?php echo $form->error($model, 'pwd'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'status', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">

            <?php
            $status1 = '';
            $status0 = '';
            if ($model->isNewRecord) {
                $status1 = 'checked';
            } else {
                if ($model->status == 1)
                    $status1 = 'checked';
                else
                    $status0 = 'checked';
            }
            ?>

            <div class="col-sm-2">
                <div class="radio">
                    <label class="no-padding">
                        <input name="OstUser[status]" class="ace" type="radio" value="1" <?php echo $status1; ?>>
                        <span class="lbl"> Active</span>
                    </label>
                </div>
            </div>

            <div class="col-sm-2"><div class="radio">
                    <label>
                        <input name="OstUser[status]" class="ace" type="radio" value="0" <?php echo $status0; ?>>
                        <span class="lbl"> Not Active</span>
                    </label>
                </div></div>

            <?php echo $form->error($model, 'status'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'notes', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php echo $form->textArea($model, 'notes', array('rows' => 6, 'class' => 'col-sm-7')); ?>
            <?php echo $form->error($model, 'notes'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><label class="control-label required">Roles <span class="required">*</span></label></div>
        <div class="col-sm-10" id="divroles">
            <?php
            $rolesarr = array();
            $rolesarr2 = array();

            if (!$model->isNewRecord) {
                $rolesarr = $model->getroles2(1, $model->id);
                $rolesarr2 = $model->getroles2(2, $model->id);
            }

            if (isset($_POST['role_code']) && isset($_POST['role_code2'])) {
                $rolesarr = $_POST['role_code'];
                $rolesarr2 = $_POST['role_code2'];
            }

            echo CHtml::checkBoxList('role_code', $rolesarr, OstRefList::model()->listRef3(1)) . ':-<br><div style="padding-left:20px;">' . CHtml::checkBoxList('role_code2', $rolesarr2, OstRefList::model()->listRef3(2)) . '</div>';
            ?>
            <div class="errorMessage" id="errorMessageRoles" style="display:none;">Please select at least ONE (1) roles.</div>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="clearfix form-actions no-margin">
        <a href="index.php?r=ostUser/admin" class="btn btn-purple"><i class="ace-icon fa fa-arrow-left bigger-110s"></i>&nbsp;Back</a>&nbsp;&nbsp;
        <button class="btn btn-success" type="button" onclick="window.location.reload()"><i class="ace-icon fa fa-undo bigger-110"></i>&nbsp;Reset</button>&nbsp;&nbsp;
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? '<i class="ace-icon fa fa-plus bigger-110"></i>&nbsp;Add' : '<i class="ace-icon fa fa-pencil bigger-110"></i>&nbsp;Update'; ?></button>
    </div>

    <script>
            (function() {
                var stateMatches = {
                    'true': true,
                    'false': false,
                    'auto': 'auto'
                };
                var enhanceState = (location.search.match(/enhancelist\=([true|auto|false]+)/) || ['', 'auto'])[1];
                $(function() {
                    $('.polyfill-type select').val(enhanceState).on('change', function() {
                        location.search = 'enhancelist=' + $(this).val();
                    });
                });
                webshims.setOptions('forms', {
                    customDatalist: stateMatches[enhanceState]
                });
            })();
            webshims.polyfill('forms');

            $(function() {
                $('#OstUser_name').remoteList({
                    minLength: 0,
                    maxLength: 0,
                    source: "../agcportal/crest.php",
                    renderItem: function(value, label, data) {
                        return value;
                    },
                    select: function() {
                        var option = $(this).remoteList('selectedOption').label;
                        var option_split = option.split("<-->");
                        var hrstafperibadi_id = option_split[0];
                        var ic_no = option_split[1];
                        var email = option_split[2];

                        //alert(option);

                        $('#OstUser_hrstafperibadi_id').val(hrstafperibadi_id);
                        $('#OstUser_ic_no').val(ic_no);
                        $('#OstUser_email').val(email);
                    }
                });


            });
    </script>


    <script>
        $(function() {
            $('#ost-user-form').submit(function() {
                var atLeastOneIsChecked = $('#divroles :checkbox:checked').length > 0;
                var status = 1;
                if (atLeastOneIsChecked === false) {
                    status = 0;
                    $('#errorMessageRoles').show();
                }

                if (status === 0)
                    return false;
            });
        });
    </script>

    <?php $this->endWidget(); ?>

</div><!-- form -->