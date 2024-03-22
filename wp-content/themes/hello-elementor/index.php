<?php
/**
 * The site's entry point.
 *
 * Loads the relevant template part,
 * the loop is executed (when needed) by the relevant template part.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header();

$is_elementor_theme_exist = function_exists( 'elementor_theme_do_location' );

if ( is_singular() ) {
    if ( ! $is_elementor_theme_exist || ! elementor_theme_do_location( 'single' ) ) {
        get_template_part( 'template-parts/single' );
    }
} elseif ( is_archive() || is_home() ) {
    if ( ! $is_elementor_theme_exist || ! elementor_theme_do_location( 'archive' ) ) {
        get_template_part( 'template-parts/archive' );
    }
} elseif ( is_search() ) {
    if ( ! $is_elementor_theme_exist || ! elementor_theme_do_location( 'archive' ) ) {
        get_template_part( 'template-parts/search' );
    }
} else {
    if ( ! $is_elementor_theme_exist || ! elementor_theme_do_location( 'single' ) ) {
        get_template_part( 'template-parts/404' );
    }
}
?>

<div class="contenedor-artistas">
    <div class="artistas-container">
        <?php 
        $artistas_participantes = get_field( 'artistas_participantes' ); 
        if ( $artistas_participantes ) :
            foreach ( $artistas_participantes as $artista ) :
                setup_postdata( $artista ); ?>
                <div class="artista">
                    <h2 class="artista-title"><?php echo get_the_title( $artista ); ?></h2>
                    <div class="artista-image">
                        <?php if ( has_post_thumbnail( $artista->ID ) ) : ?>
                            <a href="<?php the_permalink( $artista->ID ); ?>">
                                <?php echo get_the_post_thumbnail( $artista->ID, 'thumbnail' ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="artista-content">
                        <p><?php the_excerpt(); ?></p>
                        <a href="<?php the_permalink( $artista->ID ); ?>" class="artista-link">Ver más</a>
                    </div>
                </div>
            <?php
            endforeach;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</div>


<?php
get_footer();
?>
