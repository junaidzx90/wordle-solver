<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Wordle_Solver
 * @subpackage Wordle_Solver/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wordle_Solver
 * @subpackage Wordle_Solver/public
 * @author     Developer Junayed <admin@easeare.com>
 */
class Wordle_Solver_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_shortcode( 'wordle', [$this, 'wordle_shortcode_callback'] );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wordle_Solver_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordle_Solver_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wordle-solver-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wordle_Solver_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordle_Solver_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wordle-solver-public.js', array( 'jquery' ), $this->version, true );

	}

	function head_styles(){
		?>
		<style>
			:root{
				--corr_bg: <?php echo ((get_option('correct_letters_box_bg')) ? get_option('correct_letters_box_bg') : '#538d4e') ?>;
				--miss_bg: <?php echo ((get_option('misplaced_letters_box_bg')) ? get_option('misplaced_letters_box_bg') : '#b59f3b') ?>;
				--inc_bg: <?php echo ((get_option('incorrect_letters_box_bg')) ? get_option('incorrect_letters_box_bg') : '#3a3a3c') ?>;
			}
		</style>
		<?php
	}

	function wordle_shortcode_callback($atts){
		ob_start();
		global $wpdb;
		$words = $wpdb->get_results("SELECT word FROM {$wpdb->prefix}wordle_solver_words");
		$words = wp_list_pluck( $words, 'word' );

		wp_localize_script( $this->plugin_name, 'wordleajax', array(
			'data' => $words
		));

		$atts = shortcode_atts( array(
			'corr_first' => '',
			'corr_second' => '',
			'corr_third' => '',
			'corr_fourth' => '',
			'corr_fifth' => '',
			'missp_first' => '',
			'missp_second' => '',
			'missp_third' => '',
			'missp_fourth' => '',
			'missp_fifth' => '',
			'recom_show' => '',
			'common_show' => '',
			'possible_show' => '',
			'possible_text' => '',
			'recom_text' => '',
			'incorr_latters' => ''
		), $atts, 'wordle' );

		require_once plugin_dir_path( __FILE__ )."partials/wordle-solver-public-tool.php";
		return ob_get_clean();
	}

}
