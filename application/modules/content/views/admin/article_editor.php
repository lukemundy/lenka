<h2>Article Editor</h2>

<div id="actions">
	<a href="#" onclick="javascript: preview();"><span class="icon-preview">Preview</span></a>
	<a href="#"><span class="icon-save">Save</span></a>
	<a href="#"><span class="icon-apply">Apply</span></a>
	<a href="#"><span class="icon-cancel">Cancel</span></a>
</div>

<div id="editor-container">
	
	<div id="editor">
	<div style="padding: 0.5em;">
		<div id="properties">
				<div class="field">
					<label>Title:</label>
					<input type="text" name="title" />
				</div>
				<div class="field">
					<label>Stub:</label>
					<input type="text" name="stub" />
				</div>
				<div class="field">
					<label>State:</label>
					<select name="state">
						<option selected="selected">--</option>
						<option value="0">Draft</option>
						<option value="1">Published</option>
						<option value="2">Encrypted</option>
					</select>
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
				<textarea name="body"></textarea>
			</div>
		</div>
	</div>
	
	<div id="preview">
		<div style="padding: 0.5em;">
		 
		</div>
	</div>
	
	<div class="clearfix"></div>
</div>