<div class="container" id="content">
<div class="row">
	<div class="col"></div>
	<div class="col-md-10">
	<div class="row-fluid sort">
	<form class="form-inline" method="get" action="/main/index/">
		<label class="mr-sm-2" for="inlineFormCustomSelect">Sort by</label>
		<select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect" name="ob">
			<option value="username" <?php if(!isset($ob) || $ob == "username") {echo "selected";}?>>username</option>
			<option value="e-mail" <?php if($ob == "e-mail") {echo "selected";}?>>e-mail</option>
			<option value="status" <?php if ($ob == "status") {echo "selected";} ?>>status</option>
		</select>
		<input type="text" name="page" value="<?=$page?>" hidden>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
	</div>
		<?php
		foreach ($tasks as $task)
		{
		?>
			<div class="card bot-margin <?php if($task['status']) {echo "border-secondary";}?>">
				<div class="card-header">
					<?=$task['username']?> &lt;<?=$task['e-mail']?>&gt;
<?php if(isset($_SESSION['user'])) { ?>
<?php if($_SESSION['user'] == 'admin' && $task['status'] == 0) {?>
	<br>
	<button type="button" class="btn btn-primary complete-btn" value="<?=$task['tid']?>">Set completed</button>
<?php }?>
<?php if($_SESSION['user'] == 'admin' && $task['status'] == 1) {?>
	<br>
	<button type="button" class="btn btn-primary not-complete-btn" value="<?=$task['tid']?>">Set not completed</button>
<?php }?>
<?php if($_SESSION['user'] == 'admin') {?>
	<button type="button" class="btn btn-success edit-btn" value="<?=$task['tid']?>">Edit text</button>
<?php }?>
<?php }?>
				</div>
				<div class="card-body media <?php if($task['status']) {echo "text-secondary";}?>">
					<div class="row justify-content-md-center">
<?php
	if ($task['image'] != 'none')
	{
					echo '<img class="d-flex align-self-center img-center" src="/images/'.$task['image'].'" alt="">';
	}
?>
						<div class="media-body">
							<p class="text-wrap"><?=$task['text']?></p>
						</div>
					</div>
				</div>
<?php if($task['status']) { ?>
				<div class="card-footer text-muted">
						Completed
				</div>
<?php } ?>
			</div>
		<?php
		}
		 ?>
	</div>
	<div class="col"></div>
</div>
</div>
<nav class="pages">
	<ul class="pagination justify-content-center">
		<li class="page-item <?php if (($page - 2) * 3 < 0) {echo "disabled";}?>">
			<a class="page-link" href="/main/index/?page=<?=$page-2?>&ob=<?=$ob?>" tabindex="-1">Previous</a>
		</li>
		<?php if ($page - 1 >= 0) { ?>
		<li class="page-item">
			<a class="page-link" href="/main/index/?page=<?=$page-1?>&ob=<?=$ob?>"><?=$page-1?></a>
		</li>
		<?php } ?>
		<li class="page-item disabled">
			<a class="page-link" href="/main/index/?page=<?=$page?>&ob=<?=$ob?>"><?=$page?></a>
		</li>
		<?php
		if (($page + 1) * 3 < $count) { ?>
		<li class="page-item">
			<a class="page-link" href="/main/index/?page=<?=$page+1?>&ob=<?=$ob?>"><?=$page+1?></a>
		</li>
		<?php } ?>
		<li class="page-item <?php if (($page + 2) * 3 >= $count) {echo "disabled";}?>">
			<a class="page-link" href="/main/index/?page=<?=$page+2?>&ob=<?=$ob?>">Next</a>
		</li>
	</ul>
</nav>
<script src="/js/main.js"></script>
