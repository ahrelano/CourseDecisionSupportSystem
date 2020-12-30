<script>
$(function() {
    $('#bday').datepicker({  
        maxDate: new Date(),
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });
});
</script>
<center>
<div class="col-md-4"></div>
	<div class="col-md-4">
    <fieldset>
        <legend><?= __('Update Profile') ?></legend>
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
		<?= $this->Form->input('location_id',['options'=>$locations, 'required'=>true]) ?>
		<?= $this->Form->control('address', ['label'=>'Full Address', 'class'=>'form-control','required'=>true]) ?>
        <?= $this->Form->control('gender', ['options'=>$gender,'class'=>'form-control','required'=>true]) ?>
        <?= $this->Form->control('birthday', ['id'=>'bday', 'label'=>'Birthday', 'class'=>'form-control','readonly'=>true]) ?>
		<?= $this->Form->button('Submit',['class'=>'form-control btn btn-primary']) ?>
		<?= $this->Form->end() ?>
	</fieldset>
 	</div>
</center>