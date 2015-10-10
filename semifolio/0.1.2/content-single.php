<?php
/**
 * @package Semifolio
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->
	
<footer class="entry-footer">
	<div class="row">
		<div class="footer-meta">
			<?php if ( 'current_user' ) {
				edit_post_link( __( 'Edit this post', 'semifolio' ), '<span class="fa fa-edit">', '</span>' );
			} ?>
		</div>
	</div>
</footer>

	<div class="entry-content">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="postimg">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php endif; ?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'semifolio' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="row">
			<div class="col-md-6">
				<div class="footer-meta"> 
					<span class="fa fa-user"></span> <?php the_author(); ?> 
				</div>
				<div>
					<span class="fa fa-clock-o"></span> <?php echo get_the_date(); ?>
				</div>				
			</div>
			<div class="col-md-6 footer-meta">
				<div>
					<span class="fa fa-tag"></span> <?php the_category(' &bull;'); ?>
				</div>
				<div>
					 <span class="fa fa-comment"></span> <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?>
				</div>				
			</div>

			<div class="clear"></div>

			<div class="col-md-12">
				<div class="author clearfix">
					 <h3><?php _e( 'About', 'semifolio'); ?> <?php the_author();?> </h3>
					<?php the_author_meta('description'); ?>
				</div>
			</div>

		</div>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
