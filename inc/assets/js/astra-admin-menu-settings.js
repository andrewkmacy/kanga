/**
 * Install Starter Templates
 *
 *
 * @since 1.2.4
 */

(function($){

	KangaThemeAdmin = {

		init: function()
		{
			this._bind();
		},


		/**
		 * Binds events for the Kanga Theme.
		 *
		 * @since 1.0.0
		 * @access private
		 * @method _bind
		 */
		_bind: function()
		{
			$( document ).on('ast-after-plugin-active', KangaThemeAdmin._disableActivcationNotice );
			$( document ).on('click' , '.kanga-install-recommended-plugin', KangaThemeAdmin._installNow );
			$( document ).on('click' , '.kanga-activate-recommended-plugin', KangaThemeAdmin._activatePlugin);
			$( document ).on('click' , '.kanga-deactivate-recommended-plugin', KangaThemeAdmin._deactivatePlugin);
			$( document ).on('wp-plugin-install-success' , KangaThemeAdmin._activatePlugin);
			$( document ).on('wp-plugin-install-error'   , KangaThemeAdmin._installError);
			$( document ).on('wp-plugin-installing'      , KangaThemeAdmin._pluginInstalling);
		},

		/**
		 * Plugin Installation Error.
		 */
		_installError: function( event, response ) {

			var $card = jQuery( '.kanga-install-recommended-plugin' );

			$card
				.removeClass( 'button-primary' )
				.addClass( 'disabled' )
				.html( wp.updates.l10n.installFailedShort );
		},

		/**
		 * Installing Plugin
		 */
		_pluginInstalling: function(event, args) {
			event.preventDefault();

			var slug = args.slug;

			var $card = jQuery( '.kanga-install-recommended-plugin' );
			var activatingText = kanga.recommendedPluiginActivatingText;


			$card.each(function( index, element ) {
				element = jQuery( element );
				if ( element.data('slug') === slug ) {
					element.addClass('updating-message');
					element.html( activatingText );
				}
			});

		},

		/**
		 * Activate Success
		 */
		_activatePlugin: function( event, response ) {

			event.preventDefault();

			var $message = jQuery(event.target);
			var $init = $message.data('init');
			var activatedSlug; 

			if (typeof $init === 'undefined') {
				var $message = jQuery('.kanga-install-recommended-plugin[data-slug=' + response.slug + ']');
				activatedSlug = response.slug;
			} else {
				activatedSlug = $init;
			}

			// Transform the 'Install' button into an 'Activate' button.
			var $init = $message.data('init');
			var activatingText = kanga.recommendedPluiginActivatingText;
			var settingsLink = $message.data('settings-link');
			var settingsLinkText = kanga.recommendedPluiginSettingsText;
			var deactivateText = kanga.recommendedPluiginDeactivateText;
			var kangaSitesLink = kanga.kangaSitesLink;
			var kangaPluginRecommendedNonce = kanga.kangaPluginManagerNonce;

			$message.removeClass( 'install-now installed button-disabled updated-message' )
				.addClass('updating-message')
				.html( activatingText );

			// WordPress adds "Activate" button after waiting for 1000ms. So we will run our activation after that.
			setTimeout( function() {

				$.ajax({
					url: kanga.ajaxUrl,
					type: 'POST',
					data: {
						'action'            : 'kanga-sites-plugin-activate',
						'nonce'             : kangaPluginRecommendedNonce,
						'init'              : $init,
					},
				})
				.done(function (result) {

					if( result.success ) {
						var output  = '<a href="#" class="kanga-deactivate-recommended-plugin" data-init="'+ $init +'" data-settings-link="'+ settingsLink +'" data-settings-link-text="'+ deactivateText +'" aria-label="'+ deactivateText +'">'+ deactivateText +'</a>';
							output += ( typeof settingsLink === 'string' && settingsLink != 'undefined' ) ? '<a href="' + settingsLink +'" aria-label="'+ settingsLinkText +'">' + settingsLinkText +' </a>' : '';
							output += ( typeof settingsLink === undefined && settingsLink != undefined ) ? '<a href="' + settingsLink +'" aria-label="'+ settingsLinkText +'">' + settingsLinkText +' </a>' : '';

						$message.removeClass( 'kanga-activate-recommended-plugin kanga-install-recommended-plugin button button-primary install-now activate-now updating-message' );

						$message.parent('.ast-addon-link-wrapper').parent('.kanga-recommended-plugin').addClass('active');
						$message.parents('.ast-addon-link-wrapper').html( output );

						var starterSitesRedirectionUrl = kangaSitesLink + result.data.starter_template_slug;
						jQuery(document).trigger( 'ast-after-plugin-active', [starterSitesRedirectionUrl, activatedSlug] );

					} else {

						$message.removeClass( 'updating-message' );
					}

				});

			}, 1200 );

		},

		/**
		 * Activate Success
		 */
		_deactivatePlugin: function( event, response ) {

			event.preventDefault();

			var $message = jQuery(event.target);

			var $init = $message.data('init');

			if (typeof $init === 'undefined') {
				var $message = jQuery('.kanga-install-recommended-plugin[data-slug=' + response.slug + ']');
			}

			// Transform the 'Install' button into an 'Activate' button.
			var $init = $message.data('init');
			var deactivatingText = $message.data('deactivating-text') || kanga.recommendedPluiginDeactivatingText;
			var settingsLink = $message.data('settings-link');
			var activateText = kanga.recommendedPluiginActivateText;
			var kangaPluginRecommendedNonce = kanga.kangaPluginManagerNonce;

			$message.removeClass( 'install-now installed button-disabled updated-message' )
				.addClass('updating-message')
				.html( deactivatingText );

			// WordPress adds "Activate" button after waiting for 1000ms. So we will run our activation after that.
			setTimeout( function() {

				$.ajax({
					url: kanga.ajaxUrl,
					type: 'POST',
					data: {
						'action'            : 'kanga-sites-plugin-deactivate',
						'nonce'             : kangaPluginRecommendedNonce,
						'init'              : $init,
					},
				})
				.done(function (result) {

					if( result.success ) {
						var output = '<a href="#" class="kanga-activate-recommended-plugin" data-init="'+ $init +'" data-settings-link="'+ settingsLink +'" data-settings-link-text="'+ activateText +'" aria-label="'+ activateText +'">'+ activateText +'</a>';
						$message.removeClass( 'kanga-activate-recommended-plugin kanga-install-recommended-plugin button button-primary install-now activate-now updating-message' );

						$message.parent('.ast-addon-link-wrapper').parent('.kanga-recommended-plugin').removeClass('active');
						
						$message.parents('.ast-addon-link-wrapper').html( output );

					} else {

						$message.removeClass( 'updating-message' );

					}

				});

			}, 1200 );

		},

		/**
		 * Install Now
		 */
		_installNow: function(event)
		{
			event.preventDefault();

			var $button 	= jQuery( event.target ),
				$document   = jQuery(document);

			if ( $button.hasClass( 'updating-message' ) || $button.hasClass( 'button-disabled' ) ) {
				return;
			}

			if ( wp.updates.shouldRequestFilesystemCredentials && ! wp.updates.ajaxLocked ) {
				wp.updates.requestFilesystemCredentials( event );

				$document.on( 'credential-modal-cancel', function() {
					var $message = $( '.kanga-install-recommended-plugin.updating-message' );

					$message
						.addClass('kanga-activate-recommended-plugin')
						.removeClass( 'updating-message kanga-install-recommended-plugin' )
						.text( wp.updates.l10n.installNow );

					wp.a11y.speak( wp.updates.l10n.updateCancel, 'polite' );
				} );
			}
			
			wp.updates.installPlugin( {
				slug:    $button.data( 'slug' )
			});
		},

		/**
		 * After plugin active redirect and deactivate activation notice
		 */
		_disableActivcationNotice: function( event, kangaSitesLink, activatedSlug )
		{
			event.preventDefault();

			if ( activatedSlug.indexOf( 'kanga-sites' ) >= 0 || activatedSlug.indexOf( 'kanga-pro-sites' ) >= 0 ) {
				if ( 'undefined' != typeof KangaNotices ) {
			    	KangaNotices._ajax( 'kanga-sites-on-active', '' );
				}
				window.location.href = kangaSitesLink + '&ast-disable-activation-notice';
			}
		},
	};

	/**
	 * Initialize KangaThemeAdmin
	 */
	$(function(){
		KangaThemeAdmin.init();
	});

})(jQuery);