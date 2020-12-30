<?php foreach ($subjects as $value) { ?>
<div class="modal fade" id="Modal<?= $value->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Are you ready to take "<?= $value->subject ?>"?</h4>
        <p>Time limit (<?= $value->timelimit ?> mins)</p>
      </div>
     <!--  <div class="modal-body">
        ...
      </div> -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="runTest('<?= $value->id ?>','Modal<?= $value->id ?>','<?= $value->timelimit ?>')">Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>