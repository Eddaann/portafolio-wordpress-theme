<?php
/**
 * Funciones del tema hijo de Astra
 */

// 1. Esto asegura que se carguen los estilos del tema padre (Astra)
function astra_child_enqueue_styles() {
	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), '1.0.0', 'all' );
}
add_action( 'wp_enqueue_scripts', 'astra_child_enqueue_styles' );


// 2. Aquí registramos tu Custom Post Type "Proyectos"
function registrar_mis_proyectos() {
    $args = array(
        'public' => true,
        'label'  => 'Proyectos',
        'menu_icon' => 'dashicons-portfolio', // Icono de maletín
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ), // Habilita título, contenido y foto destacada
        'rewrite' => array( 'slug' => 'proyectos' ), // La URL será tusitio.com/proyectos/mi-trabajo
        'show_in_rest' => true, // Importante: Esto activa el editor moderno (Gutenberg)
    );
    register_post_type( 'proyecto', $args );
}

add_action( 'init', 'registrar_mis_proyectos' );

// 3. Shortcode para mostrar galería de proyectos [mis_proyectos]
function shortcode_mis_proyectos() {
    // La consulta a la base de datos
    $args = array(
        'post_type'      => 'proyecto',
        'posts_per_page' => 6, // Traer máximo 6 proyectos
    );
    
    $query = new WP_Query( $args );
    $html = '<div class="proyectos-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">';

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            
            // Aquí construimos cada tarjeta
            $html .= '<div class="proyecto-card" style="border: 1px solid #eee; padding: 15px; border-radius: 8px; text-align: center;">';
            
            // Imagen (si tiene)
            if ( has_post_thumbnail() ) {
                $html .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail( get_the_ID(), 'medium', array('style' => 'width:100%; height:auto; border-radius:4px;') ) . '</a>';
            }
            
            // Título
            $html .= '<h3 style="margin-top: 15px; font-size: 1.2rem;"><a href="' . get_permalink() . '" style="text-decoration:none; color:#333;">' . get_the_title() . '</a></h3>';
            
            $html .= '</div>'; // Cierre de card
        }
        wp_reset_postdata(); // IMPORTANTE: Limpiar la consulta para no romper el resto de la página
    } else {
        $html .= '<p>No hay proyectos todavía.</p>';
    }

    $html .= '</div>'; // Cierre del grid

    return $html;
}
add_shortcode( 'mis_proyectos', 'shortcode_mis_proyectos' );