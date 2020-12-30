<h3><?= __('Results') ?></h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('user_id', 'Firstname') ?></th>
            <th scope="col"><?= $this->Paginator->sort('user_id', 'Lastname') ?></th>
            <th scope="col"><?= $this->Paginator->sort('location_id', 'City') ?></th>
            <th scope="col"><?= $this->Paginator->sort('average') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($userdetails as $userdetail): ?>
        <tr>
            <td><?= h($userdetail->user->firstname) ?></td>
            <td><?= h($userdetail->user->lastname) ?></td>
            <td><?= $userdetail->user->location->city ?></td>
            <td><?= $userdetail->average ?>%</td>
            <td><?= h($userdetail->created) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $userdetail->id], ['target'=>'_blank']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php 
    if($this->request->session()->read('Auth.User.type') == 'superadmin' || $this->request->session()->read('Auth.User.type') == 'admin'){
        echo $this->Html->link(__('View All'), ['action' => 'viewall'], ['target'=>'_blank']);
    }
?>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
        <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
</div>