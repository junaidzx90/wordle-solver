<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Wordle_Solver
 * @subpackage Wordle_Solver/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wordle_Solver
 * @subpackage Wordle_Solver/admin
 * @author     Developer Junayed <admin@easeare.com>
 */
class Wordle_Solver_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( 'wp-color-picker');
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wordle-solver-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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
		wp_enqueue_script( 'wp-color-picker');
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wordle-solver-admin.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, "wordleajax", array(
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		) );
	}

	function admin_menu_page(){
		add_menu_page( "Wordle Solver", "Wordle Solver", "manage_options", "wordle-solver", [$this, "wordle_solver_table_contents_callback"], 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMTAwMCAxMDAwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAxMDAwIDEwMDAiIHhtbDpzcGFjZT0icHJlc2VydmUiIGZpbGw9IiNmMGY2ZmM5OSIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCI+IDxtZXRhZGF0YT4gU3ZnIFZlY3RvciBJY29ucyA6IGh0dHA6Ly93d3cub25saW5ld2ViZm9udHMuY29tL2ljb24gPC9tZXRhZGF0YT4gPGc+PHBhdGggZD0iTTk5MCw2NzIuNmMwLDI5LjctOC44LDU0LjQtMjYuNCw3NC4yYy0xNy42LDE5LjgtNDEuOCwyOS43LTcyLjgsMjkuN2MtMTYuMiwwLTMxLjMtMy4zLTQ1LjQtOS45Yy0xNC4xLTYuNi0yNS43LTEzLjUtMzQuOC0yMC44cy0yMC40LTE0LjItMzMuOC0yMC44Yy0xMy40LTYuNi0yNy4xLTkuOS00MS4xLTkuOWMtNDMuNiwwLTY1LjQsMjIuNy02NS40LDY4LjJjMCwxNC41LDMuMiwzNS45LDkuNSw2NC4zYzYuMywyOC4zLDkuMSw0OS40LDguNCw2My4zdjNjLTguNCwwLTE0LjgsMC0xOSwwYy0xMy40LDEuMy0zMi4zLDMuNi01Nyw2LjljLTI0LjYsMy4zLTQ3LjUsNS42LTY4LjYsNi45Yy0yMS4xLDEuMy00MC40LDIuMy01OCwzYy0yMy45LDAtNDQtNC45LTYwLjEtMTQuOGMtMTYuMi05LjktMjQuMy0yNS40LTI0LjMtNDYuNWMwLTEzLjIsMy4yLTI2LDkuNS0zOC42czE0LjEtMjMuMSwyMy4yLTMxLjZjOS4xLTguNiwxNi41LTE5LjQsMjIuMi0zMi42YzUuNi0xMy4yLDguOC0yNy40LDkuNS00Mi41YzAtMjktMTAuNS01MS44LTMxLjYtNjguMmMtMjEuMS0xNi41LTQ3LjUtMjQuNy03OS4xLTI0LjdjLTMzLjEsMC02MS4yLDguNi04NC40LDI1LjdjLTIzLjIsMTcuMS0zNC44LDQwLjUtMzQuOCw3MC4yYzAsMTUuOCwzLjIsMzEsOS41LDQ1LjVjNi4zLDE0LjUsMTIuNywyNi40LDE5LDM1LjZzMTMsMTkuMSwyMCwyOS43YzcsMTAuNiw5LjgsMTkuOCw4LjQsMjcuN2MwLDE2LjUtOC44LDMzLTI2LjQsNDkuNGMtMTQuOCwxMi41LTM4LDE4LjgtNjkuNiwxOC44Yy0zNy4zLDAtODUuMS00LjMtMTQzLjUtMTIuOWMtMy41LTAuNy05LjEtMS4zLTE2LjktMmMtNy43LTAuNy0xMy0xLjctMTUuOC0zbC03LjQtMWMtMC43LDAtMS40LDAtMi4xLDBzLTEuMS0wLjMtMS4xLTFWMzQ5LjJjMC43LDAsNC4yLDAuNywxMC41LDJjNi4zLDEuMywxMywyLDIwLDJjNywwLDExLjMsMC43LDEyLjcsMmM1OC40LDkuMiwxMDYuMiwxMy44LDE0My41LDEzLjhjMzEuNiwwLDU0LjktNi42LDY5LjYtMTkuOGMxNy42LTE1LjgsMjYuNC0zMiwyNi40LTQ4LjVjMC04LjYtMi44LTE4LjEtOC40LTI4LjdjLTUuNi0xMC41LTEyLjMtMjAuMS0yMC0yOC43Yy03LjctOC42LTE0LjEtMjAuNC0xOS0zNS42Yy00LjktMTUuMi04LjEtMzAuMy05LjUtNDUuNWMwLTMwLjMsMTEuNi01NC4xLDM0LjgtNzEuMmMyMy4yLTE3LjEsNTEuNy0yNS40LDg1LjQtMjQuN2MzMC45LDAsNTcsOC4yLDc4LjEsMjQuN2MyMS4xLDE2LjUsMzEuNiwzOS4yLDMxLjYsNjguMmMwLDE1LjItMy4yLDI5LjMtOS41LDQyLjVjLTYuMywxMy4yLTEzLjcsMjQuMS0yMi4yLDMyLjZjLTguNCw4LjYtMTYuMiwxOC44LTIzLjIsMzAuN3MtMTAuMiwyNS4xLTkuNSwzOS42YzAsMjEuMSw4LjEsMzYuNiwyNC4zLDQ2LjVjMTYuMiw5LjksMzYuMiwxNC41LDYwLjEsMTMuOGMyNS4zLDAsNjAuOC0yLjYsMTA2LjUtNy45YzQ1LjctNS4zLDc3LjctOC4yLDk2LTguOXYxYy0wLjcsMC43LTEuNCwzLjYtMi4xLDguOWMtMC43LDUuMy0xLjgsMTEuNS0zLjIsMTguOHMtMi4xLDExLjItMi4xLDExLjljLTkuMSw1NS40LTEzLjcsMTAwLjUtMTMuNywxMzUuNWMwLDI5LjcsNi43LDUxLjEsMjAsNjQuM2MxNy42LDE3LjEsMzUuMiwyNS43LDUyLjcsMjUuN2M4LjQsMCwxOC4zLTIuNiwyOS41LTcuOWMxMS4zLTUuMywyMS44LTExLjUsMzEuNi0xOC44czIyLjUtMTMuNSwzOC0xOC44YzE1LjUtNS4zLDMxLjYtNy45LDQ4LjUtNy45YzMyLjQsMCw1Ny4zLDEwLjksNzQuOSwzMi42Uzk4OS4zLDY0MS42LDk5MCw2NzIuNkw5OTAsNjcyLjZ6Ii8+PC9nPiA8L3N2Zz4=', 45 );
		add_submenu_page( "wordle-solver", "Words", "Words", "manage_options", "wordle-solver", [$this, "wordle_solver_table_contents_callback"], 1 );
		add_submenu_page( "wordle-solver", "Add words", "Add words", "manage_options", "add-words", [$this, "wordle_solver_add_words_callback"], 2 );
		add_submenu_page( "wordle-solver", "Settings", "Settings", "manage_options", "ws-settings", [$this, "wordle_solver_settings_callback"], 2 );

		add_settings_section( 'ws_general_section', '', '', 'ws_general_page' );
		
		// Correct Letters bacground color
		add_settings_field( 'correct_letters_box_bg', 'Correct Letters bacground color', [$this, 'correct_letters_box_bg_cb'], 'ws_general_page','ws_general_section' );
		register_setting( 'ws_general_section', 'correct_letters_box_bg' );
		// Misplaced Letters bacground color
		add_settings_field( 'misplaced_letters_box_bg', 'Misplaced Letters bacground color', [$this, 'misplaced_letters_box_bg_cb'], 'ws_general_page','ws_general_section' );
		register_setting( 'ws_general_section', 'misplaced_letters_box_bg' );
		// Incorrect Letters bacground color
		add_settings_field( 'incorrect_letters_box_bg', 'Incorrect Letters bacground color', [$this, 'incorrect_letters_box_bg_cb'], 'ws_general_page','ws_general_section' );
		register_setting( 'ws_general_section', 'incorrect_letters_box_bg' );
	}

	function correct_letters_box_bg_cb(){
		echo '<input type="text" name="correct_letters_box_bg" id="correct_letters_box_bg" data-default-color="#538d4e" value="'.((get_option('correct_letters_box_bg')) ? get_option('correct_letters_box_bg') : '#538d4e').'">';
	}
	function misplaced_letters_box_bg_cb(){
		echo '<input type="text" name="misplaced_letters_box_bg" id="misplaced_letters_box_bg" data-default-color="#b59f3b" value="'.((get_option('misplaced_letters_box_bg')) ? get_option('misplaced_letters_box_bg') : '#b59f3b').'">';
	}
	function incorrect_letters_box_bg_cb(){
		echo '<input type="text" name="incorrect_letters_box_bg" id="incorrect_letters_box_bg" data-default-color="#3a3a3c" value="'.((get_option('incorrect_letters_box_bg')) ? get_option('incorrect_letters_box_bg') : '#3a3a3c').'">';
	}

	function register_wordle_tinymce_button_script( $plugin_array ) {
		$plugin_array['wordle_tinymce_button'] = plugin_dir_url( __FILE__ ).'js/editor.js';
		return $plugin_array;
	}
	
	function add_wordle_tinymce_button( $buttons ) {
		array_push( $buttons, 'wordle_tinymce_button' );
		return $buttons;
	}	

	function wordle_setup_view(){
		global $post;
		$screen = get_current_screen();

		$correctBoxes = [];
		$missplacedBoxes = [];
		$incorrect_latters = '';
		$recom_show = '';
		$possible_show = '';
		$common_show = '';
		$possible_text = '';
		$recom_text = '';
		
		if($screen->id === 'post' || $screen->id === 'page'){
			$post_id = $post->ID;
			$data = get_post_meta($post_id, "wordle_settings", true);

			if(is_array($data)){
				$correctBoxes = $data['correctLaters'];
				$missplacedBoxes = $data['missplacedLaters'];
				$incorrect_latters = $data['incorrect_latters'];
				$recom_show = $data['recom_show'];
				$possible_show = $data['possible_show'];
				$common_show = $data['common_show'];
				$possible_text = $data['possible_text'];
				$recom_text = $data['recom_text'];
			}
		}

		?>
		<div id="wordle-setup-page" class="wordlenone">
			<div class="wordle__contents">
				<div class="wordle__heading">
					<h3>Wordle Settings</h3>
					<span class="close_wordle_window">+</span>
				</div>

				<div class="wordle_settings">
					<div class="wordle_row">
						<div class="label">
							<p>Custom letters</p>
							<span>Correct letters section</span>
						</div>
						<div class="wordle_input">
							<div class="wordle_input_box wordle_correct">
								<input maxlength="1" value="<?php echo ((array_key_exists('first', $correctBoxes)) ? $correctBoxes['first']: '') ?>" type="text" name="correct_letters[1]">
								<input maxlength="1" value="<?php echo ((array_key_exists('second', $correctBoxes)) ? $correctBoxes['second']: '') ?>" type="text" name="correct_letters[2]">
								<input maxlength="1" value="<?php echo ((array_key_exists('third', $correctBoxes)) ? $correctBoxes['third']: '') ?>" type="text" name="correct_letters[3]">
								<input maxlength="1" value="<?php echo ((array_key_exists('fourth', $correctBoxes)) ? $correctBoxes['fourth']: '') ?>" type="text" name="correct_letters[4]">
								<input maxlength="1" value="<?php echo ((array_key_exists('fifth', $correctBoxes)) ? $correctBoxes['fifth']: '') ?>" type="text" name="correct_letters[5]">
							</div>
						</div>
					</div>
					<div class="wordle_row">
						<div class="label">
							<p>Custom letters</p>
							<span>Missplaced letters section</span>
						</div>
						<div class="wordle_input">
							<div class="wordle_input_box wordle_missplaced">
								<input maxlength="1" value="<?php echo ((array_key_exists('first', $missplacedBoxes)) ? $missplacedBoxes['first']: '') ?>" type="text" name="missplaced_letters[1]">
								<input maxlength="1" value="<?php echo ((array_key_exists('second', $missplacedBoxes)) ? $missplacedBoxes['second']: '') ?>" type="text" name="missplaced_letters[2]">
								<input maxlength="1" value="<?php echo ((array_key_exists('third', $missplacedBoxes)) ? $missplacedBoxes['third']: '') ?>" type="text" name="missplaced_letters[3]">
								<input maxlength="1" value="<?php echo ((array_key_exists('fourth', $missplacedBoxes)) ? $missplacedBoxes['fourth']: '') ?>" type="text" name="missplaced_letters[4]">
								<input maxlength="1" value="<?php echo ((array_key_exists('fifth', $missplacedBoxes)) ? $missplacedBoxes['fifth']: '') ?>" type="text" name="missplaced_letters[5]">
							</div>
						</div>
					</div>
					<div class="wordle_row">
						<div class="label">
							<p>Custom letters</p>
							<span>Incorrect letters section</span>
						</div>
						<div class="wordle_input">
							<input type="text" class="widefat" name="incorrect_latters" value="<?php echo $incorrect_latters ?>">
						</div>
					</div>
					<div class="wordle_row">
						<div class="label">
							<p>Hide Recommended Answer</p>
						</div>
						<div class="wordle_input">
							<input type="checkbox" <?php echo (($recom_show === 'on')? 'checked': '') ?> name="recommended_letters_show">
						</div>
					</div>
					<div class="wordle_row">
						<div class="label">
							<p>Hide Possible Answer</p>
						</div>
						<div class="wordle_input">
							<input type="checkbox" <?php echo (($possible_show === 'on')? 'checked': '') ?> name="possible_letters_show">
						</div>
					</div>
					<div class="wordle_row">
						<div class="label">
							<p>Hide Common Letters</p>
						</div>
						<div class="wordle_input">
							<input type="checkbox" <?php echo (($common_show === 'on')? 'checked': '') ?> name="common_letters_show">
						</div>
					</div>
					<div class="wordle_row">
						<div class="label">
							<p>Custom "Recommended Answers" text</p>
						</div>
						<div class="wordle_input">
							<input type="text" class="widefat" value="<?php echo $recom_text ?>" placeholder="Leave empty to use default" name="custom_text_recommended">
						</div>
					</div>
					<div class="wordle_row">
						<div class="label">
							<p>Custom "Possible Answers" text</p>
						</div>
						<div class="wordle_input">
							<input type="text" class="widefat" value="<?php echo $possible_text ?>" placeholder="Leave empty to use default" name="custom_text_possible">
						</div>
					</div>
					<div class="wordle_row">
						<div class="label">
							<p>Insert customized settings</p>
						</div>
						<div class="wordle_input">
							<button id="insert-custom" class="button-primary">Insert Custom Settings</button>
						</div>
					</div>
					<div class="wordle_row">
						<div class="label">
							<p>Insert default settings</p>
						</div>
						<div class="wordle_input">
							<button id="insert-default" class="button-primary">Insert default Settings</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	function wordle_solver_add_words_callback(){
		if(isset($_POST['save_wordle_words'])){
			global $wpdb;
			$words = ((isset($_POST['wordle_words'])) ? array_values($_POST['wordle_words']) : []);
			foreach($words as $word){
				$w = sanitize_text_field( stripslashes($word) );
				$w = strtolower($w);
				if(strlen($w) === 5){
					if(!$wpdb->get_var("SELECT ID FROM {$wpdb->prefix}wordle_solver_words WHERE word = '$w'")){
						$wpdb->insert($wpdb->prefix.'wordle_solver_words', array(
							'word' => $w
						));
					}
				}
			}

			if(!is_wp_error( $wpdb )){
				wp_safe_redirect( admin_url( 'admin.php?page=wordle-solver' ) );
				exit;
			}
		}
		if(isset($_GET['page']) && $_GET['page'] === 'add-words' && isset($_GET['action']) && $_GET['action'] === 'import'){

			$errorshow = '';
			if(isset($_POST['wordle_csv_file_upload'])){
  				$extension = pathinfo($_FILES['wordle_csv_file']['name'], PATHINFO_EXTENSION);
				if($extension === 'csv'){
					global $wpdb;
					$file = $_FILES['wordle_csv_file']['name'];
					$file_data = $_FILES['wordle_csv_file']['tmp_name'];
					$handle = fopen($file_data, "r");
					
					while(($word = fgetcsv($handle)) !== false){
						$w = sanitize_text_field( stripslashes($word[0]) );
						$w = strtolower($w);
						if(strlen($w) === 5){
							if(!$wpdb->get_var("SELECT ID FROM {$wpdb->prefix}wordle_solver_words WHERE word = '$w'")){
								$wpdb->insert($wpdb->prefix.'wordle_solver_words', array(
									'word' => $w
								));
							}
						}
					}

					if(!is_wp_error( $wpdb )){
						wp_safe_redirect( admin_url( 'admin.php?page=wordle-solver' ) );
						exit;
					}
					
					fclose($handle);
				}else{
					$errorshow = "Invalid file-type.";
				}
			}

			?>
			<div class="importForm">
				<form method="post" class="import_form_contents" enctype="multipart/form-data">
					<h3>Select a CSV file</h3>
					<?php
					if(!empty($errorshow)){
						?>
						<div class="wordleAlert">
							<p><?php echo $errorshow ?></p>
						</div>
						<?php
					}
					?>
					<input type="file" name="wordle_csv_file" id="csv__file">
					<input type="submit" name="wordle_csv_file_upload" class="button-secondary" value="Upload">
				</form>
			</div>
			<?php
		}else{
			?>
			<div id="word_adding_box">
				<h3>Add words <a href="?page=add-words&action=import" class="button-secondary">Import</a></h3>
				<hr>
	
				<form action="" method="post">
					<div id="wordle_words">
						<input placeholder="Word" required pattern=".{5}" type="text" name="wordle_words[]" title='Word length must be 5 characters.' class="wordle-word">
					</div>
					<input type="submit" name="save_wordle_words" class="button-primary" id="save_words" value="Save Words">
				</form>
			</div>
			<?php
		}
		
	}

	function wordle_solver_table_contents_callback(){
		$wordle_solver = new Wordle_Solver_Table();
		?>
		<div class="wrap" id="wordle-solver-table">
			<h3 class="heading3">Wordle solver words</h3>
			<hr>
			
			<form action="" method="post">
				<?php
				$wordle_solver->prepare_items();
				$wordle_solver->display();
				?>
			</form>
		</div>
		<?php
	}

	function wordle_solver_settings_callback(){
		?>
		<div id="wordle">
			<h3 class="wordle-title">Settings</h3>
			<hr>
			<div class="wordle-content">
				<form method="post" action="options.php">
					<?php
					settings_fields( 'ws_general_section' );
					do_settings_sections( 'ws_general_page' );
					?>
					<?php submit_button(); ?>
				</form>
			</div>
		</div>
		<?php
	}

	function wordle_settings_update(){
		if(isset($_POST['data']) && isset($_POST['post_ID']) && !empty($_POST['post_ID'])){
			$dataArr = $_POST['data'];

			$data = [
				'correctLaters' => $dataArr['correctLaters'],
				'missplacedLaters' => $dataArr['missplacedLaters'],
				'incorrect_latters' => $dataArr['incorrect_latters'],
				'recom_show' => $dataArr['recom_show'],
				'common_show' => $dataArr['common_show'],
				'possible_show' => $dataArr['possible_show'],
				'possible_text' => sanitize_text_field( stripcslashes($dataArr['possible_text']) ),
				'recom_text' =>  sanitize_text_field( stripcslashes( $dataArr['recom_text']) )
			];

			update_post_meta(intval($_POST['post_ID']), 'wordle_settings', $data);
			echo json_encode(array("success" => 'Seccess'));
			die;
		}
	}

	// Export wordle words
	function wordle_words_export(){
		if(isset($_GET['page']) && $_GET['page'] === 'wordle-solver' && isset($_GET['action']) && $_GET['action'] === 'export' && is_admin(  )){
			global $wpdb;
			$event_id = intval($_GET['post']);
    		$words = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}wordle_solver_words");

			if(is_array($words) && sizeof($words) > 0){ 
				$delimiter = ","; 
				$filename = "Wordle-words-" . date('Y-m-d') . ".csv"; 
				 
				// Create a file pointer 
				$f = fopen('php://memory', 'w'); 
				 
				// Output each row of the data, format line as csv and write to file pointer 
				foreach($words as $word){

					$lineData = array(
						$word->word,
					); 
					fputcsv($f, $lineData, $delimiter);

				} 
				 
				// Move back to beginning of file 
				fseek($f, 0); 
				 
				// Set headers to download file rather than displayed 
				header('Content-Type: text/csv'); 
				header('Content-Disposition: attachment; filename="' . $filename . '";'); 
				 
				//output all remaining data on a file pointer 
				fpassthru($f); 
				exit;
			}
			
			return;
		}
	}






	
}
