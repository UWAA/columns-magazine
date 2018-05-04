<?php namespace Columns;

class Utilities{

	public static $allowedHTML = array(
    	'a' => array(
    	    'href' => array(),
    	    'title' => array()
    	),
    	'br' => array(),
    	'em' => array(),
    	'strong' => array()
    	);

	function __construct() {

		add_action( 'admin_menu', array($this, 'renamePostsToShortContent') );
		add_action( 'init', array($this, 'updatePostLabelsForShortContent') );
        add_action('admin_menu', array($this, 'addIssueControlOptionsPage'));
        add_action( 'wp_print_footer_scripts', array($this,'example_mejs_add_container_class' ));
        add_filter( 'pre_get_posts', array($this, 'namespace_add_custom_types' ));
        add_action( 'admin_init', array($this, 'addOrderToPosts' ));
        add_filter( 'posts_search', array($this, 'advanced_custom_search'), 500, 2 );
        add_filter( 'body_class', array($this, 'custom_class') );
	}


	public function renamePostsToShortContent() {
		global $menu;
		global $submenu;
		$menu[5][0] = 'Short Content';
		$submenu['edit.php'][5][0] = 'Short Content';
		$submenu['edit.php'][10][0] = 'Add Short Content';
		$submenu['edit.php'][16][0] = 'Short Content Tags';
		echo '';
	}
	public function updatePostLabelsForShortContent() {
		global $wp_post_types;
			$labels = &$wp_post_types['post']->labels;
			$labels->name = 'Short Content';
			$labels->singular_name = 'Short Content';
			$labels->add_new = 'Add Short Content';
			$labels->add_new_item = 'Add Short Content';
			$labels->edit_item = 'Edit Short Content';
			$labels->new_item = 'Short Content';
			$labels->view_item = 'View Short Content';
			$labels->search_items = 'Search Short Content';
			$labels->not_found = 'No Short Content found';
			$labels->not_found_in_trash = 'No Short Content found in Trash';
	}

    public function addIssueControlOptionsPage() {
        if( function_exists('acf_add_options_page') ) {

            acf_add_options_page(array(
                'page_title'    => 'Issue Settings',
                'menu_title'    => 'Issue Settings',
                'menu_slug'     => 'issue-general-settings',
                'capability'    => 'edit_posts',
                'redirect'      => false
            ));

        }
    }

    public function namespace_add_custom_types( $query ) {
        if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters']   )   ) {
          $query  ->set( 'post_type', array(
           'post', 'nav_menu_item', 'feature'
              ));
            return $query;
        }
    }

    public function customizeColumnsExcerptLength( $length ) {
        return 25;
    }

    public function wpdocs_excerpt_more( $more ) {
    return '...';
    }

    public function excerpt_more_override($excerpt) {
        return $excerpt . '<div><a class="more" href="' . get_permalink() . '">more</a></div>';
    }

    public function addOrderToPosts() {
        add_post_type_support( 'post', 'page-attributes' );
    }

    public function myplugin_update_slug( $data, $postarr ) {
        if($postType  = 'feature') {
        $data['post_name'] = sanitize_title( $data['post_title'] );
        return $data;
    }
}

       /**
     * [list_searcheable_acf list all the custom fields we want to include in our search query]
     * @return [array] [list of custom fields]
     */
    private function list_searcheable_acf(){
      $list_searcheable_acf = array("feature_content", "columns_author", "columns_author", "columns_photographer", "columns_tagline");
      return $list_searcheable_acf;
    }
    /**
     * [advanced_custom_search search that encompasses ACF/advanced custom fields and taxonomies and split expression before request]
     * @param  [query-part/string]      $where    [the initial "where" part of the search query]
     * @param  [object]                 $wp_query []
     * @return [query-part/string]      $where    [the "where" part of the search query as we customized]
     * see https://vzurczak.wordpress.com/2013/06/15/extend-the-default-wordpress-search/
     * credits to Vincent Zurczak for the base query structure/spliting tags section
     */
    public function advanced_custom_search( $where, &$wp_query ) {
        global $wpdb;

        if ( empty( $where ))
            return $where;

        // get search expression
        $terms = $wp_query->query_vars[ 's' ];

        // explode search expression to get search terms
        $exploded = explode( ' ', $terms );
        if( $exploded === FALSE || count( $exploded ) == 0 )
            $exploded = array( 0 => $terms );

        // reset search in order to rebuilt it as we whish
        $where = '';

        // get searcheable_acf, a list of advanced custom fields you want to search content in
        $list_searcheable_acf = $this->list_searcheable_acf();
        foreach( $exploded as $tag ) :
            $where .= "
              AND (
                ($wpdb->posts.post_title LIKE '%$tag%')
                OR ($wpdb->posts.post_content LIKE '%$tag%')
                OR EXISTS (
                  SELECT * FROM wp_postmeta
                      WHERE post_id = $wpdb->posts.ID
                        AND (";
            foreach ($list_searcheable_acf as $searcheable_acf) :
              if ($searcheable_acf == $list_searcheable_acf[0]):
                $where .= " (meta_key LIKE '%" . $searcheable_acf . "%' AND meta_value LIKE '%$tag%') ";
              else :
                $where .= " OR (meta_key LIKE '%" . $searcheable_acf . "%' AND meta_value LIKE '%$tag%') ";
              endif;
            endforeach;
                $where .= ")
                )
                OR EXISTS (
                  SELECT * FROM wp_comments
                  WHERE comment_post_ID = $wpdb->posts.ID
                    AND comment_content LIKE '%$tag%'
                )
                OR EXISTS (
                  SELECT * FROM $wpdb->terms
                  INNER JOIN $wpdb->term_taxonomy
                    ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id
                  INNER JOIN $wpdb->term_relationships
                    ON $wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id
                  WHERE (
                    taxonomy = 'post_tag'
                        OR taxonomy = 'category'
                        OR taxonomy = 'myCustomTax'
                    )
                    AND object_id = $wpdb->posts.ID
                    AND $wpdb->terms.name LIKE '%$tag%'
                )
            )";
        endforeach;
        return $where;
    }


/**
 * Add an HTML class to MediaElement.js container elements to aid styling.
 *
 * Extends the core _wpmejsSettings object to add a new feature via the
 * MediaElement.js plugin API.
 */
public function example_mejs_add_container_class() {
	if ( ! wp_script_is( 'mediaelement', 'done' ) ) {
		return;
	}
?>
<script>
	(function() {
		var settings = window._wpmejsSettings || {};
		settings.features = settings.features || mejs.MepDefaults.features;
		settings.features.push('exampleclass');
		settings.defaultAudioHeight = "65";

		MediaElementPlayer.prototype.buildexampleclass = function( player ) {
			player.container.addClass( 'columns-mejs-container' );
		};
	})();
</script>
<?php
}



public function custom_class( $classes ) {
    if ( is_page_template( 'searchpage.php' ) ) {
        $classes[] = 'search';
    }
    return $classes;
}


}