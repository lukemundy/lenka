$(document).ready(function () {
	// Setup the menubar
	$('ul.dropdown li').hover(
		function () { $(this).addClass('hover'); },
		function () { $(this).removeClass('hover'); }
	);

	$('ul.dropdown li.parent').hover(
		function () {
			$(this).children('ul:first').stop(true, true).slideDown(100);
		},
		function () {
			$(this).children('ul:first').stop(true, true).fadeOut(100);
		}
	);
});