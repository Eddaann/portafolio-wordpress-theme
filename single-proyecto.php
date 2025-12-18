<?php
/**
 * Plantilla personalizada para "Proyectos"
 */
get_header(); ?>

<div class="container" style="max-width: 800px; margin: 40px auto; padding: 20px;">
    
    <h1 style="text-align: center; color: #333;"><?php the_title(); ?></h1>
    
    <p style="text-align: center; color: #666;">Desarrollo Web / Laravel</p>

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="proyecto-imagen" style="margin: 20px 0; border: 1px solid #ddd; padding: 5px;">
            <?php the_post_thumbnail( 'large', array( 'style' => 'width: 100%; height: auto;' ) ); ?>
        </div>
    <?php endif; ?>

    <div class="proyecto-contenido" style="font-size: 1.1rem; line-height: 1.6;">
        <?php the_content(); ?>
    </div>

    <div style="margin-top: 40px; text-align: center;">
        <a href="<?php echo home_url(); ?>" style="background: #333; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">← Volver al inicio</a>
    </div>

</div>

<?php get_footer(); ?>