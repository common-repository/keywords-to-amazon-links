<?php

define( 'KAL_PLUGIN_PATH', plugin_dir_path(__FILE__) );

/**
 * Plugin class.
 *
 * @package Keywords to Amazon Links
 */
class KAL_Plugin {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	protected $version = '1.0';

	/**
	 * Unique identifier for your plugin.
	 *
	 * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
	 * match the Text Domain file header in the settings plugin file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'kal';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {
        add_action ( 'wp', array( $this, 'register_kal_code' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

    public function register_kal_code()
    {
        $exclude_ids = str_replace(" ", "", get_option($this->plugin_slug . '_exclude_ids'));
        //if enabled and is single page
        if(
            (get_option($this->plugin_slug . '_enabled') == 1)
            &&
            //must be a page or post
            (((is_single() && get_option($this->plugin_slug . '_on_post') == 1) || (is_page() && get_option($this->plugin_slug . '_on_page') == 1)) && get_option($this->plugin_slug . '_amazon_affiliate_tag_id') != '')
            &&
            //must not be in excluded ids array
            (!in_array(get_the_ID(), explode(",", $exclude_ids)))
        )
        {
            add_filter( 'the_content', array( $this, 'insert_affiliate_links' ) );
        }
    }

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public static function activate( $network_wide ) {
		// TODO: Define activation functionality here
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		require_once("inc/install.php");
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Deactivate" action, false if WPMU is disabled or plugin is deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {
		// TODO: Define deactivation functionality here
		//require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		//require_once("inc/deactivate.php");
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Deactivate" action, false if WPMU is disabled or plugin is deactivated on an individual blog.
	 */
	public static function uninstall( $network_wide ) {
		// TODO: Define deactivation functionality here
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		require_once("inc/uninstall.php");
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public static function upgrade( $network_wide ) {
		// TODO: Define activation functionality here
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		require_once("inc/upgrade.php");
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {
        /*
		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		//if ( $screen->id == $this->plugin_screen_hook_suffix ) {
		wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'css/admin.css', __FILE__ ), array(), $this->version );
		wp_enqueue_style($this->plugin_slug . '-admin-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/smoothness/jquery-ui.css', false, $this->version,
			false);
		wp_enqueue_style( $this->plugin_slug .'-admin-timepicker-css', plugins_url( 'css/jquery-ui-timepicker-addon.css', __FILE__ ), array(), $this->version );
		wp_enqueue_style( $this->plugin_slug .'-admin-select2-css', plugins_url( 'files/select2/select2.css', __FILE__ ), array(), $this->version );
		wp_enqueue_style($this->plugin_slug . '-admin-jquery-mobile-css', plugins_url( 'css/bootstrap-switch.min.css', __FILE__ ), false, $this->version, false);
		//}
        */
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {
        /*
		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		//if ( $screen->id == $this->plugin_screen_hook_suffix ) {
		wp_enqueue_script( $this->plugin_slug . '-admin-time', plugins_url( 'js/date.js', __FILE__ ), array(), $this->version );
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery' ), $this->version );
		wp_enqueue_script( $this->plugin_slug . '-admin-timepicker-script', plugins_url( 'js/jquery-ui-timepicker-addon.js', __FILE__ ), array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_slug . '-admin-select2-js', plugins_url( 'files/select2/select2.js', __FILE__ ), array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_slug . '-admin-jquery-mobile-js', plugins_url( 'js/bootstrap-switch.min.js', __FILE__ ), array( 'jquery' ), $this->version, true );
		//}
        */
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_admin_menu() {
		//Settings
        $this->plugin_screen_hook_suffix = add_menu_page(
            __( 'Keywords to Amazon Links', $this->plugin_slug ),
            __( 'Keywords to Amazon Links', $this->plugin_slug ),
            'administrator',
            $this->plugin_slug,
            array( $this, 'display_main_page' )
        );
		$this->plugin_screen_hook_suffix = add_submenu_page(
            $this->plugin_slug,
            __( 'Settings', $this->plugin_slug ),
            __( 'Settings', $this->plugin_slug ),
            'administrator',
            $this->plugin_slug . '-settings',
            array( $this, 'display_settings_page' )
		);
	}

	function register_settings() {
		//register  settings
        register_setting( 'kal-settings-group', $this->plugin_slug . '_enabled' );
        register_setting( 'kal-settings-group', $this->plugin_slug . '_max_replacements' );
        register_setting( 'kal-settings-group', $this->plugin_slug . '_amazon_affiliate_tag_id' );
        register_setting( 'kal-settings-group', $this->plugin_slug . '_on_page' );
        register_setting( 'kal-settings-group', $this->plugin_slug . '_on_post' );
        register_setting( 'kal-settings-group', $this->plugin_slug . '_exclude_ids' );
	}

    public function insert_affiliate_links($content)
    {
        global $wpdb;
        //settings
        $tag = get_option($this->plugin_slug . '_amazon_affiliate_tag_id');
        $max_replacements = get_option($this->plugin_slug . '_max_replacements');
        $replacements = 0;
        if($max_replacements == false)
        {
            $max_replacements = 5;
        }
        if($max_replacements == 0)
        {
            $max_replacements = 500;
        }

        $sql = "
          SELECT *
          FROM {$wpdb->prefix}kal_keywords
       ";
        $links = $wpdb->get_results($sql);

        $original_post = $content; //for tracking

        foreach($links as $link)
        {
            if($link->url != '') {
                $link_replacement = $link->url;
            } else {
                $link_replacement = 'http://www.amazon.com/gp/search/ref=as_li_qf_sp_sr_tl?ie=UTF8&camp=1789&creative=9325&index=aps&keywords='.urlencode($link->keyword).'&linkCode=ur2&tag=' . $tag; //general amazon search link with text in it
            }

            if(strstr($link_replacement, 'http://www.amazon.com/gp/search/ref')) {
                $append_img = '<img src="https://www.assoc-amazon.com/e/ir?t=' . $tag . '&l=ur2&o=1" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />';
            }

            $content = preg_replace('~\b' . $link->keyword . '\b(?!(?>[^<]*(?:<(?!/?a\b)[^<]*)*)</a>)~iu', '<a href="'.$link_replacement.'" rel="nofollow" target="_blank">$0</a>' . $append_img, $content, 1);

            if($original_post != $content)
            {
                $replacements++;
            }

            if($replacements >= $max_replacements)
            {
                break;
            }

        }
        return $content;
    }

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_main_page() {
		//if(trim(get_option($this->plugin_slug . '_appid')) == '' OR trim(get_option($this->plugin_slug . '_secret')) == '')
		//{
			//wp_redirect('?page=nsamazon-settings');
		//}
		ob_start();
		include_once('controllers/main.php');
		echo ob_get_clean();
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_settings_page() {
		ob_start();
		include_once('controllers/settings.php');
		echo ob_get_clean();
	}

	/**
	 * NOTE:  Actions are points in the execution of a page or process
	 *        lifecycle that WordPress fires.
	 *
	 *        WordPress Actions: http://codex.wordpress.org/Plugin_API#Actions
	 *        Action Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
	 *
	 * @since    1.0.0
	 */
	public function action_method_name() {
		// TODO: Define your action hook callback here
	}

	/**
	 * NOTE:  Filters are points of execution in which WordPress modifies data
	 *        before saving it or sending it to the browser.
	 *
	 *        WordPress Filters: http://codex.wordpress.org/Plugin_API#Filters
	 *        Filter Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
	 *
	 * @since    1.0.0
	 */
	public function filter_method_name() {
		// TODO: Define your filter hook callback here
	}

}