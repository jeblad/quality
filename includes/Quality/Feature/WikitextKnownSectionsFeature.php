<?php

namespace Quality\Feature;

use Quality\Sparse\Sparse;

/**
 * Feature extractor for known sections of wikitext.
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
class WikitextKnownSectionsFeature extends WikitextFeature {

	/**
	 * Default constructor
	 */
	public function __construct( array $opts = array() ) {
		parent::__construct( $opts );
	}

	/**
	 * @see IFeature::buildRepresentation
	 */
	public function buildRepresentation( array &$params ) {

		// prerequisite
		$wikitext = $this->findWikitext( $params );
		if ( is_null( $wikitext ) === null ) {
			return null;
		}

		// additional initialization
		if ( !array_key_exists( 'known', $this->opts ) ) {
			$this->opts['known'] = array();
		}

		// build the sparse vector
		$pattern = '/^==\s*([^=]+?)\s*==$/m';
		$this->opts['bins'] = count( $this->opts['known'] );
		$sparse = new Sparse( $this->opts );

		$idx = 0;
		if ( 0 < preg_match_all( $pattern, $wikitext, $matches ) ) {
			foreach ( $this->opts['known'] as $item ) {
				if ( in_array( $item, $matches[1] ) ) {
					$sparse->on($idx);
				}
				$idx++;
			}
		}
		return $sparse->values();
	}

}
