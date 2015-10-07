<?php
/**
 * Template Name: View Posts
 */
?>

<?php
$query = new WP_Query( array(
    'post_type' => 'post',
    'posts_per_page' => '-1',
    'post_status' => array(
        'publish',
        'pending',
        'draft',
        'private',
        'trash'
    )
) );
?>

<table>
 
    <tr>
        <th>Post Title</th>
        <th>Post Excerpt</th>
        <th>Post Status</th>
        <th>Actions</th>
    </tr>
 
    <tr>
    <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

   	<td><?php echo get_the_title(); ?></td>
    <td><?php /*the_excerpt();*/ ?></td>
    <td><?php echo get_post_status( get_the_ID() ) ?></td>
    <?php $edit_post = add_query_arg( 'post', get_the_ID(), get_permalink( 61 + $_POST['_wp_http_referer'] ) ); //+ $_POST['_wp_http_referer']?>
    <td><a href="<?php echo $edit_post; ?>">Edit</a> <a href="#">Delete</a></td>
    </tr>
    <?php endwhile; endif; ?>
 
</table>
