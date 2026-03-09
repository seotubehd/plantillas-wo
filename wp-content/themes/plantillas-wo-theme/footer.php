<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-info">
            <h3>Plantillas WO - Premium PSD</h3>
            <p>Especialistas en plantillas PSD editables de alta resolución para documentos internacionales.</p>
        </div>
        <div class="footer-links">
            <h4>Países Populares</h4>
            <ul>
                <?php
                $countries = get_terms( array( 'taxonomy' => 'pais', 'number' => 5 ) );
                foreach ( $countries as $country ) {
                    echo '<li><a href="' . get_term_link( $country ) . '">' . $country->name . '</a></li>';
                }
                ?>
            </ul>
        </div>
        <div class="footer-trust">
            <h4>Garantía de Satisfacción</h4>
            <p>✅ Descarga instantánea tras el pago.</p>
            <p>✅ Soporte técnico 24/7.</p>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Plantillas WO. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
