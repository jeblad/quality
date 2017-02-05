<?php

namespace Quality\Feature;

/**
 * Common methods for feature extractors for wikitext.
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
abstract class WikitextFeature extends Feature {

	/**
	 * Default constructor
	 */
	public function __construct( array $opts = array() ) {
		parent::__construct( $opts );
	}

	/**
	 * Figure out simplest way to get the wikitext and return it
	 * 
	 * This will optionally save the text to speed up later retrieval
	 *
	 * @since 0.1
	 *
	 * @param array $params
	 *
	 * @return string the found wikitext
	 */
	public function findWikitext( array &$params ) {

		if ( array_key_exists( 'wikitext', $params ) ) {
			return $params['wikitext'];
		}
		else {
			$wikitext = null;
			$content = array_key_exists( 'content', $params )
				? $params['content']
				: $params['wikipage']->getContent( \Revision::RAW );
			if ( $content instanceof \WikitextContent ) {
				$wikitext = $content->getNativeData();
			}
			if ( !is_null( $wikitext ) && array_key_exists( 'cache', $this->opts ) && $this->opts['cache'] === true ) {
				$params['wikitext'] = $wikitext;
			}
			return $wikitext;
		}
	}
}