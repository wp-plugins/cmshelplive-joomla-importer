<?php

/**

 * Plugin Name: CMSHelpLive: Convert Joomla to WordPress

 * Plugin Uri:  http://cmshelplive.com

 * Description: A plugin to migrate categories, posts, images and medias from Joomla to WordPress

 * Version:     1.0.1

 * Author:      CMSHelpLive

 */



// Exit if accessed directly



register_activation_hook ( __FILE__, 'cmshelplivej2w_activate' );

function cmshelplivej2w_activate()

{

	$plugin_option = array(

				'title' 				=>'CMSHelpLive: Joomla to WordPress',

				'description' 			=>'We\'ll help you import your Joomla content into this site. Let\'s start!',

				'automatic_empty'		=> 0,

				'url'					=> null,

				'hostname'				=> 'localhost',

				'port'					=> 3306,

				'database'				=> null,

				'username'				=> 'root',

				'password'				=> '',

				'prefix'				=> 'jos_',

				'introtext'				=> 'in_content',

				'archived_posts'		=> 'not_imported',

				'skip_media'			=> 0,

				'first_image'			=> 'as_is_and_featured',

				'import_external'		=> 0,

				'import_duplicates'		=> 0,

				'force_media_import'	=> 0,

				'meta_keywords_in_tags'	=> 0,

				'import_as_pages'		=> 0,

				'timeout'				=> 5

			);

			 update_option( 'cmshelplive_j2woptions', $plugin_option );

}

register_deactivation_hook (__FILE__, 'cmshelplivej2w_deactivate' );

function cmshelplivej2w_deactivate()

{

	delete_option('cmshelplive_j2woptions');

}



add_action( 'admin_init', 'cmshelplivej2w_script' );

/*Defines enqueue style/ script for front end*/

function cmshelplivej2w_script() {

	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'cmshelplivej2w_bootstrap.js',  plugin_dir_url(__FILE__) . 'bootstrap/bootstrap.js' );

	wp_enqueue_style( 'cmshelplivej2w_bootstrap.css', plugin_dir_url(__FILE__) . 'bootstrap/bootstrap.css');

	wp_enqueue_style( 'cmshelplivej2w_joomla-to-worpdress.css', plugin_dir_url(__FILE__) . 'bootstrap/joomla-to-worpdress.css');

}



/*Defines menu and sub-menu items in dashboard*/

add_action('admin_menu', 'cmshelplivej2w_menu');

function cmshelplivej2w_menu()

{

	add_menu_page("Joomla To WordPress","Joomla To WordPress","manage_options","cmshelplivej2w_setting","cmshelplivej2w_setting",plugins_url('/images/profile-icon2.png', __FILE__));
	add_submenu_page("cmshelplivej2w_setting","Support","Support","manage_options","cmshelplivej2w_support","cmshelplivej2w_support");

}

function cmshelplivej2w_support()
{
	wp_redirect('http://wordpress.cmshelplive.com/wordpress-migration2.html'); 
  	exit;	
}

function cmshelplivej2w_setting()

{

	include 'settings.php';

}

add_action('wp_ajax_test_joomla_connction', 'cmshelplive_joomla_connect');

add_action('wp_ajax_nopriv_test_joomla_connction', 'cmshelplive_joomla_connect');



function cmshelplive_joomla_connect() 

{

	global $joomla_db;

	

	if ( !class_exists('PDO') ) {

		echo 'PDO is required. Please enable it.';

	}

	try {

    $conn = new PDO('mysql:host='.$_POST['hostname'].';dbname='.$_POST['database'], $_POST['username'], $_POST['password']);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 	//print_r($conn);

    /*$data = $conn->query('SELECT * FROM wp_users WHERE id = 1');

 

    foreach($data as $row) {

        print_r($row); 

    }*/

	$message = 'Connection Successfull';

} 

catch(PDOException $e) {

    $message = 'ERROR: ' . $e->getMessage();

}

	echo '<div class="updated"><p>'.$message.'</p></div>';

die;

	//$this->plugin_options['version'] = $this->joomla_version();

}



add_action('wp_ajax_j2wimportcontent', 'cmshelplive_j2wimportcontent');

add_action('wp_ajax_nopriv_j2wimportcontent', 'cmshelplive_j2wimportcontent');



function cmshelplive_j2wimportcontent()

