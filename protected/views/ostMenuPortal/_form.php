<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'ost-menu-portal-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('class' => 'form-horizontal'))); ?>

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
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'menu_type', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php
            echo $form->dropdownlist($model, 'menu_type', array('header' => 'Header', 'footer' => 'Footer', 'others' => 'Others'), array('class' => 'col-sm-2', 'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('ostMenuPortal/changeparent'),
                    'success' => 'function(data){
                            $("#OstMenuPortal_parent_menu").html(data);
                        }'
                ,)));
            ?>
            <?php echo $form->error($model, 'menu_type'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'parent_menu', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php echo $form->dropdownlist($model, 'parent_menu', $model->getparent($model->menu_type), array('class' => 'col-sm-7')); ?>
            <?php echo $form->error($model, 'parent_menu'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'sort', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'sort', array('class' => 'col-sm-2')); ?>
            <?php echo $form->error($model, 'sort'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'hide_ind', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php echo $form->dropdownlist($model, 'hide_ind', array('0' => 'Show', '1' => 'Hide'), array('class' => 'col-sm-2')); ?>
            <?php echo $form->error($model, 'hide_ind'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'url', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'url', array('class' => 'col-sm-7')); ?>
            <?php // echo $form->dropdownlist($model, 'url', array('portal2/left' => 'portal2/left', 'portal2/full' => 'portal2/full'), array('prompt' => '--Please Choose--','class' => 'col-sm-2')); ?>
            <br><br>Note : Please enter <font color="#A94442">portal2/left</font> for page with left menu or <font color="#A94442">portal2/full</font> for full page
            <?php echo $form->error($model, 'url'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><?php echo $form->labelEx($model, 'required_approval', array('class' => 'control-label')); ?></div>
        <div class="col-sm-10">
            <?php echo $form->dropdownlist($model, 'required_approval', array('0' => 'No', '1' => 'Yes',), array('class' => 'col-sm-2')); ?>
            <?php echo $form->error($model, 'required_approval'); ?>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="form-group">
        <div class="col-sm-2"><label class="control-label required">Division Access</label></div>
        <div class="col-sm-10" id="divroles">
            <?php
            $rolesarr = array();
            if (!$model->isNewRecord) {
                $rolesarr = $model->getdvsn();
            }
            if (isset($_POST['role_code'])) {
                $rolesarr = $_POST['role_code'];
            }
            echo CHtml::checkBoxList('role_code', $rolesarr, OstRefList::model()->listRef3(3));
            ?>
            <div class="errorMessage" id="errorMessageDvsn" style="display:none;">Please select at least ONE (1) division.</div>
        </div>
    </div>
    <div class="space-4"></div>

    <div class="clearfix form-actions no-margin">
        <a href="index.php?r=ostMenuPortal/admin" class="btn btn-purple"><i class="ace-icon fa fa-arrow-left bigger-110s"></i>&nbsp;Back</a>&nbsp;&nbsp;
        <button class="btn btn-success" type="button" onclick="window.location.reload()"><i class="ace-icon fa fa-undo bigger-110"></i>&nbsp;Reset</button>&nbsp;&nbsp;
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? '<i class="ace-icon fa fa-plus bigger-110"></i>&nbsp;Add' : '<i class="ace-icon fa fa-pencil bigger-110"></i>&nbsp;Update'; ?></button>
    </div>

    <script>
            $(function() {
                activemenu('menu7', 'menu8');
                $('[data-rel=tooltip]').tooltip({container: 'body'});
            });
    </script>

    <?php $this->endWidget(); ?>

</div><!-- form -->