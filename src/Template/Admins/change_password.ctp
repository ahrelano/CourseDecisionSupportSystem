<style>
.btn-primary[disabled] {
    background-color: #cccccc;
    color: #666666;
    border-color: #2e6da5;
}
</style>
<script>
$(function() {
    $(".pRegister").keyup(function() {
        if ($(".pRegister").val() != "" && $(".cRegister").val() != "" && $(".pRegister").val() != $(".cRegister").val()) {
            $(".notifPassword").html("<span style=\"color:red;\">Password not match!</span>");
            $(".btnRegister").prop( "disabled", true );
        }else if($(".pRegister").val() == $(".cRegister").val() && $(".pRegister").val() != "" && $(".cRegister").val() != ""){
            $(".notifPassword").html("<span style=\"color:green;\">Password match!</span>");
            $(".btnRegister").prop( "disabled", false );
        }
    });

    $(".cRegister").keyup(function() {
        if ($(".pRegister").val() != "" && $(".cRegister").val() != "" && $(".pRegister").val() != $(".cRegister").val()) {
            $(".notifPassword").html("<span style=\"color:red;\">Password not match!</span>");
            $(".btnRegister").prop( "disabled", true );
        }else if($(".pRegister").val() == $(".cRegister").val() && $(".pRegister").val() != "" && $(".cRegister").val() != ""){
            $(".notifPassword").html("<span style=\"color:green;\">Password match!</span>");
            $(".btnRegister").prop( "disabled", false );
        }
    });

    $(".btnRegister").click(function(){
        if ($(".pRegister").val() != "" && $(".cRegister").val() != "" && $(".pRegister").val() != $(".cRegister").val()) {
            alert("Password not match!");
            return false;
        }
    });
});
</script>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Admin Lists'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Admin'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="schools index large-9 medium-8 columns content">
    <h3><?= __('Change Password') ?></h3>
    <?= $this->Form->create($admin) ?>
    <?php
    echo $this->Form->control('password', ['type'=>'password', 'label'=>'New Password', 'required'=>true, 'value'=>'', 'class'=>'form-control pRegister']);
    echo $this->Form->control('confirmpassword', ['type'=>'password', 'label'=>'Confirm Password', 'required'=>true, 'value'=>'', 'class'=>'form-control cRegister']);
    ?>
    <div class="notifPassword"></div>
    <?= $this->Form->button('Submit',['class'=>'btn btn-primary btnRegister']) ?>
    <?= $this->Form->end() ?>
</div>
