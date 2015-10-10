<?php
/**
 * The template for displaying all single posts.
 *
 * @package Semifolio
 */

get_header(); ?>

<?php if ( get_option( 'semifolio_display_popular_post_setting' ) == 1 ) : ?>
<header class="subheader">
	<div class="container"><div class="row"> 
		<div class="col-md-12"> 
		<?php do_action( 'display_popular_post' ); ?>
		</div>
	</div></div>
</header><!-- .entry-header -->
<?php endif; ?>

<?php do_action( 'display_portfolio' ); ?>

<div class="container"><div class="row">
	<div class="col-md-8">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php semifolio_post_nav(); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>
	<?php get_sidebar(); ?>
</div></div>
<?php get_footer(); ?>