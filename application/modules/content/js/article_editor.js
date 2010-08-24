/**
 * Discards changes and closes document
 * @return void
 */
function cancel()
{
	if (confirm('Discard all changes to current document?')) window.location = '/admin/content/';
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
			url: '/admin/content/preview',
			data: { txt: txt },
			success: function (data, status) {
				$('div#preview').children('div:first').empty().append(data);
			}
		});
	}
}

/**
 * Saves and closes an article
 * @param bool
 * @return void
 */
function save(keep_editing)
{
	var form = $('#article-form');
	var fields = form.find('input,textarea,select');
	var data = form.serialize();
	
	// Disable fields
	fields.attr('disabled', 'disabled');
	
	$.ajax({
		type: 'POST',
		url: '/admin/content/save',
		data: data,
		success: function (data, status) {
			var r = $.parseJSON(data);
			
			if (r.success)
			{
				if (keep_editing)
				{
					var foo = '<div class="success">Changes to article "'+ data['title'] +'" saved successfully.</div>';
					
					$('div#messages')
						.empty()
						.append(foo);
						
					if ( ! $('div#messages').is(":visible")) $('div#messages').slideDown(250);

					fields.removeAttr('disabled');
				}
				else window.location = '/admin/content/';
			}
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

// Set up other behaviour when ready
$(document).ready(function () {

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
	$('div#messages').click(function () { $(this).slideUp(250); });

});