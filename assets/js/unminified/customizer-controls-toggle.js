/**
 * Customizer controls toggles
 *
 * @package Kanga
 */

( function( $ ) {

	/* Internal shorthand */
	var api = wp.customize;

	/**
	 * Trigger hooks
	 */
	ASTControlTrigger = {

	    /**
	     * Trigger a hook.
	     *
	     * @since 1.0.0
	     * @method triggerHook
	     * @param {String} hook The hook to trigger.
	     * @param {Array} args An array of args to pass to the hook.
		 */
	    triggerHook: function( hook, args )
	    {
	    	$( 'body' ).trigger( 'kanga-control-trigger.' + hook, args );
	    },

	    /**
	     * Add a hook.
	     *
	     * @since 1.0.0
	     * @method addHook
	     * @param {String} hook The hook to add.
	     * @param {Function} callback A function to call when the hook is triggered.
	     */
	    addHook: function( hook, callback )
	    {
	    	$( 'body' ).on( 'kanga-control-trigger.' + hook, callback );
	    },

	    /**
	     * Remove a hook.
	     *
	     * @since 1.0.0
	     * @method removeHook
	     * @param {String} hook The hook to remove.
	     * @param {Function} callback The callback function to remove.
	     */
	    removeHook: function( hook, callback )
	    {
		    $( 'body' ).off( 'kanga-control-trigger.' + hook, callback );
	    },
	};

	/**
	 * Helper class that contains data for showing and hiding controls.
	 *
	 * @since 1.0.0
	 * @class ASTCustomizerToggles
	 */
	ASTCustomizerToggles = {

		'kanga-settings[display-site-title]' : [],

		'kanga-settings[display-site-tagline]' : [],

		'kanga-settings[ast-header-retina-logo]' :[],

		'custom_logo' : [],
		
		/**
		 * Section - Header
		 *
		 * @link  ?autofocus[section]=section-header
		 */

		/**
		 * Layout 2
		 */
		// Layout 2 > Right Section > Text / HTML
		// Layout 2 > Right Section > Search Type
		// Layout 2 > Right Section > Search Type > Search Box Type.
		'kanga-settings[header-main-rt-section]' : [],
		

		'kanga-settings[hide-custom-menu-mobile]' :[],
		

		/**
		 * Blog
		 */
		'kanga-settings[blog-width]' :[],
		
		'kanga-settings[blog-post-structure]' :[],

		/**
		 * Blog Single
		 */
		 'kanga-settings[blog-single-post-structure]' : [],
		
		'kanga-settings[blog-single-width]' : [],
		
		'kanga-settings[blog-single-meta]' :[], 
		

		/**
		 * Small Footer
		 */
		'kanga-settings[footer-sml-layout]' : [],
		
		'kanga-settings[footer-sml-section-1]' :[],
		
		'kanga-settings[footer-sml-section-2]' :[],
		
		'kanga-settings[footer-sml-divider]' :[],
		
		'kanga-settings[header-main-sep]' :[],
	
		'kanga-settings[disable-primary-nav]' :[],
		
		/**
		 * Footer Widgets
		 */
		'kanga-settings[footer-adv]' :[],
		
		'kanga-settings[shop-archive-width]' :[],
		
		'kanga-settings[mobile-header-logo]' :[],
		
		'kanga-settings[different-mobile-logo]' :[],

	};

} )( jQuery );