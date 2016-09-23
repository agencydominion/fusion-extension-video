<?php
/**
 * @package Fusion_Extension_Video
 */
 
/**
 * Plugin Name: Fusion : Extension - Video
 * Plugin URI: http://fusion.1867dev.com
 * Description: Video Extension Package for Fusion.
 * Version: 1.0.1
 * Author: Agency Dominion
 * Author URI: http://agencydominion.com
 * License: GPL2
 */
 
/**
 * FusionExtensionVideo class.
 *
 * Class for initializing an instance of the Fusion Video Extension.
 *
 * @since 1.0.0
 */

class FusionExtensionVideo	{ 
	public function __construct() {
						
		// Initialize the language files
		load_plugin_textdomain( 'fusion-extension-video', false, plugin_dir_url( __FILE__ ) . 'languages' );
		
		// Enqueue front end scripts and styles
		add_action('wp_enqueue_scripts', array($this, 'front_enqueue_scripts_styles'));
		
	}

	/**
	 * Enqueue JavaScript and CSS on Front End pages.
	 *
	 * @since 1.0.0
	 *
	 */
	 
	 public function front_enqueue_scripts_styles() {
	 	//scripts
	 	wp_register_script( 'video_js', plugin_dir_url( __FILE__ ) . 'includes/utilities/video-js/video.js', array('jquery'), '4.11.2', true );
	 	wp_register_script( 'fsn_video', plugin_dir_url( __FILE__ ) . 'includes/js/fusion-extension-video.js', array('jquery','fsn_core'), '1.0.0', true );
	 	//styles
	 	global $post;
		if (has_shortcode($post->post_content, 'fsn_video')) {
		 	wp_enqueue_style( 'video_js', plugin_dir_url( __FILE__ ) . 'includes/utilities/video-js/video-js.min.css', false, '4.11.2' );
			wp_enqueue_style( 'fsn_video', plugin_dir_url( __FILE__ ) . 'includes/css/fusion-extension-video.css', false, '1.0.0' );
		}
	}
	
}

$fsn_extension_video = new FusionExtensionVideo();

/**
 * Video JS Flash Fallback container
 */

function fsn_video_js_flash_fallback() {
	static $has_run = false;
	if ($has_run === false) {
		?>
		<script>
			var params = {};
			params.wmode = "transparent";
			videojs.options.flash.swf = '<?php echo plugin_dir_url( __FILE__ ); ?>includes/utilities/video-js/video-js.swf';
			videojs.options.flash.params = params
		</script>
		<?php
	}
	$has_run = true;
}

//EXTENSIONS

//Video
require_once('includes/extensions/video.php');

?>