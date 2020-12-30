<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Admin Lists'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Admin'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="schools index large-9 medium-8 columns content">
    <h3><?= __('Update Profile') ?></h3>
    <?= $this->Form->create($admin) ?>
    <?= $this->Form->input('firstname',['class'=>'form-control', 'required'=>true]) ?>
    <?= $this->Form->input('lastname',['class'=>'form-control', 'required'=>true]) ?>
    <?= $this->Form->input('username',['class'=>'form-control', 'required'=>true]) ?>
    <?= $this->Form->input('location_id',['options'=>$locations, 'required'=>true]) ?>
    <?= $this->Form->button('Submit',['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
