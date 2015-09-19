<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
$context['comment_form'] = TimberHelper::get_comment_form();
$context['comment_number'] = get_comments_number($post);



$args = array(
	'walker'            => null,
	'max_depth'         => '',
	'style'             => 'ul',
	'callback'          => null,
	'end-callback'      => null,
	'type'              => 'all',
	'reply_text'        => 'Reply',
	'page'              => '',
	'per_page'          => '',
	'avatar_size'       => 32,
	'reverse_top_level' => null,
	'reverse_children'  => '',
	'format'            => 'html5', // or 'xhtml' if no 'HTML5' theme support
	'short_ping'        => false,   // @since 3.6
        'echo'              => false     // boolean, default is true
);

//$context['comments'] = // $comments 

//ChromePhp::log('Commmets', $post->get_comments());


if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}


function doit($comment, $post) {

	$i = get_comment_reply_link( array(), $comment, $post );
	//ChromePhp::log('args', $comment, $post);

	return $i;
	//$count = comments_number( 'no comments', 'one comment', '% comments' );
	//echo "There are". 	get_comments_number( $post_id );;
	//
	//$context = Timber::get_context();
	//Timber::render( 'single-password.twig', $context );
	//
	// previous_comments_link( '&larr; Older comments' ); 
	// next_comments_link( 'Newer comments &rarr;' ); 
}



function wpsites_comment_form_shortcode() {

	$comments_args = array(
			'class_submit'=> 'btn btn-default pull-right clearfix',
	        // change the title of send button 
	        'label_submit'=>'Send',
	        // change the title of the reply section
	        'title_reply'=>'Write a Reply or Comment',
	        // remove "Text or HTML to be displayed after the set of comment fields"
	        'comment_notes_after' => '',
	        // redefine your own textarea (the comment body)
	        'comment_field' => 
	        '<div class="comment-form-comment form-group">

         	<textarea class="form-control" id="comment" name="comment" aria-required="true"></textarea>
         	</div><div class="clearfix"></div>',
	);
// <label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br />
    ob_start();
    comment_form($comments_args);
    $cform = ob_get_contents();
    ob_end_clean();
    return $cform;
} 

// function get_comment_reply_link($data) {
// 	ChromePhp::log('data', $data);
//     //return	get_comment_reply_link( $args, $comment, $post );
// }