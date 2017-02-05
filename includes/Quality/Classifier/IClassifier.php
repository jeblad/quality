<?php

namespace Quality;

/**
 * Interface for action predictors.
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
interface IClassifier {

	/**
	 * Constructor with parameters for the initialization
	 *
	 * @since 0.1
	 *
	 * @param array $opts
	 */
	public function __construct( array $opts );

	/**
	 * Analyze the input according to the previously given parameters.
	 *
	 * @since 0.1
	 *
	 * @param array $input vector to analyze
	 *
	 * @return array of predictions 
	 */
	public function analyze( array $input);
}