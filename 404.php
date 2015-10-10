<?php
/**
 * The template for displaying 404 pages (not found).
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

<div class="container"> <div class="row"> 
	<div class="col-md-12">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'semifolio' ); ?></p>
				
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
	</div>
</div></div>
<?php get_footer(); ?>
