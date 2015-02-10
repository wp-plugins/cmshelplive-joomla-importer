<?php
class j2wpcmshelplive_emptycontent{
	
	public $plugin_options;			
	
		public function __construct() {
				$this->plugin_options = get_option('cmshelplive_j2woptions');
				if ($this->empty_database($_POST['empty_action'])) { // Empty WP database
						$this->display_admin_notice(__('WordPress content removed', 'j2wpcmshelplive'));
					} else {
						$this->display_admin_error(__('Couldn\'t remove content', 'j2wpcmshelplive'));
					}
					wp_cache_flush();
				
				
		}
		
		/**
		 * Display admin notice
		 */
		public function display_admin_notice( $message )	{
			echo '<div class="updated"><p>'.$message.'</p></div>';
		}

		/**
		 * Display admin error
		 */
		public function display_admin_error( $message )	{
			echo '<div class="error"><p>'.$message.'</p></div>';
		}

		
	private function empty_database($action) {
			global $wpdb;
			$result = true;
			
			$wpdb->show_errors();
			
			// Hook for doing other actions before emptying the database
			do_action('j2wpcmshelplive_pre_empty_database', $action);
			
			$sql_queries = array();
			
			if ( $action == 'newposts' ) {
				// Remove only new imported posts
				// WordPress post ID to start the deletion
				$start_id = intval(get_option('j2wpcmshelplive_start_id'));
				if ( $start_id != 0) {
					
					$sql_queries[] = <<<SQL
-- Delete Comments meta
DELETE FROM $wpdb->commentmeta
WHERE comment_id IN
	(
	SELECT comment_ID FROM $wpdb->comments
	WHERE comment_post_ID IN
		(
		SELECT ID FROM $wpdb->posts
		WHERE (post_type IN ('post', 'page', 'attachment', 'revision')
		OR post_status = 'trash'
		OR post_title = 'Brouillon auto')
		AND ID >= $start_id
		)
	);
SQL;

					$sql_queries[] = <<<SQL
-- Delete Comments
DELETE FROM $wpdb->comments
WHERE comment_post_ID IN
	(
	SELECT ID FROM $wpdb->posts
	WHERE (post_type IN ('post', 'page', 'attachment', 'revision')
	OR post_status = 'trash'
	OR post_title = 'Brouillon auto')
	AND ID >= $start_id
	);
SQL;

					$sql_queries[] = <<<SQL
-- Delete Term relashionships
DELETE FROM $wpdb->term_relationships
WHERE `object_id` IN
	(
	SELECT ID FROM $wpdb->posts
	WHERE (post_type IN ('post', 'page', 'attachment', 'revision')
	OR post_status = 'trash'
	OR post_title = 'Brouillon auto')
	AND ID >= $start_id
	);
SQL;

					$sql_queries[] = <<<SQL
-- Delete Post meta
DELETE FROM $wpdb->postmeta
WHERE post_id IN
	(
	SELECT ID FROM $wpdb->posts
	WHERE (post_type IN ('post', 'page', 'attachment', 'revision')
	OR post_status = 'trash'
	OR post_title = 'Brouillon auto')
	AND ID >= $start_id
	);
SQL;

					$sql_queries[] = <<<SQL
-- Delete Posts
DELETE FROM $wpdb->posts
WHERE (post_type IN ('post', 'page', 'attachment', 'revision')
OR post_status = 'trash'
OR post_title = 'Brouillon auto')
AND ID >= $start_id;
SQL;
				}
			}
			
			// Execute SQL queries
			if ( count($sql_queries) > 0 ) {
				foreach ( $sql_queries as $sql ) {
					$result &= $wpdb->query($sql);
				}
			}
			
			// Hook for doing other actions after emptying the database
			do_action('j2wpcmshelplive_post_empty_database', $action);
			
			// Reset the Joomla last imported post ID
			update_option('j2wpcmshelplive_last_joomla_id', 0);
			
			// Re-count categories and tags items
			$this->terms_count();
			
			// Update cache
			$this->clean_cache();
			
			$this->optimize_database();
			
			$wpdb->hide_errors();
			return ($result !== false);
		}
		
	protected function optimize_database() {
			global $wpdb;
			
			$sql = <<<SQL
OPTIMIZE TABLE 
`$wpdb->commentmeta` ,
`$wpdb->comments` ,
`$wpdb->options` ,
`$wpdb->postmeta` ,
`$wpdb->posts` ,
`$wpdb->terms` ,
`$wpdb->term_relationships` ,
`$wpdb->term_taxonomy`
SQL;
			$wpdb->query($sql);
		}	
		
	private function terms_count() {
		$result = $this->terms_tax_count('category');
		$result |= $this->terms_tax_count('post_tag');
	}
		
	public function clean_cache($terms = array()) {
			delete_option("category_children");
			clean_term_cache($terms, 'category');
	}
	private function terms_tax_count($taxonomy) {
		$terms = get_terms(array($taxonomy));
		// Get the term taxonomies
		$terms_taxonomies = array();
		foreach ( $terms as $term ) {
			$terms_taxonomies[] = $term->term_taxonomy_id;
		}
		if ( !empty($terms_taxonomies) ) {
			return wp_update_term_count_now($terms_taxonomies, $taxonomy);
		} else {
			return true;
		}
	}
	
		
}
?>