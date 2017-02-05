<?php

namespace Quality\Feature;

use Quality\Sparse\RealSparse;

/**
 * Feature extractor for number of links from parser output.
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
class OutputNumLinksFeature extends OutputFeature {

	/**
	 * Default constructor
	 */
	public function __construct( array $opts = array() ) {
		parent::__construct( $opts );
	}

	/**
	 * @see Feature::buildRepresentation
	 */
	public function buildRepresentation( array &$params ) {

		// prerequisite
		$output = $this->findOutput( $params );
		if ( is_null( $output) === null ) {
			return null;
		}

		// build the sparse vector
		$sparse = new RealSparse( $this->opts );
		$filter = function( $data ) { return true; };
		if ( array_key_exists( 'subset', $this->opts ) ) {
			if ( $this->opts['subset'] === 'broken' ) {
				$filter = function( $data ) { return $data === 0; };
			}
			elseif ( $this->opts['subset'] === 'valid' ) {
				$filter = function( $data ) { return $data !== 0; };
			}
		}
		$links = $output->getLinks();
		$sparse->on( array_key_exists( 0, $links )
			? count( array_filter( array_values( $links[0] ), $filter ) )
			: 0
		);
		return $sparse->values();
	}

}
