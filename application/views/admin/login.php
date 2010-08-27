<div id="login-box">
	<h2>Administrator Login</h2>
	
	<script type="text/javascript">
		function submit_form()
		{
			$('form#login').submit();
		}
		
		$(document).ready(function () {
			$('input#username').focus();
		});
	</script>
	
	<form id="login" method="post" action="<?= site_url($this->uri->uri_string()) ?>">
		<div class="field">
			<label for="username">Username:</label>
			<input id="username" name="username" type="text" />
		</div>
		<div class="field">
			<label for="password">Password:</label>
			<input id="password" name="password" type="password" />
		</div>
		
		<div class="button-cont">
			<a class="button" href="#" onclick="javascript: submit_form();"><span class="icon-login">Login</span></a>
			<input type="submit" style="display: none;" />
		</div>
		
		<div class="center">
			<a href="#">I've forgotten my password</a><br />
			<a href="<?= site_url() ?>">Return to <?= $this->config->item('site_name') ?></a>
		</div>
	</form>
</div>