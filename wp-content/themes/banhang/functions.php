<?php


function initTheme()
{
    
	// Chuyển trình soạn thảo về văn bản cũ
	add_filter('use)_block_editor_for_post', '__return_false');
    add_theme_support( 'menus' );
	// Đăng ký menu cho website
	register_nav_menu('header-top', __('Menu top'));
	register_nav_menu('header-main', __('Menu chính'));
	register_nav_menu('footer-menu', __('Menu footer'));

	// Đăng ký sidebar cho website
	if (function_exists('register_sidebar')) {
		register_sidebar(array(
			'name' => 'Cột bên',
			'id' => 'sidebar',
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3><i class="fa fa-bars"></i>',
			'after_title'   => '</h3>',
		));
	}

	// Tính lượt view cho bài viết
	function setpostview($postID)
	{
		$count_key = 'views';
		$count = get_post_meta($postID, $count_key, true);
		if ($count == '') {
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		} else {
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}
	function getpostviews($postID)
	{
		$count_key = 'views';
		$count = get_post_meta($postID, $count_key, true);
		if ($count == '') {
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return "0";
		}
		return $count;
	}
}

add_action('init', 'initTheme');

// Tạo slider post type
function slider_post_type()
{
	/*
     * Biến $label để chứa các text liên quan đến tên hiển thị của Post Type trong Admin
     */
	$label = array(
		'name' => 'Ảnh slider', //Tên post type dạng số nhiều
		'singular_name' => 'Ảnh slider' //Tên post type dạng số ít
	);

	/*
     * Biến $args là những tham số quan trọng trong Post Type
     */
	$args = array(
		'labels' => $label, //Gọi các label trong biến $label ở trên
		'description' => 'Ảnh slider', //Mô tả của post type
		'supports' => array(
			'title',
			'thumbnail'
		), 
		'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, true thì giống như Page
		'public' => true, //Kích hoạt post type
		'show_ui' => true, //Hiển thị khung quản trị như Post/Page
		'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
		'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
		'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
		'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
		'menu_icon' => 'dashicons-format-gallery', //Đường dẫn tới icon sẽ hiển thị
		'can_export' => true, //Có thể export nội dung bằng Tools -> Export
		'has_archive' => true, //Cho phép lưu trữ (month, date, year)
		'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
		'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
		'capability_type' => 'post' //
	);

	register_post_type('slider', $args); //Tạo post type với slug tên là sanpham và các tham số trong biến $args ở trên

}
add_action('init', 'slider_post_type');

// Sản phẩm giảm giá

function percenSale($price, $price_sale) {
	$sale = ($price_sale * 100) / $price;
	$percent = 100 - $sale;
	return number_format($percent,1);
}
// Add Translation Option
// load_theme_textdomain('wpbootstrap', TEMPLATEPATH.'/languages');
// $locale = get_locale();
// $locale_file = TEMPLATEPATH . "/languages/$locale.php";
// if (is_readable($locale_file) ) { include_once $locale_file;
// }

// // Clean up the WordPress Head
// if(!function_exists("shop_head_cleanup") ) {  
//     function shop_head_cleanup() 
//     {
//         // remove header links
//         remove_action('wp_head', 'feed_links_extra', 3);                    // Category Feeds
//         remove_action('wp_head', 'feed_links', 2);                          // Post and Comment Feeds
//         remove_action('wp_head', 'rsd_link');                               // EditURI link
//         remove_action('wp_head', 'wlwmanifest_link');                       // Windows Live Writer
//         remove_action('wp_head', 'index_rel_link');                         // index link
//         remove_action('wp_head', 'parent_post_rel_link', 10, 0);            // previous link
//         remove_action('wp_head', 'start_post_rel_link', 10, 0);             // start link
//         remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // Links for Adjacent Posts
//         remove_action('wp_head', 'wp_generator');                           // WP version
//     }
// }
// Launch operation cleanup
// add_action('init', 'shop_head_cleanup');



// Remove the […] in a Read More link
if(!function_exists("shop_excerpt_more") ) {  
    function shop_excerpt_more( $more ) 
    {
        global $post;
        return '...  <a href="'. get_permalink($post->ID) . '" class="more-link" title="Read '.get_the_title($post->ID).'">Read more &raquo;</a>';
    }
}
add_filter('excerpt_more', 'shop_excerpt_more');

// Add WP 3+ Functions & Theme Support
if(!function_exists("shop_theme_support") ) {  
    function shop_theme_support() 
    {
        add_theme_support('post-thumbnails');      // wp thumbnails (sizes handled in functions.php)
        set_post_thumbnail_size(125, 125, true);   // default thumb size
        add_theme_support('custom-background');  // wp custom background
        add_theme_support('automatic-feed-links'); // rss

        // Add post format support - if these are not needed, comment them out
        add_theme_support(
            'post-formats',      // post formats
            array( 
            'aside',   // title less blurb
            'gallery', // gallery of images
            'link',    // quick link to other site
            'image',   // an image
            'quote',   // a quick quote
            'status',  // a Facebook like status update
            'video',   // video 
            'audio',   // audio
            'chat'     // chat transcript 
            )
        );  

        add_theme_support('menus');            // wp menus
    
 
	
    }
}
// launching this stuff after theme setup
add_action('after_setup_theme', 'shop_theme_support');

// function shop_main_nav() 
// {
//     // Display the WordPress menu if available
//     wp_nav_menu( 
//         array( 
//         'menu' => 'main_nav', /* menu name */
//         'menu_class' => 'nav navbar-nav',
//         'theme_location' => 'main_nav', /* where in the theme it's assigned */
//         'container' => 'false', /* container class */
//         'fallback_cb' => 'shop_main_nav_fallback', /* menu fallback */
//         'walker' => new Bootstrap_walker()
//         )
//     );
// }

function shop_footer_links() 
{ 
    // Display the WordPress menu if available
    wp_nav_menu(
        array(
        'menu' => 'footer_links', /* menu name */
        'theme_location' => 'footer_links', /* where in the theme it's assigned */
        'container_class' => 'footer-links clearfix', /* container class */
        'fallback_cb' => 'shop_footer_links_fallback' /* menu fallback */
        )
    );
}

// this is the fallback for header menu
function shop_main_nav_fallback() 
{ 
    /* you can put a default here if you like */ 
}

// this is the fallback for footer menu
function shop_footer_links_fallback() 
{ 
    /* you can put a default here if you like */ 
}

// Shortcodes
require_once 'library/shortcodes.php';

// Admin Functions (commented out by default)
// require_once('library/admin.php');         // custom admin functions

// Custom Backend Footer
add_filter('admin_footer_text', 'shop_custom_admin_footer');
function shop_custom_admin_footer() 
{
    echo '<span id="footer-thankyou">Developed by <a href="http://320press.com" target="_blank">320press</a></span>. Built using <a href="http://themble.com/bones" target="_blank">Bones</a>.';
}

// adding it to the admin area
add_filter('admin_footer_text', 'shop_custom_admin_footer');

// Set content width
if (! isset($content_width) ) { $content_width = 580;
}

/*************
 * THUMBNAIL SIZE OPTIONS 
*************/

// // Thumbnail sizes
// add_image_size('wpbs-featured', 780, 300, true);
// add_image_size('wpbs-featured-home', 970, 311, true);
// add_image_size('wpbs-featured-carousel', 970, 400, true);




// // Tạo Sidebar
// function shop_register_sidebars() 
// {
//   /*
//      * Biến $label để chứa các text liên quan đến tên hiển thị của Post Type trong Admin
//      */
// 	$label = array(
// 		'name' => 'Ảnh slider', //Tên post type dạng số nhiều
// 		'singular_name' => 'Ảnh slider' //Tên post type dạng số ít
// 	);

// 	/*
//      * Biến $args là những tham số quan trọng trong Post Type
//      */
// 	$args = array(
// 		'labels' => $label, //Gọi các label trong biến $label ở trên
// 		'description' => 'Ảnh slider', //Mô tả của post type
// 		'supports' => array(
// 			'title',
// 			'thumbnail'
// 		), 
// 		'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, true thì giống như Page
// 		'public' => true, //Kích hoạt post type
// 		'show_ui' => true, //Hiển thị khung quản trị như Post/Page
// 		'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
// 		'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
// 		'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
// 		'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
// 		'menu_icon' => 'dashicons-format-gallery', //Đường dẫn tới icon sẽ hiển thị
// 		'can_export' => true, //Có thể export nội dung bằng Tools -> Export
// 		'has_archive' => true, //Cho phép lưu trữ (month, date, year)
// 		'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
// 		'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
// 		'capability_type' => 'post' //
// 	);

// 	register_post_type('slider', $args); //Tạo post type với slug tên là sanpham và các tham số trong biến $args ở trên

// } // don't remove this bracket!
// add_action('init', 'shop_register_sidebars');

        
// Tạo comment
function shop_comments($comment, $args, $depth) 
{
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?>>
        <article id="comment-<?php comment_ID(); ?>" class="clearfix">
            <div class="comment-author vcard clearfix">
                <div class="avatar col-sm-3">
        <?php echo get_avatar($comment, $size = '75'); ?>
                </div>
                <div class="col-sm-9 comment-text">
        <?php printf('<h4>%s</h4>', get_comment_author_link()) ?>
        <?php edit_comment_link(__('Edit', 'wpbootstrap'), '<span class="edit-comment btn btn-sm btn-info"><i class="glyphicon-white glyphicon-pencil"></i>', '</span>') ?>
                    
                    <?php if ($comment->comment_approved == '0') : ?>
                           <div class="alert-message success">
                          <p><?php _e('Your comment is awaiting moderation.', 'wpbootstrap') ?></p>
                          </div>
                    <?php endif; ?>
                    
                    <?php comment_text() ?>
                    
                    <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
                    
        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>
            </div>
        </article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

// Display trackbacks/pings callback function
function list_pings($comment, $args, $depth) 
{
       $GLOBALS['comment'] = $comment;
?>
        <li id="comment-<?php comment_ID(); ?>"><i class="icon icon-share-alt"></i>&nbsp;<?php comment_author_link(); ?>
<?php 

}

/*************
 * SEARCH FORM LAYOUT 
*****************/

/******************
 * password protected post form 
*****/

add_filter('the_password_form', 'shop_custom_password_form');

function shop_custom_password_form() 
{
    global $post;
    $label = 'pwbox-'.( empty($post->ID) ? rand() : $post->ID );
    $o = '<div class="clearfix"><form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
	' . '<p>' . __("This post is password protected. To view it please enter your password below:", 'wpbootstrap') . '</p>' . '
	<label for="' . $label . '">' . __("Password:", 'wpbootstrap') . ' </label><div class="input-append"><input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" class="btn btn-primary" value="' . esc_attr__("Submit", 'wpbootstrap') . '" /></div>
	</form></div>
	';
    return $o;
}

/***********
 * update standard wp tag cloud widget so it looks better 
************/

add_filter('widget_tag_cloud_args', 'shop_my_widget_tag_cloud_args');

function shop_my_widget_tag_cloud_args( $args ) 
{
    $args['number'] = 20; // show less tags
    $args['largest'] = 9.75; // make largest and smallest the same - i don't like the varying font-size look
    $args['smallest'] = 9.75;
    $args['unit'] = 'px';
    return $args;
}

// filter tag clould output so that it can be styled by CSS
function shop_add_tag_class( $taglinks ) 
{
    $tags = explode('</a>', $taglinks);
    $regex = "#(.*tag-link[-])(.*)(' title.*)#e";

    foreach( $tags as $tag ) {
        $tagn[] = preg_replace($regex, "('$1$2 label tag-'.get_tag($2)->slug.'$3')", $tag);
    }

    $taglinks = implode('</a>', $tagn);

    return $taglinks;
}

add_action('wp_tag_cloud', 'shop_add_tag_class');

add_filter('wp_tag_cloud', 'shop_wp_tag_cloud_filter', 10, 2);

function shop_wp_tag_cloud_filter( $return, $args )
{
    return '<div id="tag-cloud">' . $return . '</div>';
}

// Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

// Disable jump in 'read more' link
function shop_remove_more_jump_link( $link ) 
{
    $offset = strpos($link, '#more-');
    if ($offset ) {
        $end = strpos($link, '"', $offset);
    }
    if ($end ) {
        $link = substr_replace($link, '', $offset, $end-$offset);
    }
    return $link;
}
add_filter('the_content_more_link', 'shop_remove_more_jump_link');

// Remove height/width attributes on images so they can be responsive
add_filter('post_thumbnail_html', 'shop_remove_thumbnail_dimensions', 10);
add_filter('image_send_to_editor', 'shop_remove_thumbnail_dimensions', 10);

function shop_remove_thumbnail_dimensions( $html ) 
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Add the Meta Box to the homepage template
function shop_add_homepage_meta_box() 
{  
    global $post;

    // Only add homepage meta box if template being used is the homepage template
    // $post_id = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : "");
    $post_id = $post->ID;
    $template_file = get_post_meta($post_id, '_wp_page_template', true);

    if ($template_file == 'page-homepage.php' ) {
        add_meta_box(  
            'homepage_meta_box', // $id  
            'Optional Homepage Tagline', // $title  
            'shop_show_homepage_meta_box', // $callback  
            'page', // $page  
            'normal', // $context  
            'high'
        ); // $priority  
    }
}

add_action('add_meta_boxes', 'shop_add_homepage_meta_box');

// Field Array  
$prefix = 'custom_';  
$custom_meta_fields = array(  
    array(  
        'label'=> 'Homepage tagline area',  
        'desc'  => 'Displayed underneath page title. Only used on homepage template. HTML can be used.',  
        'id'    => $prefix.'tagline',  
        'type'  => 'textarea' 
    )  
);  

// The Homepage Meta Box Callback  
function shop_show_homepage_meta_box() 
{  
    global $custom_meta_fields, $post;

    // Use nonce for verification
    wp_nonce_field(basename(__FILE__), 'wpbs_nonce');
    
    // Begin the field table and loop
    echo '<table class="form-table">';

    foreach ( $custom_meta_fields as $field ) {
        // get value of this field if it exists for this post  
        $meta = get_post_meta($post->ID, $field['id'], true);  
        // begin a table row with  
        echo '<tr> 
              <th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
              <td>';  
              switch($field['type']) {  
                  // text  
        case 'text':  
            echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="60" /> 
                          <br /><span class="description">'.$field['desc'].'</span>';  
            break;
                  
                  // textarea  
        case 'textarea':  
            echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="80" rows="4">'.$meta.'</textarea> 
                          <br /><span class="description">'.$field['desc'].'</span>';  
            break;  
                } //end switch  
                echo '</td></tr>';  
    } // end foreach  
    echo '</table>'; // end table  
}  

// Save the Data  
function shop_save_homepage_meta( $post_id ) 
{  

    global $custom_meta_fields;  
  
    // verify nonce  
    if (!isset($_POST['wpbs_nonce']) || !wp_verify_nonce($_POST['wpbs_nonce'], basename(__FILE__)) ) {  
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type'] ) {
        if (!current_user_can('edit_page', $post_id) ) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id) ) {
        return $post_id;
    }
  
    // loop through fields and save the data  
    foreach ( $custom_meta_fields as $field ) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old ) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    } // end foreach
}
add_action('save_post', 'shop_save_homepage_meta');




