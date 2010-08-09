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
				<th>Last Modified</th>
			</tr>
		</thead>
		<tbody>
			<? if ( ! $articles): ?>
				<tr>
					<td colspan="5" style="text-align: center;">There are currently no articles in the database. Write one now by clicking on the 'New' button above.</td>
				</tr>
			<? else: ?>
				<? foreach ($articles as $k => $a): ?>
				<?= ($k % 2 > 0 ? '<tr class="even">' : '<tr>') ?>
					<td><input type="checkbox" value="<?= (int) $a['ID_CNT'] ?>" class="checkall" tabindex="<?= $tabindex++ ?>" /></td>
					<td class="quiet"><?= (int) $a['ID_CNT'] ?></td>
					<td><a href="/content/admin/edit/<?= (int) $a['ID_CNT'] ?>"><?= (strlen($a['title']) > 40 ? substr($a['title'], 0, 50).'&hellip;' : $a['title']) ?></a></td>
					<td><?= date('d M Y \a\t H:i', $a['date']) ?></td>
					<td><?= ($a['modified'] == NULL ? '<span class="quiet">never</span>' : date('d M Y \a\t H:i', $a['modified'])) ?></td>
				</tr>
				<? endforeach; ?>			
			<? endif; ?>
		</tbody>
	</table>
</div>