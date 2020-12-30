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
<center>
<div class="col-md-4"></div>
	<div class="col-md-4">
    <fieldset>
        <legend><?= __('Change Password') ?></legend>
		<?= $this->Form->create($user) ?>
	    <?php
	    echo $this->Form->control('currentpassword', ['type'=>'password', 'label'=>'Old Password', 'required'=>true, 'value'=>'', 'class'=>'form-control']);
	    echo $this->Form->control('password', ['type'=>'password', 'label'=>'New Password', 'required'=>true, 'value'=>'', 'class'=>'form-control pRegister']);
	    echo $this->Form->control('confirmpassword', ['type'=>'password', 'label'=>'Confirm Password', 'required'=>true, 'value'=>'', 'class'=>'form-control cRegister']);
	    ?>
	    <div class="notifPassword"></div>
		<?= $this->Form->button('Submit',['class'=>'form-control btn btn-primary btnRegister']) ?>
		<?= $this->Form->end() ?>
	</fieldset>
 	</div>
</center>