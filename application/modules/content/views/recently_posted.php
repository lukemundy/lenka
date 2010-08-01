<h2>Recently Added:</h2>

<div class="content_list">
	<? foreach ($articles as $a): ?>
	<div class="article_container">
		<h2><?= $a['title'] ?></h2>
		<div class="article_details">
			<?= $a['date'] ?>
		</div>
		<div class="article_body">
			<?= nl2br($a['body']) ?>
		</div>
	</div>
	<? endforeach; ?>
</div>