var contact_text; // Save inside edit click function
// Ajax paths
var ADD_CONTACT_FILE       = 'ajax/add_contact.php';
var UPDATE_LIST_FILE       = 'ajax/update_list.php';
var UPDATE_COLOR_FILE      = 'ajax/update_color.php';
var DELETE_CONTACT_FILE    = 'ajax/delete_contact.php';
var LOAD_SETTINGS_FILE     = 'ajax/load_settings.php';
var SEARCH_FILE            = 'ajax/search.php';
var UPDATE_DATE_FILE       = 'ajax/update_date.php';


$(document).ready(function() {

	search_start('');
	
	// Search contacts
	$('#search_box').keyup(function(e) {
		var search_term = $(this).attr('value');
		search_start(search_term);
	});
	
	// From jQuery API
	$("#sortable").sortable();
  $("#sortable").disableSelection();
	
	// Triggered when the user stopped sorting and the DOM position has changed
	$('#sortable').sortable().bind('sortupdate', function() {
		update_list();
	});
	
	// Add new POST
	$('.answers_box_addnew').keypress(function(e) {
		if (e.keyCode == 13) {
			add_new_contact();
		}
	});
	
	// Click function
	$(this).click(function(e) {
		// if click outside the <input> and if <input> exists
		if ($(e.target).parent().attr('class') != 'contact_name' & $('#contact_input').length) {
			close_settings();
		}
	});
	
	// Key press functions
	$(this).keydown(function(e) {
		// Contact name
		if ($(e.target).parent().attr('class') == 'contact_name') {
			if (e.keyCode == 13) {
				close_settings();
			} else if (e.keyCode == 27) {
				// Return old value
				$(e.target).parent().html(contact_text);
			}
		}
		// Red mark
		if ($(e.target).attr('id') == 'red_set') {
			// Allow: backspace, delete, tab, escape, and enter
			if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
				 // Allow: Ctrl+A
				(event.keyCode == 65 && event.ctrlKey === true) || 
				 // Allow: home, end, left, right
				(event.keyCode >= 35 && event.keyCode <= 39)) {
					 // let it happen, don't do anything
					 return;
			} else {
				// Ensure that it is a number and stop the keypress
				if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
					event.preventDefault(); 
				}
			}
		}
	});

	// Button actions
	$('#add_new_button').click(function() {
		add_new_contact();
	});

	// Sort by name
	$('.contacts_title_name').click(function() {
		sort_by_name();
	});
	// Sort by last contact
	$('.contacts_title_last_contact').click(function() {
		sort_by_last_contact();
	});
	
});

function search_start(search_term) {	
	// Enable and disable (if you use search) the jQuery sortable UI
	if (search_term != '') {
		$('#sortable').sortable({ disabled: true });
	} else {
		$('#sortable').sortable({ disabled: false });
	}
	// Display contacts
	$.post(SEARCH_FILE, {search_term:search_term, order:'position'}, function(data) {
		data_obj = JSON.parse(data);
		// Get full html code by concatenating JSON parsing
		var full_html_code = ''
		data_obj.forEach(function(e) {
			full_html_code += e.html_code;
		});
		// Draw full html
		draw_contacts(full_html_code);
	});
	return false;
}

function sort_by_name() {	
	$.post(SEARCH_FILE, {search_term:'', order:'name'}, function(data) {
		draw_contacts(data);
	});
	return false;
}

function sort_by_last_contact() {	
	$.post(SEARCH_FILE, {search_term:'', order:'last_date'}, function(data) {
		draw_contacts(data);
	});
	return false;
}

function add_new_contact() {
	var new_contact = $('.answers_box_addnew').attr('value');
	if (new_contact == '') return false;
	// Find last position
	var position = $('.contact_name').length;
	$.post(ADD_CONTACT_FILE, {new_contact:new_contact, position:position}, function(data) {
		search_start('');
		$('.answers_box_addnew').attr('value','');
	});
}
function delete_contact(contact_id) {
	$.post(DELETE_CONTACT_FILE, {contact_id:contact_id}, function() {
		search_start('');
	});
}

function update_list() {
	// Forming the variables for ajax request
	$('.contact_name').each(function(i,name) {
		var id = $(this).attr('id');
		var name = $(name).text();
		$.post(UPDATE_LIST_FILE, {
			id: id,
			name: name,
			position: i
		});
	});
}
function update_colors(id, red) {
	$.post(UPDATE_COLOR_FILE, {
		id: id,
		red: red
	}, function(data) {
		$('#contact_container_'+id).attr('class',data);
	});
}

function close_settings() {
	// Find active settings
	var object = $('#contact_input').parent();
	// Update colors
	var contact_red = object.find('#red_set').attr('value');
	if (contact_red == '') { 
		contact_red = 0;
	}
	update_colors(object.attr('id'),contact_red);
	// Close <input> and save new values
	contact_text = object.find('#contact_input').attr('value');
	object.html(contact_text);
	// Update list
	update_list();
}

function draw_contacts(data) {
	// Display data
	$('#sortable').html(data);
	$('.container').slideDown(1000);
	
	// Hide settings
	$('.settings').hide();
	
	// Display edit, delete and update buttons
	$('#sortable div[class*=contact_container_]').hover(function(e) {
		if ($('#contact_input', this).length === 0) {
			$('.contact_edit', this).show();
			$('.contact_delete', this).show();
			$('.contact_update', this).show();
		}
	}, function(e) {
		$('.contact_edit', this).hide();
		$('.contact_delete', this).hide();
		$('.contact_update', this).hide();
	});
	var enable = 0;
	
	$('.contact_edit').click(function(event) {
		if (enable == 0) {
			enable = 1;
			// Save contact name and contact_obj
			contact_text = $(this).parent().find('.contact_name').html();
			var contact_obj = $(this).parent().find('.contact_name');
			
			// Load current settings
			$.post(LOAD_SETTINGS_FILE, {
				id: $(contact_obj).attr('id'),
				name: contact_text
			}, function(data) {
				contact_obj.html(data);
				$('#contact_input').focus();
				$('#contact_input').val($('#contact_input').val()); // Deselect text inside
			});
			
			// Hide buttons
			$(this).hide();
			$(this).parent().find('.contact_delete').hide();
			enable = 0;
		}
	});
	
	$('.contact_delete').click(function(event) {
		var contact_id = $(this).parent().find('.contact_name').attr('id');
		if (confirm('Delete this field?')) {
			delete_contact(contact_id);
		}
	});

	$('.contact_update').click(function(event) {
		var contact_obj = $(this).parent().parent().find('.contact_name');
		$.post(UPDATE_DATE_FILE, {id: $(contact_obj).attr('id')}, function(data) {
			search_start('');
		});
	});
}