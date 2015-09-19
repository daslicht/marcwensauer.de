<?php if(have_comments()):?>
  
<!--   <div class="text-center">
    <h5 id="comments-title ">
        There are <?php comments_number( 'no comments', 'one comment', '% comments' ); ?>
    </h5>
    </div> -->
        
<?php endif?>

  

<!-- Comment Navigation -->
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

    <nav id="comment-nav-above" class="comment-pager">

        <div class="col-xs-4 text-center">
            <?php previous_comments_link( '&larr; Older comments' ); ?>
        </div>

        <div class="col-xs-4 text-center">
            There are <?php comments_number( 'no comments', 'one comment', '% comments' ); ?>
        </div>

        <div class="col-xs-4 text-center">
            <?php next_comments_link( 'Newer comments &rarr;' ); ?>
        </div>

    
<!--         <div class="nav-previous" style="float:left; display:inline !important">
            <?php //previous_comments_link( '&larr; Older comments' ); ?>
        </div>
        <div class="nav-next" style="float:right">
            <?php //next_comments_link( 'Newer comments &rarr;' ); ?>
        </div> -->
        <div class="clearfix"></div>
    </nav>
<?php endif; ?>


<ol class="commentlist">
	<!--List Comments-->
	<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
    <?php //wp_list_comments(); ?>
</ol>

<!-- Comment Form -->
<?php //comment_form(); ?>



<!--  -->