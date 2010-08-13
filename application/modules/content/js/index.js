/**
 * Edit the selected article
 * @return void
 */
function edit_article()
{
	// Get all checked boxes
	var boxes = $('input:checked');
	var num = boxes.length;
	
	if (num > 1) alert("You can only edit one article at a time.");
	else if (num < 1) alert("Please select an article to edit.");
	else window.location = '/content/admin/edit/' + boxes.val();
}

/**
 * Deletes all ticked articles
 * @return void
 */
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
					else window.location = '/content/admin';
				}
			});
		}
	}
}

// Set up other behaviour when ready
$(document).ready(function () {

	// Add functionailty to "check all" box
	$('input#checkall').change(function () {
		if ($(this).attr('checked')) $('input.checkall').attr('checked', 'checked');
		else $('input.checkall').removeAttr('checked');
	});
	
	// Clicking article row will tick it's respective checkbox
	$('div.article-manager tr').each(function () {
		$(this).children('td:not(:first)').click(function () {
			var chkbox = $(this).parent('tr').find('input[type=checkbox]');
			
			if (chkbox.attr('checked')) chkbox.removeAttr('checked');
			else chkbox.attr('checked', 'checked');
		});
	});
	
	// Highlight row
	$('table tbody tr').hover(
		function ()
		{
			$(this).addClass('highlight');
		},
		function ()
		{
			$(this).removeClass('highlight');
		}
	);

});