<?php
/**
 * hackathon_theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hackathon_theme
 */

if ( ! function_exists( 'hackathon_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hackathon_theme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on hackathon_theme, use a find and replace
	 * to change 'hackathon_theme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'hackathon_theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'hackathon_theme' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'hackathon_theme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'hackathon_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hackathon_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hackathon_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'hackathon_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hackathon_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'hackathon_theme' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'hackathon_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hackathon_theme_scripts() {

	wp_enqueue_style( 'hackathon_theme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'hackathon_theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'hackathon_theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	//libs

	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri(). '/lib/css/bootstrap.css' );

	wp_enqueue_style( 'theme-icons', get_template_directory_uri(). '/lib/css/themify-icons.css' );

	wp_enqueue_style( 'theme-fonts', get_template_directory_uri(). '/lib/css/dosis-font.css' );

	wp_enqueue_style( 'theme-style', get_template_directory_uri(). '/lib/css/style.css' );


	wp_enqueue_script( 'hackathon_theme-jQuery', get_template_directory_uri() . '/lib/js/jquery.js' );

    wp_enqueue_script( 'bootstrap-script', get_template_directory_uri(). '/lib/js/bootstrap.js' );

    // custom scripts

	wp_enqueue_style( 'hackathon_theme_custom-style', get_template_directory_uri(). '/dist/css/app.css' );

    wp_enqueue_script( 'hackathon_theme-script', get_template_directory_uri(). '/dist/js/app.js' );

}
add_action( 'wp_enqueue_scripts', 'hackathon_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



/**
 *
 * Custom post types
 */

// Register Custom Post Type
function speakers_post_type() {

    $labels = array(
        'name'                  => _x( 'Speakers', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Speaker', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Speaker', 'text_domain' ),
        'name_admin_bar'        => __( 'Post Type', 'text_domain' ),
        'archives'              => __( 'Item Archives', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Speaker:', 'text_domain' ),
        'all_items'             => __( 'All Speakers', 'text_domain' ),
        'add_new_item'          => __( 'Add New Speaker', 'text_domain' ),
        'add_new'               => __( 'New Speaker', 'text_domain' ),
        'new_item'              => __( 'New Item', 'text_domain' ),
        'edit_item'             => __( 'Edit Speaker', 'text_domain' ),
        'update_item'           => __( 'Update Speaker', 'text_domain' ),
        'view_item'             => __( 'View Speaker', 'text_domain' ),
        'search_items'          => __( 'Search speakers', 'text_domain' ),
        'not_found'             => __( 'No speakers found', 'text_domain' ),
        'not_found_in_trash'    => __( 'No speakers found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
        'items_list'            => __( 'Items list', 'text_domain' ),
        'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Speaker', 'text_domain' ),
        'description'           => __( 'Speaker information pages', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'speaker', $args );

}
add_action( 'init', 'speakers_post_type', 0 );

function speaker_social_get_meta( $value ) {
    global $post;

    $field = get_post_meta( $post->ID, $value, true );
    if ( ! empty( $field ) ) {
        return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
    } else {
        return false;
    }
}

function speaker_social_add_meta_box() {
    add_meta_box(
        'speaker_social-speaker-social',
        __( 'speaker social', 'speaker_social' ),
        'speaker_social_html',
        'speaker',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'speaker_social_add_meta_box' );

function speaker_social_html( $post) {
    wp_nonce_field( '_speaker_social_nonce', 'speaker_social_nonce' ); ?>

    <p>Info sociales pour les conferenciers</p>

    <p>
        <label for="speaker_social_facebook"><?php _e( 'Facebook', 'speaker_social' ); ?></label><br>
        <input type="text" name="speaker_social_facebook" id="speaker_social_facebook" value="<?php echo speaker_social_get_meta( 'speaker_social_facebook' ); ?>">
    </p>	<p>
        <label for="speaker_social_twitter"><?php _e( 'Twitter', 'speaker_social' ); ?></label><br>
        <input type="text" name="speaker_social_twitter" id="speaker_social_twitter" value="<?php echo speaker_social_get_meta( 'speaker_social_twitter' ); ?>">
    </p>	<p>
    <label for="speaker_social_linkedin"><?php _e( 'LinkedIn', 'speaker_social' ); ?></label><br>
    <input type="text" name="speaker_social_linkedin" id="speaker_social_linkedin" value="<?php echo speaker_social_get_meta( 'speaker_social_linkedin' ); ?>">
    </p><?php
}

function speaker_social_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! isset( $_POST['speaker_social_nonce'] ) || ! wp_verify_nonce( $_POST['speaker_social_nonce'], '_speaker_social_nonce' ) ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['speaker_social_facebook'] ) )
        update_post_meta( $post_id, 'speaker_social_facebook', esc_attr( $_POST['speaker_social_facebook'] ) );
    if ( isset( $_POST['speaker_social_twitter'] ) )
        update_post_meta( $post_id, 'speaker_social_twitter', esc_attr( $_POST['speaker_social_twitter'] ) );
    if ( isset( $_POST['speaker_social_linkedin'] ) )
        update_post_meta( $post_id, 'speaker_social_linkedin', esc_attr( $_POST['speaker_social_linkedin'] ) );
}
add_action( 'save_post', 'speaker_social_save' );

/**
 * activity post type
 */

// Register Custom Post Type
function events_post_type() {

    $labels = array(
        'name'                  => _x( 'Events', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Event', 'text_domain' ),
        'name_admin_bar'        => __( 'Post Type', 'text_domain' ),
        'archives'              => __( 'Item Archives', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Event:', 'text_domain' ),
        'all_items'             => __( 'All Events', 'text_domain' ),
        'add_new_item'          => __( 'Add New Event', 'text_domain' ),
        'add_new'               => __( 'New Event', 'text_domain' ),
        'new_item'              => __( 'New Item', 'text_domain' ),
        'edit_item'             => __( 'Edit Event', 'text_domain' ),
        'update_item'           => __( 'Update Event', 'text_domain' ),
        'view_item'             => __( 'View Event', 'text_domain' ),
        'search_items'          => __( 'Search events', 'text_domain' ),
        'not_found'             => __( 'No events found', 'text_domain' ),
        'not_found_in_trash'    => __( 'No events found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
        'items_list'            => __( 'Items list', 'text_domain' ),
        'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Event', 'text_domain' ),
        'description'           => __( 'Event information pages', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'event', $args );

}
add_action( 'init', 'events_post_type', 0 );

function event_timing_get_meta( $value ) {
    global $post;

    $field = get_post_meta( $post->ID, $value, true );
    if ( ! empty( $field ) ) {
        return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
    } else {
        return false;
    }
}

function event_timing_add_meta_box() {
    add_meta_box(
        'event_timing-event-timing',
        __( 'Event timing', 'event_timing' ),
        'event_timing_html',
        'event',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'event_timing_add_meta_box' );

function event_timing_html( $post) {
    wp_nonce_field( '_event_timing_nonce', 'event_timing_nonce' ); ?>

    <p>
        <label for="event_timing_date">Date</label><br>
        <input type="date" name="event_timing_date" id="event_timing_date" value="<?php echo event_timing_get_meta( 'event_timing_date' ); ?>">
    </p>	<p>
    <p>
        <label for="event_timing_order"><?php _e( 'order', 'event_timing' ); ?></label><br>
        <input type="text" name="event_timing_order" id="event_timing_order" value="<?php echo event_timing_get_meta( 'event_timing_order' ); ?>">
    </p>	<p>
        <label for="event_timing_start"><?php _e( 'start', 'event_timing' ); ?></label><br>
        <input type="text" name="event_timing_start" id="event_timing_start" value="<?php echo event_timing_get_meta( 'event_timing_start' ); ?>">
    </p>	<p>
    <label for="event_timing_end"><?php _e( 'end', 'event_timing' ); ?></label><br>
    <input type="text" name="event_timing_end" id="event_timing_end" value="<?php echo event_timing_get_meta( 'event_timing_end' ); ?>">
    </p>
    <?php
}

function event_timing_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! isset( $_POST['event_timing_nonce'] ) || ! wp_verify_nonce( $_POST['event_timing_nonce'], '_event_timing_nonce' ) ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['event_timing_date'] ) )
        update_post_meta( $post_id, 'event_timing_date', esc_attr( $_POST['event_timing_date'] ) );
    if ( isset( $_POST['event_timing_order'] ) )
        update_post_meta( $post_id, 'event_timing_order', esc_attr( $_POST['event_timing_order'] ) );
    if ( isset( $_POST['event_timing_start'] ) )
        update_post_meta( $post_id, 'event_timing_start', esc_attr( $_POST['event_timing_start'] ) );
    if ( isset( $_POST['event_timing_end'] ) )
        update_post_meta( $post_id, 'event_timing_end', esc_attr( $_POST['event_timing_end'] ) );
}
add_action( 'save_post', 'event_timing_save' );



/**
 * Contat form hooks
 */

add_filter( 'wpcf7_form_class_attr', 'custom_custom_form_class_attr' );
function custom_custom_form_class_attr( $class ) {
    $class .= ' form-horizontal';
    return $class;
}