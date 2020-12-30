<select class="form-control" onchange="courseLists(this.value)">
<option value="">School Lists</option>}
option
<?php
  foreach ($schools as $school) {
      echo '<option value="'.$school->id.'">'.$school->school.'</option>';
  }
?>
</select>