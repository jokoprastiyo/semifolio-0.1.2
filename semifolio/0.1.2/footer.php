<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Semifolio
 */
?>

	</div><!-- #content -->
	
<?php if ( get_option( 'semifolio_display_footer_widget' ) == 1 ) : ?>
	<div id="footer-widgets" class="clearfix">
		<?php if ( ! dynamic_sidebar( 'footer-widget' ) ) :
		dynamic_sidebar( 'footer-widget' );
		endif; ?>
	</div>
<?php endif; ?>
	
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container"><div class="row"> 
			<div class="col-md-12">
				<div class="site-info">
				Copyright &copy; <?php echo date('Y');?> <a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> - <?php echo esc_attr( __( 'Proudly powered by', 'semifolio' ) ); ?>
                <a href="<?php echo esc_url( __( '  http://wordpress.org/', 'semifolio' ) ); ?>"><?php printf( __( 'WordPress', 'semifolio' ) ); ?></a>
				</div><!-- .site-info -->
			</div>
		</div> </div>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
