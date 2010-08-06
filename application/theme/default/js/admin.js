function delete_articles()
{
	// Get all checked boxes
	var boxes = $('input:checked');
	var num = boxes.length;
	
	if (num < 1) alert("You must select some articles to delete.");
	else
	{		
		if (confirm("Are you sure you want to delete this article? This action is irreversible."))
		{
			// Array to hold each article id
			var data = new Array(num);
			
			for (var x = 0; x < num; x++) data[x] = boxes.get(x).value;
			
			// Submit data via AJAX
			$.ajax({
				type: 'POST',
				url: '/content/admin/delete',
				data: { articles: data },
				success: function (data, status) {
					if (data == 'failure') alert("Could not delete articles");
					else window.location = '/content/admin'
				}
			});
		}
	}
}

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
			$(this).children('ul:first').stop(true, true).hide();
		}
	);
	
	$('input#checkall').change(function () {
		if ($(this).attr('checked')) $('input.checkall').attr('checked', 'checked');
		else $('input.checkall').removeAttr('checked');
	});
});