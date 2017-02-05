<?php

/**
 * Class registration file for the Quality extension.
 *
 * @since 0.1
 *
 * @file
 * @ingroup Quality
 *
 * @licence GNU GPL v2+
 * @author John Erling Blad < jeblad@gmail.com >
 */
return call_user_func( function() {

	// PSR-0 compliant :)

	$classes = array(
		'Quality\Transform\ITransform',
		'Quality\Transform\Log1pTransform',
		'Quality\Transform\IdentityTransform',
		'Quality\Sparse\Sparse',
		'Quality\Sparse\RealSparse',
		'Quality\Classifier\IClassifier',
		'Quality\Feature\Feature',
		'Quality\Feature\WikitextFeature',
		'Quality\Feature\WikitextLengthFeature',
		'Quality\Feature\WikitextNumSectionsFeature',
		'Quality\Feature\WikitextKnownSectionsFeature',
		'Quality\Feature\OutputFeature',
		'Quality\Feature\OutputTextLengthFeature',
		'Quality\Feature\OutputNumLinksFeature',
		'Quality\Feature\OutputNumImagesFeature',
		'Quality\Feature\OutputNumCategoriesFeature',
		'Quality\Feature\OutputNumExternalLinksFeature',
	);

	$paths = array();

	foreach ( $classes as $class ) {
		$path = 'includes/' . str_replace( '\\', '/', $class ) . '.php';

		$paths[$class] = $path;
	}

	return $paths;

} );

