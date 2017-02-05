<?php

namespace Quality\Sparse;

/**
 * Class for sparse vectors implementing real numbers.
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
class RealSparse extends Sparse {

	/**
	 * @var number
	 */
	protected $min;

	/**
	 * @var number
	 */
	protected $max;

	/**
	 * @var function
	 */
	protected $func;

	/**
	 * Default constructor
	 */
	public function __construct( array $opts = array() ) {
		parent::__construct( $opts );
		$this->min = array_key_exists( 'min', $opts )
			? $opts['min']
			: 0;
		$this->max = array_key_exists( 'max', $opts )
			? $opts['max']
			: 1;
		if ( array_key_exists( 'func', $opts ) ) {
			$this->func = $opts['func'];
		}
		if ( isset( $this->func ) ) {
			if ( isset( $this->min ) ) {
				$this->min = $this->func->calc( $this->min );
			}
			if ( isset( $this->max ) ) {
				$this->max = $this->func->calc( $this->max );
			}
		}
	}

	/**
	 * Set a bin to on-state given a real value
	 *
	 * @see Sparse::on
	 *
	 * @since 0.1
	 *
	 * @param mixed $value
	 */
	public function on( $value ) {
		if ( isset( $this->func ) ) {
			$value = $this->func->calc( $value );
		}

		$frac = ($value - $this->min) / ($this->max - $this->min);
		$index = intval( round( $frac * ($this->bins - 1) ) );

		if ( array_key_exists( $index, $this->values ) ) {
			$this->values[$index] = true;
		}
	}

	/**
	 * Set a bin to off-state given a real value
	 *
	 * @see Sparse::off
	 *
	 * @since 0.1
	 *
	 * @param mixed $value
	 */
	public function off( $value ) {
		if ( isset( $this->func ) ) {
			$value = $this->func->calc( $value );
		}

		$frac = ($value - $this->min) / ($this->max - $this->min);
		$index = intval( round( $frac * ($this->bins - 1) ) );

		if ( array_key_exists( $index, $this->values ) ) {
			$this->values[$index] = false;
		}
	}
}
