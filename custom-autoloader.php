<?php
/**
 * Custom class autoloader for Dbyh theme.
 * Load through composer using `"autoload":{"files":[dbyh-autoloader.php]}`
 *
 * @author Niklas Eliason <niklas@decisiobbyheart.com>
 * @since 5.0
 */

spl_autoload_register(
	function ( $class_name ) {

		// Namespace prefix for the Dbyh classes
		$prefix   = 'Dbyh\\';
		$base_dir = __DIR__ . DIRECTORY_SEPARATOR . 'Dbyh' . DIRECTORY_SEPARATOR;

		// Check if the class uses the Dbyh namespace prefix
		$len = strlen( $prefix );
		if ( strncmp( $prefix, $class_name, $len ) !== 0 ) {
			// Not a class for this autoloader
			return;
		}

		// Get the relative class name
		$relative_class = substr( $class_name, $len );

		// Convert namespace separators to directory separators
		$relative_class = str_replace( '\\', DIRECTORY_SEPARATOR, $relative_class );

		// Separate the directory path and the file name
		$last_separator = strrpos( $relative_class, DIRECTORY_SEPARATOR );
		if ( $last_separator !== false ) {
			$path      = substr( $relative_class, 0, $last_separator );
			$file_name = substr( $relative_class, $last_separator + 1 );
		} else {
			$path      = '';
			$file_name = $relative_class;
		}

		// Convert file and directory names to lowercase and prefix the file with "class-"
		$file_path = $base_dir
			. strtolower( $path )
			. DIRECTORY_SEPARATOR
			. 'class-' . strtolower( $file_name ) . '.php';

		// Check if the file exists, and include it
		if ( file_exists( $file_path ) ) {
			require $file_path;
		} else {
			// Log or debug error for missing class files
			error_log( sprintf( 'Autoloader: File not found for class "%s" at path "%s"', $class_name, $file_path ) );
		}
	}
);
