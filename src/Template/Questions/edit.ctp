<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $question->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $question->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="questions form large-9 medium-8 columns content">
    <?= $this->Form->create($question,['enctype'=>'multipart/form-data']) ?>
    <fieldset>
        <legend><?= __('Edit Question') ?></legend>
        <?php
            echo $this->Form->control('subject_id', ['options' => $subjects]);
            echo $this->Form->control('question');
            echo $this->Form->control('img', ['type'=>'file', 'name'=>'img', 'label'=>'Add Some Photos', 'class'=>'form-control']);
        ?>
        <h4>Choices</h4>
        <div class="tz-gallery">
            <div class="row">
        <?php
            $count = 0;
            foreach ($choices as $choice) {
                $count = $count + 1;
                if ($choice->img == 1) {
            ?>
                    <label>Choice <?= $count ?> (Click Choose File below the image to change)</label>
                    <div class="col-sm-12 col-md-4">
                        <a class="lightbox" href="<?php echo $this->Url->image('choices/'.$choice->choice); ?>">
                            <?= $this->Html->Image('choices/'.$choice->choice) ?>
                        </a>
                    </div>
                    <input type="hidden" name="old_choice[]" value="<?= $choice->choice ?>">
                    <input type="file" name="choices_img[]" class="form-control">
                <?php 
                }else{
                    ?>
                    <input type="text" name="choices[]" class="form-control" value="<?= $choice->choice ?>" required>
                    <?php
                }
            }
            ?>
            </div>
        </div>
            <select name="answer" id="answer" required>
                <option value="">Select the answer</option>
        <?php for ($i=1; $i <= $count; $i++) { ?>
                <option value="<?= $i ?>">Choice <?= $i ?></option>
        <?php } ?>
            </select>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<?= $this->Html->css('baguetteBox.min.css') ?>
<?= $this->Html->css('fluid-gallery.css') ?>
<?= $this->Html->script('baguetteBox.min.js') ?>
<script>
    baguetteBox.run('.tz-gallery');
</script>