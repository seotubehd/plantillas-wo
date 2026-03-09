<?php
/**
 * Plugin para activar automáticamente el tema Plantillas WO
 */
add_action('init', function() {
    $theme_slug = 'plantillas-wo-theme';
    if (get_option('template') !== $theme_slug) {
        update_option('template', $theme_slug);
        update_option('stylesheet', $theme_slug);
        update_option('current_theme', 'Plantillas WO - Premium PSD');
    }
});
