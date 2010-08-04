<h2>Article Manager</h2>

<div class="article-manager">
	<table>
		<thead>
			<tr>
				<th width="70%">Title</th>
				<th>Created</th>
				<th width="10%">Actions</th>
			</tr>
		</thead>
		<tbody>
			<? foreach ($articles as $k => $a): ?>
			<?= ($k % 2 > 0 ? '<tr class="even">' : '<tr>') ?>
				<td><a href="edit"><?= (strlen($a['title']) > 40 ? substr($a['title'], 0, 50).'&hellip;' : $a['title']) ?></a></td>
				<td><?= $a['date'] ?></td>
				<td>
					<img src="<?= $theme_url ?>img/icons/page_edit.png" width="16" height="16" alt="Edit page icon" />
					<img src="<?= $theme_url ?>img/icons/page_delete.png" width="16" height="16" alt="Delete page icon" />
					<? if ($a['state'] === 'published'): ?><img src="<?= $theme_url ?>img/icons/page_red.png" width="16" height="16" alt="Unpublish page icon" />
					<? else: ?><img src="<?= $theme_url ?>img/icons/page.png" width="16" height="16" alt="Publish page icon" /><? endif; ?>
				</td>
			</tr>
			<? endforeach; ?>
		</tbody>
	</table>
</div>