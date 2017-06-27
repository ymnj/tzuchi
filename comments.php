<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 */
 
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>
 
<div id="comments" class="comments-area">
 
    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
                printf( _nx( 'One thought on "%2$s"', '%1$s thoughts on "%2$s"', get_comments_number(), 'comments title', 'tzuchi' ),
                    number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </h2>
 
        <ol class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 74,
                ) );
            ?>
        </ol><!-- .comment-list -->
 
        <?php
            // Are there comments to navigate through?
            if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'tzuchi' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'tzuchi' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'tzuchi' ) ); ?></div>
        </nav><!-- .comment-navigation -->
        <?php endif; // Check for comment navigation ?>
 
        <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php _e( 'Comments are closed.' , 'tzuchi' ); ?></p>
        <?php endif; ?>
 
    <?php endif; // have_comments() ?>


 
    <?php 

    $comment_args = array( 'title_reply'=>'Leave a Reply',
                               'fields' => apply_filters( 'comment_form_default_fields', 
                                array(
                                   'author' => '<div class="row"><div class="col-sm-12 col-md-6"><p class="comment-form-author">' . '<i class="glyphicon glyphicon-user" aria-hidden="true"></i><input id="author" name="author" type="text" placeholder="Name *" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p></div>',
                                   'email'  => '<div class="col-sm-12 col-md-6"><p class="comment-form-email">' . '<i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><input id="email" name="email" type="text" placeholder="Email *" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />'.'</p></div></div>', 
                                   'url'    => '' ) ),
                        'comment_field' => '<p class="comment-form-field">' .'<i class="glyphicon glyphicon-pencil" aria-hidden="true"></i><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="Your comments *"></textarea>' . '</p>',
                  'comment_notes_after' => '',
                  'label_submit'      => __( 'Submit Comment' ));

    comment_form($comment_args); ?>
 
</div><!-- #comments -->