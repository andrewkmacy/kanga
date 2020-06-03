/**
 * Customizer controls toggles
 *
 * @package Kanga
 */

( function( $ ) {

	/**
	 * Helper class for the main Customizer interface.
	 *
	 * @since 1.0.0
	 * @class ASTCustomizer
	 */
	KangaNotices = {

		/**
		 * Initializes our custom logic for the Customizer.
		 *
		 * @since 1.0.0
		 * @method init
		 */
		init: function()
		{
			this._bind();
		},

		/**
		 * Binds events for the Kanga Portfolio.
		 *
		 * @since 1.0.0
		 * @access private
		 * @method _bind
		 */
		_bind: function()
		{
			$( document ).on('click', '.kanga-notice-close', KangaNotices._dismissNoticeNew );
			$( document ).on('click', '.kanga-notice .notice-dismiss', KangaNotices._dismissNotice );
		},

		_dismissNotice: function( event ) {
			event.preventDefault();

			var repeat_notice_after = $( this ).parents('.kanga-notice').data( 'repeat-notice-after' ) || '';
			var notice_id = $( this ).parents('.kanga-notice').attr( 'id' ) || '';

			KangaNotices._ajax( notice_id, repeat_notice_after );
		},

		_dismissNoticeNew: function( event ) {
			event.preventDefault();

			var repeat_notice_after = $( this ).attr( 'data-repeat-notice-after' ) || '';
			var notice_id = $( this ).parents('.kanga-notice').attr( 'id' ) || '';

			var $el = $( this ).parents('.kanga-notice');
			$el.fadeTo( 100, 0, function() {
				$el.slideUp( 100, function() {
					$el.remove();
				});
			});

			KangaNotices._ajax( notice_id, repeat_notice_after );

			var link   = $( this ).attr( 'href' ) || '';
			var target = $( this ).attr( 'target' ) || '';
			if( '' !== link && '_blank' === target ) {
				window.open(link , '_blank');
			}
		},

		_ajax: function( notice_id, repeat_notice_after ) {
			
			if( '' === notice_id ) {
				return;
			}

			$.ajax({
				url: ajaxurl,
				type: 'POST',
				data: {
					action            : 'kanga-notice-dismiss',
					nonce             : kangaNotices._notice_nonce,
					notice_id         : notice_id,
					repeat_notice_after : parseInt( repeat_notice_after ),
				},
			});

		}
	};

	$( function() {
		KangaNotices.init();
	} );
} )( jQuery );