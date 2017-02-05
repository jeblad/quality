<?php

/**
 * Initialization file for the Quality library.
 *
 * Documentation:	 		https://www.mediawiki.org/wiki/Extension:Quality
 * Support					https://www.mediawiki.org/wiki/Extension_talk:Quality
 * Source code:				https://gerrit.wikimedia.org/r/gitweb?p=mediawiki/extensions/Quality.git
 *
 * @file
 * @ingroup Quality
 *
 * @licence GNU GPL v2+
 * @author John Erling Blad < jeblad@gmail.com >
 */

$wgQualityFeatures = array(
	'numcategories' => array(
		'feature' => '\Quality\Feature\OutputNumCategoriesFeature',
		'transform' => '\Quality\Transform\Log1pTransform',
		'min'=> 0,
		'max'=> 25,
		'bins' => 25
	),
	'numexternallinks' => array(
		'feature' => '\Quality\Feature\OutputNumExternalLinksFeature',
		'transform' => '\Quality\Transform\Log1pTransform',
		'min'=> 0,
		'max'=> 500,
		'bins' => 25
	),
	'numimages' => array(
		'feature' => '\Quality\Feature\OutputNumImagesFeature',
		'transform' => '\Quality\Transform\Log1pTransform',
		'min'=> 0,
		'max'=> 100,
		'bins' => 25
	),
	'numlinks-valid' => array(
		'feature' => '\Quality\Feature\OutputNumLinksFeature',
		'transform' => '\Quality\Transform\Log1pTransform',
		'subset' => 'valid',
		'min'=> 0,
		'max'=> 100,
		'bins' => 25
	),
	'numlinks-broken' => array(
		'feature' => '\Quality\Feature\OutputNumLinksFeature',
		'transform' => '\Quality\Transform\Log1pTransform',
		'subset' => 'broken',
		'min'=> 0,
		'max'=> 100,
		'bins' => 25
	),
	'knownsections' => array(
		'feature' => '\Quality\Feature\WikitextKnownSectionsFeature',
		'known' => array( 'external links' ),
	),
	'length' => array(
		'feature' => '\Quality\Feature\WikitextLengthFeature',
		'transform' => '\Quality\Transform\Log1pTransform',
		'min'=> 0,
		'max'=> 100000,
		'bins' => 25
	),
	'numsections' => array(
		'feature' => '\Quality\Feature\WikitextNumSectionsFeature',
		'transform' => '\Quality\Transform\Log1pTransform',
		'min'=> 0,
		'max'=> 50,
		'bins' => 25
	),
);

/**
 * This documentation group collects source code files belonging to Quality.
 *
 * @defgroup Quality Quality
 */

/**
 * Tests part of the Quality extension.
 *
 * @defgroup QualityTests QualityTest
 * @ingroup Quality
 * @ingroup Test
 */

define( 'Quality_VERSION', '0.1 alpha' );

// @codeCoverageIgnoreStart
call_user_func( function() {
	require_once __DIR__ . '/Quality.mw.php';
} );
// @codeCoverageIgnoreEnd
