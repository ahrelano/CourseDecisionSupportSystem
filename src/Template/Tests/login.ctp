<center>
<div class="col-md-4"></div>
	<div class="col-md-4">
	<fieldset>
        <legend><?= __('Login') ?></legend>
		<?= $this->Form->create() ?>
		<?= $this->Form->input('username',['class'=>'form-control']) ?>
		<?= $this->Form->input('password',['class'=>'form-control']) ?><br>
		<?= $this->Form->button('Log In',['class'=>'form-control btn-primary']) ?>
		<?= $this->Form->end() ?><br>
		<?= $this->Html->link('Register',['controller'=>'Tests', 'action'=>'register'],['class'=>'form-control btn-primary']) ?><br><br>
	</fieldset>
	</div>
</center>