<div class="container" id="content">
<div class="row">
	<div class="col"></div>
	<div class="col-md-8">
		<?php
		foreach ($tasks as $task)
		{
		?>
			<div class="card <?php if($task['status']) {echo "border-secondary";}?>">
				<div class="card-header">
					<?=$task['username']?> &lt;<?=$task['e-mail']?>&gt;
				</div>
				<div class="card-body <?php if($task['status']) {echo "text-secondary";}?>">
					<div class="row justify-content-md-center">
						<div class="col-lg-6">
					<?php
					echo '<img class="card-img-left" src="/images/'.$task['image'].'" alt="">';
					?>
						</div>
						<div class="col-lg-6">
							<p class="text-wrap"><?=$task['text']?></p>
						</div>
					</div>
				</div>
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
		<li class="page-item <?php if ($page - 3 < 0) {echo "disabled";}?>">
			<a class="page-link" href="/main/index/?page=<?=$page-3?>" tabindex="-1">Previous</a>
		</li>
		<?php if ($page - 1 >= 0) { ?>
		<li class="page-item">
			<a class="page-link" href="/main/index/?page=<?=$page-1?>"><?=$page-1?></a>
		</li>
		<?php } ?>
		<li class="page-item disabled">
			<a class="page-link" href="/main/index/?page=<?=$page?>"><?=$page?></a>
		</li>
		<?php
		if (($page + 1) * 3 < $count) { ?>
		<li class="page-item">
			<a class="page-link" href="/main/index/?page=<?=$page+1?>"><?=$page+1?></a>
		</li>
		<?php } ?>
		<li class="page-item <?php if (($page + 3) * 3 >= $count) {echo "disabled";}?>">
			<a class="page-link" href="/main/index/?page=<?=$page+3?>">Next</a>
		</li>
	</ul>
</nav>
<script src="/js/main.js"></script>
