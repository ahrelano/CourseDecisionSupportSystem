<script>
  $( function() {
    $('#fromDate, #toDate').datepicker({  
        maxDate: new Date(),
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });
    $('#fromDate').change(function(){
        $('#toDate').datepicker('option', 'minDate', $('#fromDate').datepicker('getDate'))
    });
  } );
</script>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Question'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
        <?= $this->Form->create() ?>
        <?= $this->Form->control('subject', ['options'=>$subjects]) ?>
        <?= $this->Form->control('fromdate', ['id'=>'fromDate', 'label'=>'From: ', 'readonly'=>true]) ?>
        <?= $this->Form->control('todate', ['id'=>'toDate', 'label'=>'To: ', 'readonly'=>true]) ?>
        <?= $this->Form->button('Search', ['class'=>'btn btn-primary']) ?>
        <?= $this->Form->end() ?><br><br>
    </ul>
</nav>
<div class="questions index large-9 medium-8 columns content">
    <h3><?= __('Questions') ?></h3>
    <table class="table table-bordered" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subject_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('answer') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= _('History') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questions as $question): ?>
            <tr>
                <td><?= $this->Number->format($question->id) ?></td>
                <td><?= $question->has('subject') ? $this->Html->link($question->subject->subject, ['controller' => 'Subjects', 'action' => 'view', $question->subject->id]) : '' ?></td>
                <td><?= h($question->answer) ?></td>
                <td><?= h($question->created) ?></td>
                <td><a href="" data-toggle="modal" data-target="#history<?= $question->id ?>">View History</a></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $question->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $question->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id)]) ?>
                </td>
            </tr>
            <!-- History Modal -->
            <div class="modal fade" id="history<?= $question->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit History</h4>
                  </div>
                  <div class="modal-body">
                    <?php $count=1; foreach ($historyquestions as $historyquestion): ?>
                        <?php if ($historyquestion->question_id == $question->id): ?>
                            <?php if ($count == 1){ ?>
                                <p><h5>Date: <?= $historyquestion->created ?></h5>
                                Question: <?= $historyquestion->question ?><br>
                                <?php if($historyquestion->img != ''){ ?>
                                    <div class="tz-gallery">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-4">
                                                <a class="lightbox" href="<?php echo $this->Url->image('questions/'.$historyquestion->img); ?>">
                                                    <?= $this->Html->image('questions/'.$historyquestion->img) ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                    <ul>
                                    <?php 
                                    $is_img = false;
                                    $count_choices = 0;
                                    foreach ($historychoices as $historychoice): ?>
                                        <?php if ($historychoice->historyquestion_id == $historyquestion->id): ?>
                                            <?php if ($historychoice->img == 1){ 
                                                $is_img = true;
                                                $count_choices = $count_choices + 1;
                                            ?>
                                            <li>
                                            Choice <?= $count_choices ?>
                                            <div class="tz-gallery">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-4">
                                                        <a class="lightbox" href="<?php echo $this->Url->image('choices/'.$historychoice->choice); ?>">
                                                            <?= $this->Html->Image('choices/'.$historychoice->choice) ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            </li>
                                            <?php }else{ ?>
                                            <li><?= $historychoice->choice ?></li>
                                            <?php } ?>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                    </ul>
                                    <?php if ($is_img == true){ ?>
                                    Answer:
                                    <div class="tz-gallery">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-4">
                                                <a class="lightbox" href="<?php echo $this->Url->image('choices/'.$historyquestion->answer); ?>">
                                                    <?= $this->Html->Image('choices/'.$historyquestion->answer) ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }else{ ?>
                                        Answer: <?= $historyquestion->answer ?><br>
                                    <?php } ?>
                                <b>Created by: <?= $historyquestion->user->username ?></b>
                                </p>
                            <?php $count = 0; }else{ ?>
                                <hr>
                                <p><h5>Date: <?= $historyquestion->created ?></h5>
                                Question: <?= $historyquestion->question ?><br>
                                <?php if($historyquestion->img != ''){ ?>
                                    <div class="tz-gallery">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-4">
                                                <a class="lightbox" href="<?php echo $this->Url->image('questions/'.$historyquestion->img); ?>">
                                                    <?= $this->Html->image('questions/'.$historyquestion->img) ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <ul>
                                <?php 
                                    $is_img = false;
                                    $count_choices = 0;
                                    foreach ($historychoices as $historychoice): ?>
                                        <?php if ($historychoice->historyquestion_id == $historyquestion->id): ?>
                                            <?php if ($historychoice->img == 1){ 
                                                $is_img = true;
                                                $count_choices = $count_choices + 1;
                                            ?>
                                            <li>
                                            Choice <?= $count_choices ?>
                                            <div class="tz-gallery">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-4">
                                                        <a class="lightbox" href="<?php echo $this->Url->image('choices/'.$historychoice->choice); ?>">
                                                            <?= $this->Html->Image('choices/'.$historychoice->choice) ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            </li>
                                            <?php }else{ ?>
                                            <li><?= $historychoice->choice ?></li>
                                            <?php } ?>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                </ul>
                                <?php if ($is_img == true){ ?>
                                    Answer:
                                    <div class="tz-gallery">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-4">
                                                <a class="lightbox" href="<?php echo $this->Url->image('choices/'.$historyquestion->answer); ?>">
                                                    <?= $this->Html->Image('choices/'.$historyquestion->answer) ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }else{ ?>
                                        Answer: <?= $historyquestion->answer ?><br>
                                    <?php } ?>
                                <b>Edited by: <?= $historyquestion->user->username ?></b>
                                </p>
                            <?php } ?>
                        <?php endif ?>
                    <?php endforeach; ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
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
<?= $this->Html->css('baguetteBox.min.css') ?>
<?= $this->Html->css('fluid-gallery.css') ?>
<?= $this->Html->script('baguetteBox.min.js') ?>
<script>
    baguetteBox.run('.tz-gallery');
</script>