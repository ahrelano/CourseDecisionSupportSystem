<script>
$(function(){
    $(".btnChoices").click(function(){
        var regex = /^\d+(\.\d{0,0})?$/g;
        var number = $("#choicesnumber").val();
        if (number == '' || number == 0 || !regex.test(parseFloat(number))) {
            alert("Invalid number of choices");
        }else{
            if ($('#changetoImg').prop('checked')) {
                $(".choices").html('');
                $(".choices").append('Choices');
                for (var i = 1; i <= number; i++) {
                    $(".choices").append('<label>Choice '+i+'</label>');
                    $(".choices").append('<input type="file" name="choices_img[]" class="form-control" required>');
                }
            }else{
                $(".choices").html('');
                $(".choices").append('Choices');
                for (var i = 1; i <= number; i++) {
                    $(".choices").append('<input type="text" name="choices[]" class="form-control" placeholder="Choice '+i+'" required>');
                }
            }
            $(".choices").append(
                '<select name="answer" id="answer" required>'+
                '<option value="">Select the answer</option>'+
                '</select>'
                );
                for (var i = 1; i <= number; i++) {
                    $("#answer").append('<option value="'+i+'">Choice '+i+'</option>');
                }
        }
    });
    $(".btnSubmit").click(function(){
        if ($('#choicesnumber').length) {
            alert('Please generate number of choices');
            return false;
        }
    });
});
</script>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="questions form large-9 medium-8 columns content">
    <?= $this->Form->create($question,['enctype'=>'multipart/form-data']) ?>
    <fieldset>
        <legend><?= __('Add Question') ?></legend>
        <?php
            echo $this->Form->control('subject_id', ['options' => $subjects]);
            echo $this->Form->control('question');
            echo $this->Form->control('img', ['type'=>'file', 'name'=>'img', 'label'=>'Add Some Photos', 'class'=>'form-control']);
        ?>
        <div class="choices">
            <input type="number" id="choicesnumber" placeholder="Enter how many choices" class="form-control" required>
            <input type="checkbox" id="changetoImg" value="Yes"><label>Click if choices are image</label>
            <button type="button" class="btn btn-primary btnChoices" required>Generate</button>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btnSubmit']) ?>
    <?= $this->Form->end() ?>
</div>
