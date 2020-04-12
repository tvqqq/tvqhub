 (function ($) {
	var wp_optimize = window.wp_optimize || {};
	var send_command = wp_optimize.send_command;
	var refresh_frequency = wpoptimize.refresh_frequency || 6000;

	if (!send_command) {
		console.error('WP-Optimize Minify: wp_optimize.send_command is required.');
		return;
	}

	var minify = {};

	/**
	 * Initializing the minify feature and events
	 */
	minify.init = function () {
		
		var minify = this;
		this.enabled = false;

		$(document).on('wp-optimize/minify/toggle-status', function(e, params) {
			if (params.hasOwnProperty('enabled')) {
				$('[data-whichpage="wpo_minify"]').toggleClass('is-enabled', params.enabled)
				minify.enabled = params.enabled;
				if (minify.enabled) minify.getFiles();
			}
		});

		/**
		 * The standard handler for clearing the cache. Safe to use
		 */
		$('.purge_minify_cache').click(function() {
			$.blockUI();
			send_command('purge_minify_cache', null, function(response) {
				console.log(response)
			}).always(function() {
				$.unblockUI();
			});
		});

		/**
		 * Removes the entire cache dir.
		 * Use with caution, as cached html may still reference those files.
		 */
		$('.purge_all_minify_cache').click(function() {
			$.blockUI();
			send_command('purge_all_minify_cache', null, function(response) {
				console.log(response)

			}).always(function() {
				$.unblockUI();
			});
		});

		/**
		 * Forces minifiy to create a new cache, safe to use
		 */
		$('.minify_increment_cache').click(function() {
			$.blockUI();
			send_command('minify_increment_cache', null, function(response) {
				console.log(response)
			}).always(function() {
				$.unblockUI();
			});
		});
		

		// ======= SLIDERS ========
		// Generic slider save
		$('input[type=checkbox].wpo-save-setting').on('change', function(e) {
			var input = $(this),
				val = input.prop('checked'),
				name = input.prop('name'),
				data = {};
			data[name] = val;
			$.blockUI();
			send_command('save_minify_settings', data, function(response) {
				if (response.success) {
					input.trigger('wp-optimize/minify/saved_setting');
				} else {
					console.log('Settings not saved', data)
				}
			}).always(function() {
				$.unblockUI();
			});
		});

		// Slider enable minify
		$('#wpo_min_enable_minify').on('wp-optimize/minify/saved_setting', function() {
			this.enabled = $(this).prop('checked');
			$(document).trigger('wp-optimize/minify/toggle-status', {enabled: this.enabled});
		});
		
		// Toggle wpo-feature-is-disabled class
		$('#wpo_min_enable_minify, #wpo_min_enable_minify_css, #wpo_min_enable_minify_js, #wpo_min_enable_minify_html').on('wp-optimize/minify/saved_setting', function() {
			$(this).closest('.wpo_section').toggleClass('wpo-feature-is-disabled', !$(this).is(':checked'));
		});

		// slider enable Debug mode
		$('#wpo_min_enable_minify_debug').on('wp-optimize/minify/saved_setting', function() {
			// Refresh the page as it's needed to show the extra options
			$.blockUI({message: '<h1>'+wpoptimize.page_refresh+'</h1>'});
			location.href = $('#wp-optimize-nav-tab-wpo_minify-advanced').prop('href');
		});

		// Edit default exclusions
		$('#wpo_min_edit_default_exclutions').on('wp-optimize/minify/saved_setting', function() {
			// Show exclusions section
			$('.wpo-minify-default-exclusions').toggleClass('hidden', !$(this).prop('checked'));
		});

		// Save settings
		$('.wp-optimize-save-minify-settings').click(function(e) {
			e.preventDefault();
			var btn = $(this),
				form = btn.closest('form'),
				spinner = btn.next(),
				success_icon = spinner.next();
			
			spinner.show();
			$.blockUI();
			
			var data = $(form).serializeArray().reduce(function(collection, item) {
				collection[item.name] = item.value;
				return collection;
			}, {});
			
			$(form).find('input[type="checkbox"]').each(function(i) {
				var name = $(this).attr("name");
				data[name] = $(this).is(':checked') ? 'true' : 'false';
			});

			send_command('save_minify_settings', data, function(response) {
				if (response.hasOwnProperty('error')) {
					// show error
					console.log(response.error);
					$('.wpo-error__enabling-cache').removeClass('wpo_hidden').find('p').text(response.error.message);
				} else {
					$('.wpo-error__enabling-cache').addClass('wpo_hidden').find('p').text('');
				}
				spinner.hide();
				success_icon.show();
				setTimeout(function() {
					success_icon.fadeOut('slow', function() {
						success_icon.hide();
					});
				}, 5000);
			}).always(function() {
				$.unblockUI();
			});
		})

		// Dismiss information notice
		$('.wp-optimize-minify-status-information-notice').on('click', '.notice-dismiss', function(e) {
			e.preventDefault();
			send_command('hide_minify_notice');
		});

		// Show logs
		$('#wpo_min_jsprocessed, #wpo_min_cssprocessed').on('click', '.log', function(e) {
			e.preventDefault();
			$(this).nextAll('.wpo_min_log').slideToggle('fast');
		});

		// Set the initial `enabled` value
		this.enabled = $('#wpo_min_enable_minify').prop('checked');
		$(document).trigger('wp-optimize/minify/toggle-status', {enabled: this.enabled});

		return this;
	}

	/**
	 * Get the list of files generated by Minify and update the markup.
	 */
	minify.getFiles = function() {
		// Only run if the feature is enabled
		if (!this.enabled) return;

		var data = {
			stamp: new Date().getTime()
		};

		send_command('get_minify_cached_files', data, function(response) {
			if (response.cachesize.length > 0) {
				$("#wpo_min_cache_size").html(response.cachesize);
				$("#wpo_min_cache_time").html(response.cacheTime);
				$("#wpo_min_cache_path").html(response.cachePath);
			}
	
			// reset
			var wpominarr = [];
	
			// js
			if (response.js.length > 0) {
				$(response.js).each(function () {
					wpominarr.push(this.uid);
					if ($('#'+this.uid).length == 0) {
						$('#wpo_min_jsprocessed ul.processed').append('\
						<li id="'+this.uid+'">\
							<span class="filename">'+this.filename+' ('+this.fsize+')</span>\
							<a href="#" class="log">' + wpoptimize.toggle_info + '</a>\
							<div class="hidden wpo_min_log">'+this.log+'</div>\
						</li>\
					');
					}
				});
			}

			$('#wpo_min_jsprocessed ul.processed .no-files-yet').toggle(!response.js.length);
	
			// css
			if (response.css.length > 0) {
				$(response.css).each(function () {
					wpominarr.push(this.uid);
					if ($('#'+this.uid).length == 0) {
						$('#wpo_min_cssprocessed ul.processed').append('\
						<li id="'+this.uid+'">\
							<span class="filename">'+this.filename+' ('+this.fsize+')</span>\
							<a href="#" class="log">' + wpoptimize.toggle_info + '</a>\
							<div class="hidden wpo_min_log">'+this.log+'</div>\
						</li>\
					');
					}
				});
			}

			$('#wpo_min_cssprocessed ul.processed .no-files-yet').toggle(!response.css.length);
	
			// Remove <li> if it's not in the files array
			$('#wpo_min_jsprocessed ul.processed > li, #wpo_min_cssprocessed ul.processed > li').each(function () {
				if (-1 == jQuery.inArray($(this).attr('id'), wpominarr)) {
					if (!$(this).is('.no-files-yet')) {
						$(this).remove();
					}
				}
			});
		});

		if (refresh_frequency) setTimeout(minify.getFiles.bind(this), refresh_frequency);
	}

	wp_optimize.minify = minify;

})(jQuery);