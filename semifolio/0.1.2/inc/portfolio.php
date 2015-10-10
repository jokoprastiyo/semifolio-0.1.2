<?php
if ( get_option( 'semifolio_display_portfolio_setting' ) == 1 ) :
 
if ( ! function_exists( 'semifolio_portfolio' ) ) :
function semifolio_portfolio() {
?>
<div class="portfolio-home">
	<div class="container"><div class="row">

		<div class="portfolio-box">
			<?php 
				$posttype = get_option( 'semifolio_posttype_portfolio' );
				if ( ! get_option( 'semifolio_posttype_portfolio' ) ) :
					$posttype = 'page';
				endif;
					$args = array( 'post_type' => array( $posttype ), 'posts_per_page' => '7' );
					$loop = new WP_Query( $args );
				if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
			?>
				<div class="col-md-3 col-xs-6">
					<div class="portfolio-thumb">
						<?php if( has_post_thumbnail() ) : ?>

							<div class="folio-pic">
								<div class="folio-overlay">
									<h3> <a href="<?php the_permalink();?>"> <?php the_title(); ?> </a></h3>
								</div>
								<a href="<?php the_permalink();?>"><?php the_post_thumbnail(); ?></a>
							</div>
							
						<?php endif; ?>
					</div>
				</div>
			<?php endwhile; endif; ?>
		</div>
	</div></div>
</div>
<?php
}
endif;
add_action( 'display_portfolio', 'semifolio_portfolio' );
 
endif;
?>