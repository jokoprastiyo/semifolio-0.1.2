<?php
/**
 * The template for displaying search results pages.
 *
 * @package Semifolio
 */

get_header(); ?>

<?php if ( get_option( 'semifolio_display_popular_post' ) == 1 ) : ?>
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

		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<?php semifolio_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php get_sidebar(); ?>
</div></div>
<?php get_footer(); ?>
