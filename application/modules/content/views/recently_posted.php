<h2>Recently Added:</h2>

<div class="content_list">
	<? foreach ($articles as $a): ?>
	<div class="article">
		<h2 class="title"><?= $a['title'] ?></h2>
		<div class="details">
			Posted <?= date('d M Y \a\t H:i:s', $a['date']) ?>
		</div>
		<div class="body">
			<?= parse_markdown($a['body']) ?>
		</div>
	</div>
	<? endforeach; ?>
</div>