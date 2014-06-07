<?php
if ( post_password_required() )
	return;
?>


<?php if (  comments_open() ) : ?>
<div class="comments">

	<div class="column">

		<?php if ( have_comments() ) : ?>
			<h3 class="comments-title">
				<?php
					printf( _n( 'One comment on <em>%2$s</em>', '<strong>%1$s</strong> comments on <em>%2$s</em>', get_comments_number(), 'globalreport' ),
						number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
				?>
			</h3>

			<ol class="commentlist">
				<?php wp_list_comments( array( 'callback' => 'globalreport_comment', 'style' => 'ol' ) ); ?>
			</ol><!-- .commentlist -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<div id="comment-nav-below" class="navigation" role="navigation">
				<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'globalreport' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'globalreport' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'globalreport' ) ); ?></div>
			</div>
			<?php endif; // check for comment navigation ?>

			<?php
			/* If there are no comments and comments are closed, let's leave a note.
			 * But we only want the note on posts and pages that had comments in the first place.
			 */
			if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="nocomments"><?php _e( 'Comments are closed.' , 'globalreport' ); ?></p>
			<?php endif; ?>

		<?php endif; // have_comments() ?>

		<?php comment_form(); ?>

	</div><!-- /.column -->

</div><!-- /.comments -->

<?php endif; ?>