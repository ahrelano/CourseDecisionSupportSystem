<style>
.btn-primary[disabled] {
    background-color: #cccccc;
  	color: #666666;
    border-color: #2e6da5;
}
</style>
<script>
$(function() {
    $('#bday').datepicker({  
        maxDate: new Date(),
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });
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
<center>
<div class="col-md-4"></div>
	<div class="col-md-4">
    <fieldset>
        <legend><?= __('Register') ?></legend>
        <?php 
        $gender =[
            'Male'=>'Male',
            'Female'=>'Female'
        ];
        ?>
		<?= $this->Form->create($user) ?>
		<?= $this->Form->input('firstname',['class'=>'form-control', 'required'=>true]) ?>
		<?= $this->Form->input('lastname',['class'=>'form-control', 'required'=>true]) ?>
		<?= $this->Form->input('username',['class'=>'form-control', 'required'=>true]) ?>
        <?= $this->Form->input('location_id',['options'=>$locations, 'class'=>'form-control', 'required'=>true]) ?>
        <?= $this->Form->control('address', ['label'=>'Full Address', 'class'=>'form-control','required'=>true]) ?>
        <?= $this->Form->control('gender', ['options'=>$gender,'class'=>'form-control','required'=>true]) ?>
        <?= $this->Form->control('birthday', ['id'=>'bday', 'label'=>'Birthday', 'class'=>'form-control','readonly'=>true]) ?>
		<?= $this->Form->input('password',['class'=>'form-control pRegister', 'required'=>true]) ?>
		<?= $this->Form->input('confirmpassword',['type'=>'password','class'=>'form-control cRegister', 'label'=>'Confirm Password','required'=>true]) ?>
		<div class="notifPassword"></div><br>
		<input type="submit" name="register" class="form-control btn-primary btnRegister" value="Register"><br>
		<?= $this->Html->link('Login',['controller'=>'Tests', 'action'=>'login'],['class'=>'form-control btn-primary', 'align'=>'center']) ?><br><br>
		<?= $this->Form->end() ?>
	</fieldset>
 	</div>
</center>
<br><br>