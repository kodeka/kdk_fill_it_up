/**
 * @version    1.0.x
 * @package    Fill It Up
 * @author     JoomlaWorks http://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2016 JoomlaWorks Ltd. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

var generating = false;
window.addEventListener('beforeunload', function(e) {
	if (generating) {
		var confirmationMessage = 'Process has not completed!';
		(e || window.event).returnValue = confirmationMessage;
		return confirmationMessage;
	}
});
jQuery(document).ready(function($) {
	function generate() {
		$.ajax({
			url : ajaxurl + '?action=ajax&task=generate',
			type : 'POST',
			data : $('#fillitup-generate-form').serialize(),
			dataType : 'json'
		}).done(function(response, result, request) {
			var total = $('input[name=total]').val();
			var percentage = parseInt((response.offset / total) * 100);
			var offset = parseInt(response.offset) + 1;
			$('input[name=offset]').val(offset);
			$('input[name=definitions]').val(JSON.stringify(response.definitions));
			$('#fillitup-percentage').text(percentage + '%');
			$('#fillitup-status-bar').animate({
				'width' : (percentage) + '%'
			}, 'slow', 'linear', function() {
				if (parseInt(total) === parseInt(response.offset)) {
					generating = false;
					$('#fillitup-completed-message').show();
				} else {
					generate();
				}
			});
		}).fail(function(request, result, statusText) {
			alert(request.responseText);
		});
	}

	$('#fillitup-start-over-button').click(function(event) {
		event.preventDefault();
		$('#fillitup-progress-container').slideUp();
		$('#fillitup-form-container').slideDown();
		$('#fillitup-status-bar').css('width', '0%');
		$('#fillitup-percentage').text('0%');
		$('#fillitup-completed-message').hide();
	});

	$('#fillitup-generate-form').on('submit', function(event) {
		event.preventDefault();
		var total = parseInt($('input[name=total]').val());
		if (total < 1) {
			alert('Invalid number of entries');
			return false;
		}
		generating = true;
		$('input[name=offset]').val(1);
		$('#fillitup-form-container').slideUp();
		$('#fillitup-progress-container').slideDown();
		$.ajax({
			type : 'GET',
			url : ajaxurl + '?action=ajax&task=definitions',
			dataType : 'json'
		}).done(function(response, result, request) {
			$('#fillitup-generate-form').find('input[name="definitions"]').val(JSON.stringify(response));
			generate();
		}).fail(function(request, result, statusText) {
			alert(request.responseText);
		});

	});
});
