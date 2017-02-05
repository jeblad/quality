<?php

namespace Quality\Feature;

/**
 * Abstract base class for feature extractors.
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
abstract class Feature {

	/**
	 * @var array
	 */
	protected $opts;

	/**
	 * Default constructor
	 */
	public function __construct( array $opts = array() ) {
		$this->opts = $opts;
	}

	/**
	 * Add options for use during evaluation
	 *
	 * @since 0.1
	 *
	 * @param array $opts
	 *
	 * @return array the new merged options
	 */
	public function addOptions( array $opts = array() ) {
		if ( !empty( $opts ) ) {
			$this->opts = array_merge( $this->opts, $opts );
		}
		return $this->opts;
	}

	/**
	 * Build a vector representation from supplied $params
	 *
	 * @since 0.1
	 *
	 * @param array &$params
	 *
	 * @return array|number|null an vector of values, a single value or null if unsuccessful
	 */
	abstract public function buildRepresentation( array &$params );
}
