<?php
function starter_theme_import_files() {
    return [
        [
            'import_file_name'             => 'Starter theme demo data import',
            'categories'                   => 'Category',
            'local_import_file'            => trailingslashit( get_template_directory() ) . '/demo-data/content.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . '/demo-data/widgets.wie',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . '/demo-data/customizer.dat',
            'import_preview_image_url'     => get_template_directory_uri() . '/screenshot.php',
            'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'starter_theme' ),
        ],
    ];
}
add_filter( 'pt-ocdi/import_files', 'starter_theme_import_files' );

function starter_theme_after_import() {
    $primary_menu = get_term_by( 'primary-menu', 'Primary Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', ['primary-menu' => $primary_menu->term_id] );

    $front_page = get_page_by_title( 'Home' );
    $blog_page  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page->ID );
    update_option( 'page_for_posts', $blog_page->ID );

}
add_filter( 'pt-ocdi/after_import', 'starter_theme_after_import' );