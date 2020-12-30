<style type="text/css">
	
	#un {
		border: 3px solid gray;
		width: 350px;
		height: 380px;
		float: left;
		margin-left: 30px;
		overflow-y: scroll;
	}

	#main {
		border: 3px solid gray;
		width: 700px;
		height: 380px;
		float: right;
		margin-right: 25px;
		overflow-y: scroll;
	}

	#su {
	width: 200px;
	height: 70px;
	background: #236bde;
	border-radius: 10px;
	}

	#us {
	color: white;
	font-size:1.5em;
	}
	label{
	   	display: block;
	}

</style>
<?= $this->Html->css('baguetteBox.min.css') ?>
<?= $this->Html->css('fluid-gallery.css') ?>
<?= $this->Html->script('baguetteBox.min.js') ?>
<script>
    baguetteBox.run('.tz-gallery');
</script>
<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
	<?php 
	$i = 1;
	$subject = "";
	$question_id = "";
	$count_choices = "";
	$count_results = 0;
	foreach ($questions as $value){ $count_results = $count_results + 1; }
	foreach ($questions as $value):
	$subject = $value->subject->id;
	$question_id .= $value->id . " ";
	if ($i == 1) { ?>
	<CENTER> <h1> <?= $value->subject->subject ?> </h1> </CENTER>
	<div id="page-<?= $i ?>" style="display: block;">
		<div class="form-group <?= str_replace(' ', '', $value->subject->subject)."-".$i ?>">
			<?= $i.'. '.$value->question ?><br>
			<?php if($value->img != ''){ ?>
			<div class="tz-gallery">
        		<div class="row">
					<div class="col-sm-12 col-md-4">
			            <a class="lightbox" href="<?php echo $this->Url->image('questions/'.$value->img); ?>">
			                <?= $this->Html->image('questions/'.$value->img) ?>
			            </a>
	        		</div>
	        	</div>
	        </div>
			<?php } ?>
		</div>
		<div class="form-group">
			<?php 
				$count = 0;
				foreach ($choices as $choice) {
						if ($choice->question_id == $value->id) {
							$count = $count + 1;
							$name = str_replace(' ', '', $value->subject->subject)."-".$i;
							$label = str_replace(' ', '', $value->subject->subject)."-";
					?>
					<label for="<?= $label.$count ?>">
						<input type="radio" name="<?= $name ?>" value="<?= $choice->choice ?>">
						<?php if ($choice->img == 1){ ?>
		                <div class="tz-gallery">
                            <div class="row">
			                    <div class="col-sm-12 col-md-4">
			                        <a class="lightbox" href="<?php echo $this->Url->image('choices/'.$choice->choice); ?>">
			                            <?= $this->Html->Image('choices/'.$choice->choice) ?>
			                        </a>
			                    </div>
			                </div>
		                </div>
		                <?php }else{ ?>
		                <?= $choice->choice ?>
		                <?php } ?>
					</label>
				<?php
						}
					}
				$count_choices .= $count.' ';
			?>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-lg-12">
					<div class="text-center">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-6">
								</div>
								<div class="col-xs-6">
									<?php if ($count_results != 1): ?>
										<a href="#" style="font-size:2em;" class="glyphicon glyphicon-forward" onclick="next('<?= ($i+1) ?>', '<?= $i ?>')"></a>
									<?php endif ?>
								</div>
							</div>
							<hr>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }else{ ?>
	<div id="page-<?= $i ?>" style="display: none;">
		<div class="form-group <?= str_replace(' ', '', $value->subject->subject)."-".$i ?>">
			<?= $i.'. '.$value->question ?><br>
			<?php if($value->img != ''){ ?>
			<div class="tz-gallery">
        		<div class="row">
					<div class="col-sm-12 col-md-4">
			            <a class="lightbox" href="<?php echo $this->Url->image('questions/'.$value->img); ?>">
			                <?= $this->Html->image('questions/'.$value->img) ?>
			            </a>
	        		</div>
	        	</div>
	        </div>
			<?php } ?>
		</div>
		<div class="form-group">
			<?php 
				$count = 0;
				foreach ($choices as $choice) {
						if ($choice->question_id == $value->id) {
							$count = $count + 1;
							$name = str_replace(' ', '', $value->subject->subject)."-".$i;
							$label = str_replace(' ', '', $value->subject->subject)."-";
					?>
					<label for="<?= $label.$count ?>">
						<input type="radio" name="<?= $name ?>" value="<?= $choice->choice ?>">
						<?php if ($choice->img == 1){ ?>
		                <div class="tz-gallery">
                            <div class="row">
			                    <div class="col-sm-12 col-md-4">
			                        <a class="lightbox" href="<?php echo $this->Url->image('choices/'.$choice->choice); ?>">
			                            <?= $this->Html->Image('choices/'.$choice->choice) ?>
			                        </a>
			                    </div>
			                </div>
		                </div>
		                <?php }else{ ?>
		                <?= $choice->choice ?>
		                <?php } ?>
					</label>
				<?php
						}
					}
				$count_choices .= $count.' ';
			?>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-lg-12">
					<div class="text-center">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-6">
								</div>
								<div class="col-xs-6">
									<a href="#" style="font-size:2em;" class="glyphicon glyphicon-backward" onclick="prev('<?= ($i-1) ?>', '<?= $i ?>')"></a>
									<?php if ($count_results != $i){ ?>
										<a href="#" style="font-size:2em;" class="glyphicon glyphicon-forward" onclick="next('<?= ($i+1) ?>', '<?= $i ?>')"></a>
									<?php } ?>
								</div>
							</div>
							<hr>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<?php $i++; endforeach ?>
	<a href="#" style="font-size:2em;" class="glyphicon glyphicon-ok-sign fa-lg pull-right" data-toggle="modal" data-target="#confirmModal" onclick="findUnchecked('<?= (isset($value->subject->subject)) ? str_replace(' ', '', $value->subject->subject) : '' ?>')"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<input type="hidden" class="count_choices" value="<?= $count_choices ?>">
<input type="hidden" class="subject_id" value="<?= $subject ?>">
<input type="hidden" class="question_id" value="<?= $question_id ?>">
<script>
function next(fadein, fadeout){
	$("#page-"+fadein).delay(100).fadeIn(100);
	$("#page-"+fadeout).fadeOut(100);
	$("#unpageno").val(fadein);
	e.preventDefault();
}
function prev(fadein, fadeout){
	$("#page-"+fadein).delay(100).fadeIn(100);
	$("#page-"+fadeout).fadeOut(100);
	$("#unpageno").val(fadein);
	e.preventDefault();
}
function unansweredModal(fadein, fadeout){
	$("#page-1").fadeOut(100);
	$("#page-"+$("#unpageno").val()).fadeOut(100);
	$("#page-"+fadein).delay(100).fadeIn(100);
	$("#unpageno").val(fadein);
	e.preventDefault();
}
</script>