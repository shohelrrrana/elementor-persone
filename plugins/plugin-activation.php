<?php
require_once get_template_directory() . '/plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'persone_register_required_plugins' );

function persone_register_required_plugins() {

	$plugins = array(

		array(
			'name'         => 'Elementor', 
			'slug'         => 'elementor', 
			'required'     => true,  
		),

		array(
			'name'         => 'Elementor Persone',
			'slug'         => 'elementor-persone', 
			'source'       => get_template_directory_uri().'/plugins/elementor-persone.zip', 
			'required'     => true, 
			'external_url'       => get_template_directory_uri().'/plugins/elementor-persone.zip', 
		),


		array(
			'name'         => 'One click demo import',
			'slug' => 'one-click-demo-import',
			'required'     => true, 
		),

	);


	$config = array(
		'id'           => 'persone',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
}
