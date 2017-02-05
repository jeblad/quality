<?php

namespace Quality\Test;

use Quality\Feature\WikitextFeature;

/**
 * Test Quality\Feature\WikitextFeature.
 *
 * @file
 * @since 0.1
 *
 * @ingroup QualityTest
 * @ingroup Test
 *
 * @group Database
 * @group Quality
 * @group QualityFeature
 *
 * @licence GNU GPL v2+
 * @author John Erling Blad < jeblad@gmail.com >
 *
 */
class WikitextFeatureTest extends \MediaWikiTestCase {

	/**
	 * @dataProvider provideFindWikitext
	 */
	public function testFindWikitext( $params, $expect ) {
		$stub = $this->getMockForAbstractClass('\Quality\Feature\WikitextFeature' );
		$this->assertEquals( $expect, $stub->findWikitext( $params ) );
	}

	public static function provideFindWikitext() {

		// set up a wikipage
		$item = array();
		$content = new \WikitextContent( "foo\n[[test]]\nbar" );
		$wikipage = new \Wikipage( \Title::newFromText( 'WikitextFeatureTest' ) );
		$wikipage->doEditContent( $content, 'test entry' );

		$data = array(
			array(
				array( 'wikitext' => '' ),
				'',
			),
			array(
				array( 'wikitext' => "foo\n[[test]]\nbar\n" ),
				"foo\n[[test]]\nbar\n",
			),
			array(
				array( 'content' => new \WikitextContent( '' ) ),
				'',
			),
			array(
				array( 'content' => new \WikitextContent( 'foo bar' ) ),
				'foo bar',
			),
			array(
				array( 'content' => new \TextContent( '' ) ),
				null,
			),
			array(
				array( 'content' => $content ),
				"foo\n[[test]]\nbar",
			),
			array(
				array( 'wikipage' => $wikipage ),
				"foo\n[[test]]\nbar"
			)
		);
		return $data;
	}

}
