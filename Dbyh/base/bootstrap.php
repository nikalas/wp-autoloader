<?php

/* Check if composer autoload file exists.  */
if (! file_exists(get_template_directory() . '/vendor/autoload.php') ) {
    wp_die(
        sprintf(
        // translators: Don't translate %s, it's a placeholder for the code.
            esc_html_x(
                'Error: Autoload file not found, run %s',
                'error message', 
                'dbyh'
            ),
            ': <pre style="font-weight:bold">composer install</pre>'
        )
    );
}

require_once get_template_directory() . '/vendor/autoload.php';
require_once 'helpers.php'; // must be directly after composer autoload

new Dbyh\Utils\Dump_Server();

// new Dbyh\Init\Defines();
// new Dbyh\Init\Site_Settings();
// new Dbyh\Init\Theme_Settings();
// new Dbyh\Init\Widget_Settings();
// new Dbyh\Init\Gutenberg_Settings();

// $meta_factory   = new Dbyh\Base\Factories\Factory('Meta');
// $ajax_factory   = new Dbyh\Base\Factories\Factory('Ajax');
// $entity_factory = new Dbyh\Base\Factories\Factory('Entities');
// $rest_factory   = new Dbyh\Base\Factories\Rest_Factory('Rest');

// new Dbyh\Base\Assets();
// new Dbyh\Base\General();
// new Dbyh\Base\Wrapping();
// new Dbyh\Base\Plugins\Init();
// new Dbyh\Base\Security($rest_factory->get_public_endpoints());
