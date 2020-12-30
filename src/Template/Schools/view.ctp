<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit School'), ['action' => 'edit', $school->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete School'), ['action' => 'delete', $school->id], ['confirm' => __('Are you sure you want to delete # {0}?', $school->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Schools'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New School'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="schools view large-9 medium-8 columns content">
    <h3><?= h($school->id) ?></h3>
    <table class="table table-striped">
        <tr>
            <th scope="row"><?= __('Location') ?></th>
            <td><?= $school->has('location') ? $this->Html->link($school->location->city, ['controller' => 'Locations', 'action' => 'view', $school->location->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('School') ?></th>
            <td><?= h($school->school) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($school->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($school->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($school->modified) ?></td>
        </tr>
    </table>
</div>
