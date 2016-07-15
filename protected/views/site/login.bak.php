<div class="login">

    <h1>Login</h1><h4>MCC CMS</h4><br>

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true,),
    ));
    ?>


    <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => 'Username')); ?><br>

    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Password')); ?><br>

    <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-success')); ?>

    <?php echo CHtml::resetButton('Reset', array('class' => 'btn btn-warning')); ?>

    <?php $this->endWidget(); ?>

</div>