add_editor_style('editor-style.css');

function shop_add_active_class($classes, $item) 
{
    if($item->menu_item_parent == 0 && in_array('current-menu-item', $classes) ) {
        $classes[] = "active";
    }
  
    return $classes;
}

// Add Twitter Bootstrap's standard 'active' class name to the active nav link item
add_filter('nav_menu_css_class', 'shop_add_active_class', 10, 2);

// enqueue styles
if(!function_exists("shop_theme_styles") ) {  
    function shop_theme_styles() 
    { 
        wp_register_style('wpbs', get_template_directory_uri() . '/library/dist/css/styles.f6413c85.min.css', array(), '1.0', 'all');
        wp_enqueue_style('wpbs');
        wp_register_style('wpbs-style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0', 'all');
        wp_enqueue_style('wpbs-style');
    }
}
add_action('wp_enqueue_scripts', 'shop_theme_styles');


// Get <head> <title> to behave like other themes
function shop_wp_title( $title, $sep ) 
{
    global $paged, $page;

    if (is_feed() ) {
        return $title;
    }

    // Add the site name.
    $title .= get_bloginfo('name');

    // Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() ) ) {
        $title = "$title $sep $site_description";
    }

    // Add a page number if necessary.
    if ($paged >= 2 || $page >= 2 ) {
        $title = "$title $sep " . sprintf(__('Page %s', 'wpbootstrap'), max($paged, $page));
    }

    return $title;
}
add_filter('wp_title', 'shop_wp_title', 10, 2);

