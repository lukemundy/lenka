<? $tabindex = 1; ?>
<h2>Article Manager</h2>

<div id="actions">
	<a href="/content/admin/create"><span class="icon-newpage">New</span></a>
	<a href="#" onclick="javascript: edit_article();"><span class="icon-editpage">Edit</span></a>
	<a href="#" onclick="javascript: delete_articles();"><span class="icon-deletepage">Delete</span></a>
	<a href="#"><span class="icon-publishpage">Publish</span></a>
	<a href="#"><span class="icon-unpublishpage">Unpublish</span></a>
</div>

<div class="article-manager">
	<table>
		<thead>
			<tr>
				<th width="1"><input id="checkall" type="checkbox" tabindex="<?= $tabindex++ ?>" /></th>
				<th width="1">ID#</th>
				<th width="70%">Title</th>
				<th>Created</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<? foreach ($articles as $k => $a): ?>
			<?= ($k % 2 > 0 ? '<tr class="even">' : '<tr>') ?>
				<td><input type="checkbox" value="<?= (int) $a['ID_CNT'] ?>" class="checkall" tabindex="<?= $tabindex++ ?>" /></td>
				<td class="quiet"><?= (int) $a['ID_CNT'] ?></td>
				<td><a href="/content/admin/edit/<?= (int) $a['ID_CNT'] ?>"><?= (strlen($a['title']) > 40 ? substr($a['title'], 0, 50).'&hellip;' : $a['title']) ?></a></td>
				<td><?= date('d M Y \a\t H:i', $a['date']) ?></td>
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