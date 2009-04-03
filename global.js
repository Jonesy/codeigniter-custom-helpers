/*
 * global.js
 *
 * Created by STEM for KBMª, 2009
 * Copyright 2009 STEM. All rights reserved.
 * www.stemlimited.com | KBMª
 *
 */

$(document).ready(function(){
	// HOME FEATURE HEIGHT FIX
	var news_height = $('body#home #recent_news').height();
	$('.feature').height(news_height);
	
	// LIGHTBOX
	var lightbox = $("a[rel='lightbox']");
	
	$.each(lightbox, function(e){
		$(this).click(function(){
			// GET THE FILE
			var file = $(this).attr('href');

			$('body').prepend(
				  '<div id="cover" style="display:none;"></div>'
				+ '<div id="lightbox_placeholder" style="display:none;">'
					+ '<div id="lightbox">'
						+ '<div id="lightbox_content"><span></span></div>'
					+ '</div>'
					+ '<div id="lightbox_close"><a href="#" onclick="return false;">&nbsp;</a></div>'
				+ '</div>'
			);
			
			// LOAD THE AJAX CONTENT FORMATTED LIGHTBOX
			if($(this).hasClass('ajax')){
				$.ajax({
					type: "GET",
					url: file,
					success: function(html){
							$('#lightbox_content span').fadeOut(600, function(){
								$('#lightbox_content').append(html);
							});
						},
					error: function(){
							$('#lightbox_content span').fadeOut(600, function(){
								$('#lightbox_content').append('<h3>Error loading file. Please contact the site <a href="mailto:person@person.ca">administrator</a>.</h3>');
							});
						}
				});
			}
			
			// LOAD THE IMAGE FORMATTED LIGHTBOX
			if($(this).hasClass('image')){
				$('#lightbox_content').addClass('image');
				$('#lightbox_content').append('<img src="' + file + '" alt="" id="lightbox_image" style="display: none;"/>');
				$('#lightbox_image').load(function(){
					$('#lightbox_content span').fadeOut(600, function(){
						$('img#lightbox_image').fadeIn('fast');
					});
				});
			}
			
			$(this).trigger('load_frame');
			return false;
		});
	});
	
	$(lightbox).live('load_frame', function(){
		$('#cover').fadeIn('fast');
		$('#lightbox_placeholder').fadeIn('slow');
	});
	
	$('#cover').live('click', function(){
		close_lightbox();
	});
	
	$('#lightbox_close a').live('click', function(){
		close_lightbox();
	});
	
});

function close_lightbox(){
	$('#lightbox, #lightbox_close').fadeOut('fast');
	$('#cover').fadeOut('slow', function(){
			$('#lightbox_placeholder').hide();
			$('#lightbox_content').empty();
			$('#cover, #lightbox_placeholder').remove();
		}
	);
}