<?php
$is_img = false;
foreach ($choices as $choice) {
    if ($choice->img == 1) {
        $is_img = true;  
    }
}
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Question'), ['action' => 'edit', $question->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Question'), ['action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="questions view large-9 medium-8 columns content">
    <h3><?= h($question->id) ?></h3>
<div class="tz-gallery">
    <div class="row">
    <table class="table table-striped">
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= $question->has('subject') ? $this->Html->link($question->subject->subject, ['controller' => 'Subjects', 'action' => 'view', $question->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Answer') ?></th>
            <?php if ($is_img == true){ ?>
                <td>
                    <div class="col-sm-12 col-md-4">
                        <a class="lightbox" href="<?php echo $this->Url->image('choices/'.$question->answer); ?>">
                            <?= $this->Html->Image('choices/'.$question->answer) ?>
                        </a>
                    </div>
                </td>
            <?php }else{ ?>
                <td><?= h($question->answer) ?></td>
            <?php } ?>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($question->id) ?></td>
        </tr>
        <?php
            $count = 0;
            foreach ($choices as $choice) {
                $count = $count + 1;
                ?>
            <tr>
                <th scope="row"><?= __('Choice '.$count) ?></th>
                <?php if ($choice->img == 1){ ?>
                <td>
                    <div class="col-sm-12 col-md-4">
                        <a class="lightbox" href="<?php echo $this->Url->image('choices/'.$choice->choice); ?>">
                            <?= $this->Html->Image('choices/'.$choice->choice) ?>
                        </a>
                    </div>
                </td>
                <?php }else{ ?>
                <td><?= h($choice->choice) ?></td>
                <?php } ?>
            </tr>
        <?php } ?>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($question->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($question->modified) ?></td>
        </tr>
    </table>
</div>
</div>
    <div class="row">
        <h4><?= __('Question') ?></h4>
        <?= $this->Text->autoParagraph(h($question->question)); ?>
        <?php if($question->img != ''){ ?>
        <h4><?= __('Image') ?></h4>
            <div class="tz-gallery">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <a class="lightbox" href="<?php echo $this->Url->image('questions/'.$question->img); ?>">
                            <?= $this->Html->image('questions/'.$question->img) ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?= $this->Html->css('baguetteBox.min.css') ?>
<?= $this->Html->css('fluid-gallery.css') ?>
<?= $this->Html->script('baguetteBox.min.js') ?>
<script>
    baguetteBox.run('.tz-gallery');
</script>