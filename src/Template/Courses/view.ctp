<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Course'), ['action' => 'edit', $course->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Course'), ['action' => 'delete', $course->id], ['confirm' => __('Are you sure you want to delete # {0}?', $course->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Courses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="courses view large-9 medium-8 columns content">
    <h3><?= h($course->id) ?></h3>
    <table class="table table-striped">
        <tr>
            <th scope="row"><?= __('School') ?></th>
            <td><?= $course->has('school') ? $this->Html->link($course->school->school, ['controller' => 'Schools', 'action' => 'view', $course->school->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= $course->has('subject') ? $this->Html->link($course->subject->subject, ['controller' => 'Subjects', 'action' => 'view', $course->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Course') ?></th>
            <td><?= h($course->course) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($course->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Percentage') ?></th>
            <td><?= $this->Number->format($course->percentage) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($course->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($course->modified) ?></td>
        </tr>
    </table>
</div>
