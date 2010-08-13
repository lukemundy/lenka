<? $this->load->helper('form'); ?>
<h2>Article Editor</h2>

<div id="actions">
	<a href="#" onclick="javascript: preview();"><span class="icon-preview">Preview</span></a>
	<a href="#" onclick="javascript: save(false);"><span class="icon-save">Save</span></a>
	<a href="#" onclick="javascript: save(true);"><span class="icon-apply">Apply</span></a>
	<a href="#" onclick="javascript: cancel();"><span class="icon-cancel">Cancel</span></a>
</div>

<div id="editor-container">
	<div id="messages"></div>
	
	<div id="editor">
	<div style="padding: 0.5em;">
		<form id="article-form" action="/content/admin/save" method="POST">
		<?= (empty($article) ? '' : form_hidden('ID_CNT', $article['ID_CNT'])) ?> 
		<div id="properties">
				<div class="field">
					<label>Title:</label>
					<input type="text" name="title" value="<?= (empty($article) ? '' : form_prep($article['title'])) ?>" />
				</div>
				<div class="field">
					<label>Stub:</label>
					<input type="text" name="stub" value="<?= (empty($article) ? '' : form_prep($article['stub'])) ?>" />
				</div>
				<div class="field">
					<label>State:</label>
					<?
						$dropdown = array(
							'-1' => '--',
							'1' => 'Draft',
							'2' => 'Published',
							'3' => 'Encrypted',
						);
						
						if (! empty($article))
						{
							switch ($article['state'])
							{
								case 'draft': $selected = 1;
								break;
								
								case 'published': $selected = 2;
								break;
								
								case 'encrypted': $selected = 3;
								break;
								
								default: $selected = -1;
							}
						}
						else $selected = -1;
						
						echo form_dropdown('state', $dropdown, $selected);
					?>
				</div>
			</div>
			
			<div id="tools">
				<div class="tool-row">
					<div class="tool"><a href="javascript: void(0);" class="icon-bold"></a></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-italic"></a></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-underline"></a></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-strikethru"></a></div>
					<div class="seperator"></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-alignjustify"></a></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-alignleft"></a></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-aligncenter"></a></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-alignright"></a></div>
					<div class="seperator"></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-h1"></a></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-h2"></a></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-h3"></a></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-h4"></a></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-h5"></a></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-h6"></a></div>
				</div>
				<div class="tool-row">
					<div class="tool"><a href="javascript: void(0);" class="icon-hr"></a></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-indent"></a></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-indentrm"></a></div>
					<div class="seperator"></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-ul"></a></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-ol"></a></div>
					<div class="seperator"></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-sup"></a></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-sub"></a></div>
					<div class="seperator"></div>
					<div class="tool"><a href="javascript: void(0);" class="icon-inssymbol"></a></div>
				</div>
				
				<div class="clearfix"></div>
			</div>
			
			<div id="body">
				<textarea name="body"><?= (empty($article) ? '' : form_prep($article['body'])) ?></textarea>
			</div>
			</form>
		</div>
	</div>
	
	<div id="preview">
		<div style="padding: 0.5em;">
		 
		</div>
	</div>
	
	<div class="clearfix"></div>
</div>