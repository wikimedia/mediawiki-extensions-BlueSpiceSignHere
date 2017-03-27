<?php

namespace BS\SignHere\Hook;

class ParserFirstCallInit {

	/**
	 *
	 * @param \Parser $parser
	 * @return boolean
	 */
	public static function handle( &$parser ) {
		$signHereTag = new \BS\SignHere\Tag\SignHere();
		$parser->setHook( 'signhere', [ $signHereTag, 'render' ] );
		$parser->setHook( 'bs:signhere', [ $signHereTag, 'render' ] );
		return true;
	}
}