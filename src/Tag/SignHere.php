<?php

namespace BlueSpice\SignHere\Tag;

use MediaWiki\Html\Html;
use MediaWiki\Parser\Parser;
use MediaWiki\Parser\PPFrame;

class SignHere {
	/** @var array */
	protected static $counters = [];

	/**
	 * @param string $input
	 * @param array $args
	 * @param Parser $parser
	 * @param PPFrame $frame
	 * @return string
	 */
	public function render( $input, $args, $parser, $frame ) {
		$cnt = self::$counters[spl_object_id( $parser )] ?? 0;
		self::$counters[spl_object_id( $parser )] = $cnt + 1;

		$parser->getOutput()->addModuleStyles( [ 'ext.blueSpice.signHere.styles' ] );
		$parser->getOutput()->addModules( [ 'ext.blueSpice.signHere' ] );

		$html = Html::rawElement(
			'div',
			[
				'class' => 'bs-signhere',
				'title' => wfMessage( 'bs-signhere-tooltip' )->plain(),
				'data-bs-counter' => $cnt,
				'tabindex' => '0',
				'role' => "button",
				'aria-label' => wfMessage( 'bs-signhere-arialabel' )->plain()
			],
			Html::element(
				'i',
				[
					'class' => 'bs-signhere-icon'
				]
			) . wfMessage( 'bs-signhere-signatures' )->escaped() .
			Html::rawElement(
				'div',
				[
					'class' => 'signhere-alert-message',
					'aria-live' => 'polite',
					'display' => 'hidden'
				]
			)
		);

		return $html;
	}
}
