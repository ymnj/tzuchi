<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package regina-lite
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<?php if ( have_comments() ) : ?>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'regina-lite' ); ?></h2>
		<div class="nav-links">

			<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'regina-lite' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'regina-lite' ) ); ?></div>

		</div><!-- .nav-links -->
	</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>

	<div id="comments-list">
		<h3><?php printf( esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'regina-lite' ) ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?></h3>
		<ul class="comments">
			<?php
			wp_list_comments( array(
				'callback'	=> 'regina_lite_comment',
				'max_depth'	=> 5
			) );
			?>
		</ul><!--/.comments-->
	</div><!--/#comments-list-->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'regina-lite' ); ?></h2>
		<div class="nav-links">

			<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'regina-lite' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'regina-lite' ) ); ?></div>

		</div><!-- .nav-links -->
	</nav><!-- #comment-nav-below -->
	<?php endif; // Check for comment navigation. ?>

<?php endif; // Check for have_comments(). ?>

<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
?>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'regina-lite' ); ?></p>
<?php endif; ?>

<?php
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

if($commenter['comment_author'] != '')
	$name = esc_attr($commenter['comment_author']);
else
	$name = '';

if($commenter['comment_author_email'] != '')
	$email = esc_attr($commenter['comment_author_email']);
else
	$email = '';

if($commenter['comment_author_url'] != '')
	$url = esc_attr($commenter['comment_author_url']);
else
	$url = '';

$fields =  array(
	'author'	=> '<div class="row"><div class="col-md-4"><input placeholder="Name" name="author" type="text" value="' . $name . '" ' . $aria_req . ' /></div>',
	'email'		=> '<div class="col-md-4"><input placeholder="E-mail" name="email" type="email" value="' . $email . '" ' . $aria_req . ' /></div>',
	'url'		=> '<div class="col-md-4"><input placeholder="Website" name="url" type="url" value="' . $url . '" /></div>'
);
if( is_user_logged_in() ) {
	$comment_textarea = '<div class="row"><div class="col-xs-12"><textarea placeholder="Your Comment" name="comment" aria-required="true"></textarea></div></div>';
} else {
	$comment_textarea = '<div class="col-xs-12"><textarea placeholder="Your Comment" name="comment" aria-required="true"></textarea></div></div>';
}
?>
<?php comment_form( array( 'fields' => $fields, 'comment_field' => $comment_textarea, 'id_submit' => 'button', 'label_submit' => esc_attr__( 'Post Comment', 'regina-lite' ), 'title_reply' => esc_attr__( 'Leave a comment', 'regina-lite' ), 'title_reply_to' => esc_attr__( 'Leave a comment to %s', 'regina-lite' ) ) ); ?>