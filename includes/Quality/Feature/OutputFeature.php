<?php

namespace Quality\Feature;

use Quality\Sparse\RealSparse;

/**
 * Common methods for feature extractors for parser output.
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
abstract class OutputFeature extends Feature {

	/**
	 * Default constructor
	 */
	public function __construct( array $opts = array() ) {
		parent::__construct( $opts );
	}

	/**
	 * Figure out simplest way to get the output and return it
	 * 
	 * This will optionally save the text to speed up later retrieval
	 *
	 * @since 0.1
	 *
	 * @param array $params
	 *
	 * @return string the found wikitext
	 */
	public function findOutput( array &$params ) {

		if ( array_key_exists( 'output', $params ) ) {
			return $params['output'];
		}
		else {
			$output = null;
			$content = array_key_exists( 'content', $params )
				? $params['content']
				: $params['wikipage']->getContent( \Revision::RAW );
			if ( $content instanceof \WikitextContent ) {
				$output = $content->getParserOutput( $params['wikipage']->getTitle() );
			}
			if ( !is_null( $output ) && array_key_exists( 'cache', $this->opts ) && $this->opts['cache'] === true ) {
				$params['output'] = $output;
			}
			return $output;
		}
	}
}