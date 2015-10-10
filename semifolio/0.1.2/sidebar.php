<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Semifolio
 */
?>
<div class="col-md-4">
	<div id="secondary" class="widget-area" role="complementary">
		<?php
			if ( ! dynamic_sidebar( 'main-sidebar' ) ) : ?>
			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>
			<aside id="archives" class="widget">
			<h2 class="widget-title"><?php _e( 'Archives', 'semifolio' ); ?></h2>
				<ul>
				<?php wp_get_archives( 'type=monthly' ); ?>
				</ul>
			</aside>
			<aside id="meta" class="widget">
			<h2 class="widget-title"><?php _e( 'Meta', 'semifolio' ); ?></h2>
				<ul>
				<?php wp_register(); ?>
			<li>
				<?php wp_loginout(); ?>
			</li>
				<?php wp_meta(); ?>
				</ul>
			</aside>
		<?php endif; ?>
	</div><!-- #secondary -->
</div>