// Related Posts Function (call using shop_related_posts(); )
function shop_related_posts() 
{
    echo '<ul id="bones-related-posts">';
    global $post;
    $tags = wp_get_post_tags($post->ID);
    $tag_arr = "";
    if($tags) {
        foreach($tags as $tag) { $tag_arr .= $tag->slug . ','; 
        }
        $args = array(
          'tag' => $tag_arr,
          'numberposts' => 5, /* you can change this to show more */
          'post__not_in' => array($post->ID)
        );
          $related_posts = get_posts($args);
        if($related_posts) {
            foreach ($related_posts as $post) : setup_postdata($post); ?>
                <li class="related_post"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
            <?php endforeach; 
        } 
        else { ?>
              <li class="no_related_post">No Related Posts Yet!</li>
        <?php }
    }
    wp_reset_query();
    echo '</ul>';
}

// Numeric Page Navi (built into the theme by default)
function shop_page_navi($before = '', $after = '') 
{
    global $wpdb, $wp_query;
    $request = $wp_query->request;
    $posts_per_page = intval(get_query_var('posts_per_page'));
    $paged = intval(get_query_var('paged'));
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;
    if ($numposts <= $posts_per_page ) { return; 
    }
    if(empty($paged) || $paged == 0) {
        $paged = 1;
    }
    $pages_to_show = 7;
    $pages_to_show_minus_1 = $pages_to_show-1;
    $half_page_start = floor($pages_to_show_minus_1/2);
    $half_page_end = ceil($pages_to_show_minus_1/2);
    $start_page = $paged - $half_page_start;
    if($start_page <= 0) {
        $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if(($end_page - $start_page) != $pages_to_show_minus_1) {
        $end_page = $start_page + $pages_to_show_minus_1;
    }
    if($end_page > $max_page) {
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page = $max_page;
    }
    if($start_page <= 0) {
        $start_page = 1;
    }
    
    echo $before.'<ul class="pagination">'."";
    if ($paged > 1) {
        $first_page_text = "&laquo";
        echo '<li class="prev"><a href="'.get_pagenum_link().'" title="' . __('First', 'wpbootstrap') . '">'.$first_page_text.'</a></li>';
    }
    
    $prevposts = get_previous_posts_link(__('&larr; Previous', 'wpbootstrap'));
    if($prevposts) { echo '<li>' . $prevposts  . '</li>'; 
    }
    else { echo '<li class="disabled"><a href="#">' . __('&larr; Previous', 'wpbootstrap') . '</a></li>'; 
    }
  
    for($i = $start_page; $i  <= $end_page; $i++) {
        if($i == $paged) {
            echo '<li class="active"><a href="#">'.$i.'</a></li>';
        } else {
            echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
        }
    }
    echo '<li class="">';
    next_posts_link(__('Next &rarr;', 'wpbootstrap'));
    echo '</li>';
    if ($end_page < $max_page) {
        $last_page_text = "&raquo;";
        echo '<li class="next"><a href="'.get_pagenum_link($max_page).'" title="' . __('Last', 'wpbootstrap') . '">'.$last_page_text.'</a></li>';
    }
    echo '</ul>'.$after."";
}

// Remove <p> tags from around images
function shop_filter_ptags_on_images( $content )
{
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'shop_filter_ptags_on_images');
function woocommerce_template_product_reviews() {
    woocommerce_get_template( 'single-product-reviews.php' );
    }
    add_action( 'woocommerce_after_single_product_summary', 'comments_template', 50 );
?>
