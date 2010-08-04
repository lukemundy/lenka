<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?= $page_title ?></title>
	
	<?= link_tag($theme_url . 'css/default.css') ?>
</head>
<body>
	<h1 class="site-name"><?= $this->config->item('site_name') ?></h1>
	<p class="site-tagline"><?= $this->config->item('site_tagline') ?>
	
	<div id="container">
		<?= $page_body ?>
	</div>
</body>
</html>