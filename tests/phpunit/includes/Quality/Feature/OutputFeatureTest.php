<?php

namespace Quality\Test;

use Quality\Feature\OutputFeature;

/**
 * Test Quality\Feature\OutputFeature.
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
class OutputFeatureTest extends \MediaWikiTestCase {

	/**
	 * @dataProvider provideFindOutput
	 */
	public function testFindOutput( $params, $expect ) {
		$stub = $this->getMockForAbstractClass('\Quality\Feature\OutputFeature' );
		$output = $stub->findOutput( $params );
		if ( $output instanceof \ParserOutput ) {
			$this->assertEquals( $expect, preg_replace( '/<!--.*?-->/s', '', $output->getText() ) );
		}
		else {
			$this->assertTrue( is_null( $output ) );
		}
	}

	public static function provideFindOutput() {

		// set up a wikipage
		$item = array();
		$wiki = "'''This''' is a [[test]] for further analysis.\n"
			. "== external ==\n"
			. "[http://example.com example]\n"
			. "[[Category:foo]]\n"
			. "[[Category:bar]]";
		$content = new \WikitextContent( $wiki );
		$wikipage = new \Wikipage( \Title::newFromText( 'WikitextFeatureTest' ) );
		$wikipage->doEditContent( $content, 'test entry' );
		$output = $wikipage->getParserOutput( new \ParserOptions() );
		$html = preg_replace( '/<!--.*?-->/s', '', $output->getText() );

		$data = array(
			array(
				array( 'content' => new \TextContent( '' ) ),
				null
			),
			array(
				array( 'output' => $output ),
				$html
			),
			array(
				array( 'content' => $content, 'wikipage' => $wikipage ),
				$html
			),
			array(
				array( 'wikipage' => $wikipage ),
				$html
			)
		);
		return $data;
	}

}
