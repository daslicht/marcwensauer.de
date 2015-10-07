<?php

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		} );
	return;
}

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

	function __construct() {
		// Automatic feed links
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		// Queue JavaScript files on “wp_enqueue_scripts" hook
    	
		parent::__construct();
	}

	function register_post_types() {
		//this is where you can register custom post types
	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies
	}

	function add_to_context( $context ) {
		$context['foo'] = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::get_context();';
		$context['menu'] = new TimberMenu();
		$context['menu']->current;
		
		$context['site'] = $this;
		$context['title'] = "WELCOME";
		$context['layout'] = "base.twig";


	
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$context['layout'] = "base-ajax.twig";
		}
//

 // $request_url = $_SERVER['REQUEST_URI'];
 // ChromePhp::log('$request_url :',$request_url ); 

 // if($request_url == "/de/kontakt" || $request_url == "/en/contact"  ){
 // 	 ChromePhp::log('kontakt'); 
 // 	// $context['menuitem_active'] = 'menuitem-active';
 // }else{
	// $context['menuitem_active'] = 'menuitem-active';
 // }
/* not ajax, do more.... */
		



		if(is_user_logged_in()) {
			$context['loggedIn'] = 1;
		}else{
			$context['loggedIn'] = 0;
		}
		return $context;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own fuctions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter( 'myfoo', new Twig_Filter_Function( 'myfoo' ) );
		return $twig;
	}

}

new StarterSite();




function add_parent_url_menu_class( $classes = array(), $item = false ) {

ChromePhp::log('$item:',  $item);

ChromePhp::log('$classes:',  $classes);

 // if($item->__title == 'KONTAKT'){
	// $classes[] = 'current-menu-item';
 // }
 // ChromePhp::log('$classes, $item:', $classes, $item);
	// $homepage_url = trailingslashit( get_bloginfo( 'url' ) );
	// ChromePhp::log('request url:', $_SERVER['REQUEST_URI']);
	// ChromePhp::log('current item', $item->slug);	
	// // Exclude 404 and homepage
	// //if( is_404() or $item->url == $homepage_url ) return $classes;
	

	// if ( $_SERVER['REQUEST_URI'] =  '/home-3/') {
	// 	//ChromePhp::log('doit', $_SERVER['REQUEST_URI'], $item->slug);
	// 	// Add the 'parent_url' class
	// 	$classes[] = 'current-menu-item';
	// }

	
	return $classes;
}


add_filter( 'nav_menu_css_class', 'add_parent_url_menu_class', 10, 2 );



function myfoo( $text ) {
	$text .= ' bar!';
	return $text;
}

// Queue JavaScripts
function simpleblog_load_scripts() {
    // Queue JavaScript for threaded comments if enabled
    if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ){
        wp_enqueue_script( 'comment-reply' );    
    }
}

function simpleblog_themesetup() {
    // Queue JavaScript files on “wp_enqueue_scripts" hook
    add_action( 'wp_enqueue_scripts', 'simpleblog_load_scripts' );
}

add_action( 'after_setup_theme', 'simpleblog_themesetup' );

function mytheme_comment($comment, $args, $depth) {

	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);



	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
	?>


	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	

	<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
		
		<?php 
			global $user_ID;
			global $current_user;
			//ChromePhp::log('admin?: ',$user_ID);

			if($user_ID > 0) {
				if($current_user->roles[0] === 'administrator') {
					$is_admin = true;
				}else{
					$is_admin = false;
				}
				//ChromePhp::log('admin?: ', $is_admin );
			}	
		?>
		<!-- EDIT & Permalink (right parts) -->
		<div class="pull-right">
			<?php if($is_admin):?>
				<a href="<?php echo get_edit_comment_link();?>" class="btn-lg"> 
					<span class="glyphicon glyphicon-edit"></span>
				</a>
			<?php endif; ?>
			<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
				# <?php comment_ID() ?>
			</a>
		</div>

		<?php //printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>


		<div class="comment-author vcard">
			<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			<?php //printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
						<?php
				/* Post Date, translators: 1: date, 2: time */
				printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?>
		</div>
		

		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata">
			<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				//printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?>
			</a>
				<?php //edit_comment_link( __( '(Edit)' ), '  ', '' );
			?>
		</div>

		<?php comment_text(); ?>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div> 

	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php

}

