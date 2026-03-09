<?php
/**
 * Functions and definitions for Plantillas WO Theme
 */

function plantillas_wo_setup() {
    // Soporte para WooCommerce
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    
    // Soporte para Títulos dinámicos y Miniaturas
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    
    // Registrar Menús
    register_nav_menus( array(
        'primary' => __( 'Menú Principal', 'plantillas-wo' ),
    ) );
}
add_action( 'after_setup_theme', 'plantillas_wo_setup' );

// Registrar Taxonomía "País" para Productos
function plantillas_wo_register_taxonomies() {
    $labels = array(
        'name'              => _x( 'Países', 'taxonomy general name', 'plantillas-wo' ),
        'singular_name'     => _x( 'País', 'taxonomy singular name', 'plantillas-wo' ),
        'search_items'      => __( 'Buscar Países', 'plantillas-wo' ),
        'all_items'         => __( 'Todos los Países', 'plantillas-wo' ),
        'parent_item'       => __( 'País Padre', 'plantillas-wo' ),
        'parent_item_colon' => __( 'País Padre:', 'plantillas-wo' ),
        'edit_item'         => __( 'Editar País', 'plantillas-wo' ),
        'update_item'       => __( 'Actualizar País', 'plantillas-wo' ),
        'add_new_item'      => __( 'Añadir Nuevo País', 'plantillas-wo' ),
        'new_item_name'     => __( 'Nombre del Nuevo País', 'plantillas-wo' ),
        'menu_name'         => __( 'Países', 'plantillas-wo' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'pais' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'pais', array( 'product' ), $args );
}
add_action( 'init', 'plantillas_wo_register_taxonomies' );

// Cargar Estilos
function plantillas_wo_scripts() {
    wp_enqueue_style( 'plantillas-wo-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'plantillas_wo_scripts' );

/**
 * GENERADOR DE DATOS INICIALES (Se ejecuta una sola vez)
 */
function plantillas_wo_init_data() {
    if ( get_option( 'plantillas_wo_data_imported' ) ) return;

    $paises = array('México', 'España', 'USA', 'Colombia', 'Argentina', 'Chile', 'Perú', 'Ecuador', 'Venezuela', 'Panamá');
    $docs = array('Pasaporte', 'DNI', 'Licencia de Conducir', 'Cédula de Identidad');

    // 1. Crear Países
    foreach ($paises as $pais) {
        if (!term_exists($pais, 'pais')) {
            wp_insert_term($pais, 'pais');
        }
    }

    // 2. Crear Productos de Ejemplo
    for ($i = 1; $i <= 10; $i++) {
        $pais_random = $paises[array_rand($paises)];
        $doc_random = $docs[array_rand($docs)];
        $title = "$doc_random de $pais_random";
        
        $product_id = wp_insert_post(array(
            'post_title'    => $title,
            'post_content'  => "Descarga la mejor plantilla de $title en formato PSD. Este archivo es 100% editable con Adobe Photoshop. Incluye capas organizadas, fuentes originales y resolución de 300 DPI ideal para impresión de alta calidad.",
            'post_status'   => 'publish',
            'post_type'     => 'product',
        ));

        if ($product_id) {
            update_post_meta($product_id, '_price', rand(15, 45));
            update_post_meta($product_id, '_regular_price', rand(15, 45));
            update_post_meta($product_id, '_downloadable', 'yes');
            update_post_meta($product_id, '_virtual', 'yes');
            $term = get_term_by('name', $pais_random, 'pais');
            wp_set_object_terms($product_id, $term->term_id, 'pais');
        }
    }

    update_option( 'plantillas_wo_data_imported', true );
}
add_action( 'init', 'plantillas_wo_init_data' );

/**
 * VENTAS Y CONVERSIÓN: Añadir Trust Badges debajo del botón de compra
 */
function plantillas_wo_trust_badges() {
    echo '<div class="trust-badges-container">
            <p class="trust-title"><span class="dashicons dashicons-lock"></span> Pago Seguro y Descarga Instantánea</p>
            <div class="trust-icons">
                <img src="https://img.icons8.com/color/48/000000/visa.png" alt="Visa" />
                <img src="https://img.icons8.com/color/48/000000/mastercard.png" alt="Mastercard" />
                <img src="https://img.icons8.com/color/48/000000/paypal.png" alt="Paypal" />
                <img src="https://img.icons8.com/color/48/000000/bitcoin.png" alt="Bitcoin" />
            </div>
            <ul class="benefit-list">
                <li>✅ <strong>Acceso Inmediato:</strong> Tras el pago.</li>
                <li>✅ <strong>100% Editable:</strong> Photoshop (PSD).</li>
                <li>✅ <strong>Alta Calidad:</strong> 300 DPI.</li>
            </ul>
          </div>';
}
add_action( 'woocommerce_single_product_summary', 'plantillas_wo_trust_badges', 35 );

/**
 * SEO: Añadir prefijo al título del producto para Google
 */
function plantillas_wo_seo_product_title($title, $id = null) {
    if ( is_product() && in_the_loop() ) {
        return "Plantilla PSD " . $title . " (Editable)";
    }
    return $title;
}
add_filter( 'the_title', 'plantillas_wo_seo_product_title', 10, 2 );
