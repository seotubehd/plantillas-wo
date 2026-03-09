<?php get_header(); ?>

<section class="hero-section">
    <div class="container">
        <h1>Plantillas PSD de Documentos 100% Editables</h1>
        <p>Descarga al instante pasaportes, DNI, licencias y cédulas en alta resolución (300 DPI).</p>
        <div class="search-box">
            <?php 
            if ( class_exists( 'WooCommerce' ) ) {
                echo get_product_search_form(); 
            }
            ?>
        </div>
    </div>
</section>

<section class="featured-products container">
    <h2 class="section-title">Últimas Plantillas Añadidas</h2>
    <?php 
    if ( class_exists( 'WooCommerce' ) ) {
        echo do_shortcode('[products limit="8" columns="4" orderby="date" order="DESC"]'); 
    } else {
        echo '<p style="text-align:center;">Instala y activa WooCommerce para ver los productos.</p>';
    }
    ?>
</section>

<section class="seo-content container">
    <div class="seo-card">
        <h2>¿Por qué elegir nuestras plantillas PSD?</h2>
        <p>Nuestras plantillas están diseñadas por profesionales de Photoshop para garantizar la máxima calidad. Cada archivo incluye capas organizadas, fuentes originales y guías de corte, permitiéndote editar cada detalle en segundos.</p>
        <ul>
            <li><strong>Capas Inteligentes:</strong> Edita fotos y textos fácilmente.</li>
            <li><strong>Multipaís:</strong> Disponemos de formatos para más de 50 países.</li>
            <li><strong>Pago Seguro:</strong> Aceptamos Criptomonedas y PayPal.</li>
        </ul>
    </div>
</section>

<?php get_footer(); ?>
