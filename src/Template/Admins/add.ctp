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
    </ul>
</nav>
<div class="schools index large-9 medium-8 columns content">
    <h3><?= __('Add Admin') ?></h3>
    <?= $this->Form->create($admin) ?>
    <?= $this->Form->input('firstname',['class'=>'form-control', 'required'=>true]) ?>
    <?= $this->Form->input('lastname',['class'=>'form-control', 'required'=>true]) ?>
    <?= $this->Form->input('username',['class'=>'form-control', 'required'=>true]) ?>
    <?= $this->Form->input('location_id',['options'=>$locations, 'class'=>'form-control','required'=>true]) ?>
    <?= $this->Form->input('password',['class'=>'form-control pRegister', 'required'=>true]) ?>
    <?= $this->Form->input('confirmpassword',['type'=>'password','class'=>'form-control cRegister', 'label'=>'Confirm Password','required'=>true]) ?>
    <div class="notifPassword"></div><br>
    <input type="submit" name="register" class="btn btn-primary col-md-4 btnRegister" value="Add"><br>
    <?= $this->Form->end() ?>
</div>