{

			

				$plugin_option = array(

				'title' 				=>'CMSHelpLive: Joomla to WordPress',

				'description' 			=>'We\'ll help you import your Joomla content into this site. Let\'s start!',

				'automatic_empty'		=> 0,

				'url'					=> $_POST['url'],

				'hostname'				=> $_POST['hostname'],

				'port'					=> $_POST['port'],

				'database'				=> $_POST['database'],

				'username'				=> $_POST['username'],

				'password'				=> $_POST['password'],

				'prefix'				=> $_POST['prefix'],

				'introtext'				=> $_POST['introtext'],

				'archived_posts'		=> $_POST['archived_posts'],

				'skip_media'			=> $_POST['skip_media'],

				'first_image'			=> $_POST['first_image'],

				'import_external'		=> $_POST['import_external'],

				'import_duplicates'		=> $_POST['import_duplicates'],

				'force_media_import'	=> $_POST['force_media_import'],

				'meta_keywords_in_tags'	=> $_POST['meta_keywords_in_tags'],

				'import_as_pages'		=> $_POST['import_as_pages'],

				'timeout'				=> $_POST['timeout'],

			);

			 update_option( 'cmshelplive_j2woptions', $plugin_option );

				include 'function.php';

				 new j2wpcmshelplive();

				

			die;

	

}





add_action('wp_ajax_j2wsavesetting', 'cmshelplive_j2wsavesetting');

add_action('wp_ajax_nopriv_j2wsavesetting', 'cmshelplive_j2wsavesetting');



function cmshelplive_j2wsavesetting()

{

			

				$plugin_option = array(

				'title' 				=>'Import Joomla content To Wordpress By CMSHelpLive',

				'description' 			=>'This plugin import all joomla Content.',

				'automatic_empty'		=> 0,

				'url'					=> $_POST['url'],

				'hostname'				=> $_POST['hostname'],

				'port'					=> $_POST['port'],

				'database'				=> $_POST['database'],

				'username'				=> $_POST['username'],

				'password'				=> $_POST['password'],

				'prefix'				=> $_POST['prefix'],

				'introtext'				=> $_POST['introtext'],

				'archived_posts'		=> $_POST['archived_posts'],

				'skip_media'			=> $_POST['skip_media'],

				'first_image'			=> $_POST['first_image'],

				'import_external'		=> $_POST['import_external'],

				'import_duplicates'		=> $_POST['import_duplicates'],

				'force_media_import'	=> $_POST['force_media_import'],

				'meta_keywords_in_tags'	=> $_POST['meta_keywords_in_tags'],

				'import_as_pages'		=> $_POST['import_as_pages'],

				'timeout'				=> $_POST['timeout'],

			);

			 update_option( 'cmshelplive_j2woptions', $plugin_option );

			$message = 'Setting are saved';

	echo '<div class="updated"><p>'.$message.'</p></div>';

			die;

	

}

add_action('wp_ajax_j2wremovecatprefix', 'cmshelplive_j2wremovecatprefix');

add_action('wp_ajax_nopriv_j2wremovecatprefix', 'cmshelplive_j2wremovecatprefix');

function cmshelplive_j2wremovecatprefix() 

{

	$matches = array();

	$categories = get_terms( 'category', array('hide_empty' => 0) );

	if ( !empty($categories) ) {

		foreach ( $categories as $cat ) {

			if ( preg_match('/^(s|c(d|e|k|z)?)\d+-(.*)/', $cat->slug, $matches) ) {

				wp_update_term($cat->term_id, 'category', array(

					'slug' => $matches[3]

				));

			}

		}

	}

	$message = 'Category prefixes are removed';

	echo '<div class="updated"><p>'.$message.'</p></div>';

	die;

}



add_action('wp_ajax_j2wmodifylinks', 'cmshelplive_j2wmodifylinks');

add_action('wp_ajax_nopriv_j2wmodifylinks', 'cmshelplive_j2wmodifylinks');

function cmshelplive_j2wmodifylinks() 

{

	include 'modifylinks.php';

	new j2wpcmshelplive_modifylinks();

	die;

}



add_action('wp_ajax_j2wremoveprecontent', 'cmshelplive_j2wremoveprecontent');

add_action('wp_ajax_nopriv_j2wremoveprecontent', 'cmshelplive_j2wremoveprecontent');

function cmshelplive_j2wremoveprecontent() 

{

	include 'empty_content.php';

	new j2wpcmshelplive_emptycontent();

	die;

}

add_action('wp_ajax_j2wftpconnectiontest', 'cmshelplive_j2wftpconnectiontest');

add_action('wp_ajax_nopriv_j2wftpconnectiontest', 'cmshelplive_j2wftpconnectiontest');

function cmshelplive_j2wftpconnectiontest() 
{
	$url = $_POST['url'].'/config_cmshelplivej2w.php';
	$curl_handle=curl_init();
  curl_setopt($curl_handle,CURLOPT_URL,$url);
  curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
  curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
  $buffer = curl_exec($curl_handle);
  $code = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
  curl_close($curl_handle);
  if (!empty($buffer)&& $code!="404"){
     print $buffer;
  }
	die;
}


function download_file_for_ftp() {
  if ($_SERVER['REQUEST_URI']=='/downloads/data.csv') {
    header("Content-type: application/x-msdownload",true,200);
    header("Content-Disposition: attachment; filename=data.csv");
    header("Pragma: no-cache");
    header("Expires: 0");
    echo 'data';
    exit();
  }
}