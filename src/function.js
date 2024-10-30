(function($) {
	
	'use strict';
	
	tinymce.create('tinymce.plugins.wpsInlineTextPopupTinyMcePlugin', {
		init: function(editor, url) { 
				editor.addButton('wpsInlineTextPopupButton', {
				title: 'Add a popup',
				image: url + '/add_popup.png', 
				onclick: function() {
						if(editor.selection.getContent() == "")
						{
							alert('Pleae select any text for add popup');
						}
						else
						{
							editor.windowManager.open({
								title: 'Insert Popup Information',
								body: [
									{
										type: 'textbox',
										name: 'popup_title',
										label: 'Popup Title',
										minWidth: 300
									},	
									{
										type: 'container',
										name: 'popup_content',
										label: 'Popup Content',
										minWidth: 300,
										html: '<textarea id="popup_content" name="popup_content" rows="8" cols="44" style="border:solid 1px #e6e6e6"></textarea>' 
									}
								],		
								width: 500,
								height: 260,
								onsubmit: function(e) {
						
									var popup_content = document.getElementById('popup_content').value;							
									var timeStamp = Math.floor(Date.now());	
									
									if(popup_content == "" || e.data.popup_title == "")
									{
										alert('Please fill all fields');
										return false;
									}
									
									var wpsInlineTextPopupShortcode = '[wpsInlinePopup ';
									wpsInlineTextPopupShortcode += ' popup_id="' + timeStamp + '"';									 
																		 
									if (e.data.popup_title) {
										wpsInlineTextPopupShortcode += ' popup_title="' + e.data.popup_title + '"';
									}
									
									if (popup_content) {
										wpsInlineTextPopupShortcode += ' popup_content="' + popup_content + '"';
									}
															
									
									wpsInlineTextPopupShortcode += ']';
									wpsInlineTextPopupShortcode += editor.selection.getContent();
									wpsInlineTextPopupShortcode += '[/wpsInlinePopup]';														
								
									editor.insertContent(wpsInlineTextPopupShortcode.trim());
								}
						})
					}//close if
				}
			});
	
		}
	});
	tinymce.PluginManager.add('wpsInlineTextPopupTinyMcePlugin', tinymce.plugins.wpsInlineTextPopupTinyMcePlugin);
		  
}());	

window.onclick = function(event) {
	jQuery( ".wps-inline-modal" ).each(function( index ) {
		var modalId = jQuery(this).attr('id');								 
		modal = document.getElementById(modalId);
		if (event.target == modal)
		{
			modal.style.display = "none";
		}						 
	});
}

function wpsOpenModalPopup(popup)
{
	jQuery('#'+popup).show();
}

function wpsCloseModalPopup(popup)
{
	jQuery('#'+popup).hide();
}