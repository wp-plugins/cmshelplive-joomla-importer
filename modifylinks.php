<?php
class j2wpcmshelplive_modifylinks{
		public $plugin_options;			
		public function __construct() {
			
				$this->plugin_options = get_option('cmshelplive_j2woptions');
				$result = $this->modify_links();
				$this->display_admin_notice(sprintf(_n('%d internal link modified', '%d internal links modified', $result['links_count'], 'j2wpcmshelplive'), $result['links_count']));
				
				
		}
		
		public function display_admin_notice( $message )	{
			echo '<div class="updated"><p>'.$message.'</p></div>';
		}

		public function display_admin_error( $message )	{
			echo '<div class="error"><p>'.$message.'</p></div>';
		}
		
		private function modify_links() {
			$links_count = 0;
			$step = 1000; // to limit the results
			$offset = 0;
			$matches = array();
			
			// Hook for doing other actions before modifying the links
			do_action('j2wpcmshelplive_pre_modify_links');
			
			do {
				$args = array(
					'numberposts'	=> $step,
					'offset'		=> $offset,
					'orderby'		=> 'ID',
					'order'			=> 'ASC',
					'post_type'		=> 'any',
				);
				$posts = get_posts($args);
				foreach ( $posts as $post ) {
					$content = $post->post_content;
					if ( preg_match_all('#<a(.*?)href="(.*?)"(.*?)>#', $content, $matches, PREG_SET_ORDER) > 0 ) {
						if ( is_array($matches) ) {
							foreach ($matches as $match ) {
								$link = $match[2];
								list($link_without_anchor, $anchor_link) = $this->split_anchor_link($link); // Split the anchor link
								// Is it an internal link ?
								if ( $this->is_internal_link($link_without_anchor) ) {
									$meta_key_value = $this->get_joomla_id_in_link($link_without_anchor);
									// Can we find an ID in the link ?
									if ( $meta_key_value['meta_value'] != 0 ) {
										// Get the linked post
										$linked_posts = get_posts(array(
											'numberposts'	=> 1,
											'post_type'		=> 'any',
											'meta_key'		=> $meta_key_value['meta_key'],
											'meta_value'	=> $meta_key_value['meta_value'],
										));
										if ( count($linked_posts) > 0 ) {
											$new_link = get_permalink($linked_posts[0]->ID);
											if ( !empty($anchor_link) ) {
												$new_link .= '#' . $anchor_link;
											}
											$content = str_replace("href=\"$link\"", "href=\"$new_link\"", $content);
											// Update the post
											wp_update_post(array(
												'ID'			=> $post->ID,
												'post_content'	=> $content,
											));
											$links_count++;
										}
										unset($linked_posts);
									}
								}
							}
						}
					}
				}
				$offset += $step;
			} while ( ($posts != null) && (count($posts) > 0) );
			
			// Hook for doing other actions after modifying the links
			do_action('j2wpcmshelplive_post_modify_links');
			
			return array('links_count' => $links_count);
		}

		private function is_internal_link($link) {
			$result = (preg_match("#^".$this->plugin_options['url']."#", $link) > 0) ||
				(preg_match("#^http#", $link) == 0);
			return $result;
		}

		private function get_joomla_id_in_link($link) {
			$matches = array();
			
			$meta_key_value = array(
				'meta_key'		=> '',
				'meta_value'	=> 0);
			$meta_key_value = apply_filters('j2wpcmshelplive_pre_get_joomla_id_in_link', $meta_key_value, $link);
			if ( $meta_key_value['meta_value'] == 0 ) {
				$meta_key_value['meta_key'] = '_j2wpcmshelplive_old_id';
				// Without URL rewriting
				if ( preg_match("#id=(\d+)#", $link, $matches) ) {
					$meta_key_value['meta_value'] = $matches[1];
				}
				// With URL rewriting
				elseif ( preg_match("#(.*)/(\d+)-(.*)#", $link, $matches) ) {
					$meta_key_value['meta_value'] = $matches[2];
				} else {
					$meta_key_value = apply_filters('j2wpcmshelplive_post_get_joomla_id_in_link', $meta_key_value);
				}
			}
			return $meta_key_value;
		}
	
		private function split_anchor_link($link) {
			$pos = strpos($link, '#');
			if ( $pos !== false ) {
				// anchor link found
				$link_without_anchor = substr($link, 0, $pos);
				$anchor_link = substr($link, $pos + 1);
				return array($link_without_anchor, $anchor_link);
			} else {
				// anchor link not found
				return array($link, '');
			}
		}
		
	}

?>