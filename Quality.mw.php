<?php

/**
 * MediaWiki setup for the Quality extension.
 * The extension should be included via the main entry point, Quality.php.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @since 0.1
 *
 * @file
 * @ingroup Quality
 *
 * @licence GNU GPL v2+
 * @author John Erling Blad < jeblad@gmail.com >
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

global $wgExtensionCredits, $wgExtensionMessagesFiles, $wgAutoloadClasses, $wgHooks;

$wgExtensionCredits['other'][] = include( __DIR__ . '/Quality.credits.php' );

$wgExtensionMessagesFiles['QualityExtension'] = __DIR__ . '/Quality.i18n.php';
$wgExtensionMessagesFiles['QualityExtensionMagic'] = __DIR__ . '/Quality.i18n.magic.php';


// Autoloading
foreach ( include( __DIR__ . '/Quality.classes.php' ) as $class => $file ) {
	$wgAutoloadClasses[$class] = __DIR__ . '/' . $file;
}

/*
if (false &&  defined( 'MW_PHPUNIT_TEST' ) ) {
	$wgAutoloadClasses['Quality\Tests\ArticleLengthTestCase']
		= __DIR__ . '/tests/phpunit/ArticleLengthTestCase.php'; #TODO: Verify this
}
*/
// Register the parser function.
$wgHooks['ParserFirstCallInit'][] = function ( &$parser ) {
	$parser->setFunctionHook( 'quality-measure', '\Quality\ParserFunction::handler', SFH_NO_HASH );
	return true;
};

// Register the magic word.
$wgHooks['MagicWordwgVariableIDs'][] = function ( &$aCustomVariableIds ) {
	$aCustomVariableIds[] = 'quality-measure';
	return true;
};

// Apply the magic word.'
/*
$wgHooks['ParserGetVariableValueSwitch'][] = function ( &$parser, &$cache, &$magicWordId, &$ret ) {
	if( $magicWordId == 'quality-measure' ) {
		ParserFunction::quoteHandler( $parser, '*' );
	}
	return true;
};
*/
// The key is your job identifier (from the Job constructor), the value is your class name
//$wgJobClasses['DelayedValidation'] = 'Citation\DelayedValidationJob';
//$wgJobClasses['ChangeNotification'] = 'Wikibase\ChangeNotificationJob';

/**
 * Hook to add PHPUnit test cases.
 * @see https://www.mediawiki.org/wiki/Manual:Hooks/UnitTestsList
 *
 * @since 0.1
 *
 * @param array $files
 *
 * @return boolean
 */
$wgHooks['UnitTestsList'][]	= function( array &$files ) {
	// @codeCoverageIgnoreStart
	$testFiles = array(
		'Quality/Transform/Log1pTransform',
		'Quality/Transform/IdentityTransform',
		'Quality/Sparse/Sparse',
		'Quality/Sparse/RealSparse',
		'Quality/Feature/Feature',
		'Quality/Feature/WikitextFeature',
		'Quality/Feature/WikitextLengthFeature',
		'Quality/Feature/WikitextNumSectionsFeature',
		'Quality/Feature/WikitextKnownSectionsFeature',
		'Quality/Feature/OutputFeature',
		'Quality/Feature/OutputTextLengthFeature',
		'Quality/Feature/OutputNumLinksFeature',
		'Quality/Feature/OutputNumImagesFeature',
		'Quality/Feature/OutputNumCategoriesFeature',
		'Quality/Feature/OutputNumExternalLinksFeature',
	);

	foreach ( $testFiles as $file ) {
		$files[] = __DIR__ . '/tests/phpunit/includes/' . $file . 'Test.php';
	}

	return true;
	// @codeCoverageIgnoreEnd
};
