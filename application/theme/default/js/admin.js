/**
 * Delete's all ticked articles
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

/**
 * Updates the preview box
 * @return void
 */
function preview()
{
	var txt = $('div#body textarea').val();
	
	if (txt.length > 0)
	{
		// Submit text to be parsed via AJAX 
		$.ajax({
			type: 'POST',
			url: '/content/admin/preview',
			data: { txt: txt },
			success: function (data, status) {
				$('div#preview').children('div:first').empty().append(data);
			}
		});
	}
}

/**
 * Saves an article
 * @return void
 */
function save()
{
	var form = $('#article-form');
	var fields = form.find('input,textarea,select');
	var data = form.serialize();
	
	// Disable fields
	fields.attr('disabled', 'disabled');
	
	$.ajax({
		type: 'POST',
		url: '/content/admin/save',
		data: data,
		success: function (data, status) {
			var r = $.parseJSON(data);
			
			if (r.success) window.location = '/content/admin/';
			else
			{
				var error_msg = '<div class="error"><p><strong>'+ r.response +'</strong></p>'+ r.txt +'</div>';
				
				$('div#messages')
					.empty()
					.append(error_msg);
				
				if ( ! $('div#messages').is(":visible")) $('div#messages').slideDown(250);
				
				fields.removeAttr('disabled');
			}
		}
	});
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
	
	// Add functionailty to "check all" box
	$('input#checkall').change(function () {
		if ($(this).attr('checked')) $('input.checkall').attr('checked', 'checked');
		else $('input.checkall').removeAttr('checked');
	});
	
	// Enable the tab key in textareas
	$('textarea').tabOverride();
	
	// Auto-create stub
	$('input[name=title]').change(function () {
		var stub = $(this).val().toLowerCase();
		
		// Strip unwanted characters
		stub = stub.replace(/[^\w]+$/ig, '').replace(/^[^\w]+/ig, '').replace(/[^\w]+/ig, '-');
		
		$('input[name=stub]').val(stub);
	});
	
	// Click to dismiss message box
	$('div#messages').click(function () { $(this).fadeOut(250); });
});