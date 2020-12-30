<script>
function schoolLists(id){
  $.ajax({
        url: '<?= $this->Url->build(['controller'=>'Tests', 'action'=>'school-lists']) ?>/' + id, 
        success: function(result){
            $("#school-lists").html(result);
            $("#course-lists").html('');
        }
    });
}
function courseLists(id){
  $.ajax({
        url: '<?= $this->Url->build(['controller'=>'Tests', 'action'=>'course-lists']) ?>/' + id, 
        success: function(result){
            $("#course-lists").html(result);
        }
    });
}
</script>
<style>
  .div-center{
    width: 100%;
    height: 100px;
    text-align: center;
    position: absolute;
    top:0;
    bottom: 0;
    left: 0;
    right: 0;

    margin: auto;
  }
  .div-center2{
    width: 100%;
    height: 100px;
    text-align: center;
    position: absolute;
    top:0;
    bottom: 100px;
    left: 0;
    right: 0;

    margin: auto;
  }
</style>
<form action="./realtest-result" id="formSubmit" method="post" accept-charset="utf-8">
<div class="hideInfo">
<select class="form-control" onchange="schoolLists(this.value)">
<option value="">Location</option>
<?php
  foreach ($locations as $location) {
      echo '<option value="'.$location->id.'">'.$location->city.', Pampanga</option>';
  }
?>
</select>
  <div id="school-lists"></div>
  <div id="course-lists"></div>
<center>
  <br><input class="btn btn-primary" type="submit" value="View Results">
</center>
</div>
<div id="allButtons" class="div-center2">
<select class="form-control subjectButtons" onchange="funMyModel(this.value)">
    <option value="None">Please choose a subject</option>
    <?php
    foreach ($subjects as $value) {
        echo '<option class="subjectButtons" id="'.$value->id.'" value="#Modal'.$value->id.'">'.$value->subject.'</option>';
    }
    ?>
</select>
<?= $this->Form->hidden('baguettecss', ['value'=>$this->Url->css("baguetteBox.min.css"), 'id'=>'baguettecss']) ?>
<?= $this->Form->hidden('gallerycss', ['value'=>$this->Url->css("fluid-gallery.css"), 'id'=>'gallerycss']) ?>
<?= $this->Form->hidden('baguettejs', ['value'=>$this->Url->script("baguetteBox.min.js"), 'id'=>'baguettejs']) ?>
<!-- Remove previous test -->
<?= $this->Form->hidden('unpageno', ['id'=>'unpageno','value'=>0]) ?>
</div>
    <div id="timerBody" class="div-center"><h1></h1><h1><span id="time"></h1></span></div>
    <div class="result"></div>
    <div id="questions"></div>
    <div id="user_answers"></div>
    <div id="user_answer_number"></div>
</form>
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Are you sure?</h4>
      </div>
      <div class="modal-body">
        <div class="unanswer"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="viewRadio()">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<script>
function funMyModel(val)
{
if (val != "None") {
    $(val).modal({
        show: true
    });
}
}
</script>
<?= $this->element('Test/subject_confirmation') ?>
<?= $this->Html->script("realSolving") ?>