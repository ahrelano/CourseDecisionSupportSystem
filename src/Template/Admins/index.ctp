<div class="col-md-4 pull-right" align="right">
<h4><?= __('Actions') ?></h4>
    <?= $this->Html->link('New Admin', ['action'=>'add']) ?>
</div>

<div class="columns content">
    <h3><?= __('Admins') ?></h3>
    <table class="table table-bordered" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->created) ?></td>
                <td><?= h($user->modified) ?></td>
                <td class="actions">
                    <?= $this->Form->button(__('View'), ['class'=>'btn btn-success','data-toggle'=>'modal', 'data-target'=>'#editAdmin'. $user->id]) ?> | 
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['class'=>'btn btn-danger','confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                </td>
                <div class="modal fade" id="editAdmin<?= $user->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?= $user->id ?></h4>
                      </div>
                      <div class="modal-body">
                        Username: <?= $user->username ?><br>
                        Firstname: <?= $user->firstname ?><br>
                        Lastname: <?= $user->lastname ?><br>
                        Location: <?= $user->location->city ?>
                      </div>
                      <div class="modal-footer">
                        <?= $this->Html->link('Change Password', ['action'=>'change-password',$user->id], ['class'=>'btn btn-info']) ?>
                        <?= $this->Html->link('Update Profile', ['action'=>'update-profile',$user->id], ['class'=>'btn btn-warning']) ?>
                      </div>
                    </div>
                  </div>
                </div>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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
</div>