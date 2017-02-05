<?php

namespace Quality\Sparse;

/**
 * Base class for sparse vectors.
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
class Sparse {

	/**
	 * @var number
	 */
	protected $bins;

	/**
	 * @var array
	 */
	protected $values;

	/**
	 * Default constructor
	 */
	public function __construct( array $opts = array() ) {
		$this->bins = array_key_exists( 'bins', $opts )
			? $opts['bins']
			: 2;
		$this->values = array_fill( 0, $this->bins, false );
	}

	/**
	 * Set a bin to on-state
	 *
	 * @since 0.1
	 *
	 * @param mixed $value
	 */
	public function on( $value ) {
		$index = intval( $value );
		if ( array_key_exists( $index, $this->values ) ) {
			$this->values[$index] = true;
		}
	}

	/**
	 * Set a bin to off-state
	 *
	 * @since 0.1
	 *
	 * @param mixed $value
	 */
	public function off( $value ) {
		$index = intval( $value );
		if ( array_key_exists( $index, $this->values ) ) {
			$this->values[$index] = false;
		}
	}

	/**
	 * Set all bins to off-state
	 *
	 * @since 0.1
	 */
	public function allOn() {
		$this->values = array_fill( 0, $this->bins, true );
	}

	/**
	 * Set all bins to off-state
	 *
	 * @since 0.1
	 */
	public function allOff() {
		$this->values = array_fill( 0, $this->bins, false );
	}

	/**
	 * Get values
	 *
	 * @since 0.1
	 *
	 * @return array
	 */
	public function values() {
		return $this->values;
	}
}
