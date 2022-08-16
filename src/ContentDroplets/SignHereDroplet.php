<?php

namespace BlueSpice\SignHere\ContentDroplets;

use MediaWiki\Extension\ContentDroplets\Droplet\TagDroplet;
use Message;
use RawMessage;

class SignHereDroplet extends TagDroplet {

	/**
	 * @inheritDoc
	 */
	public function getName(): Message {
		return new RawMessage( 'Sign here' );
	}

	/**
	 * @inheritDoc
	 */
	public function getDescription(): Message {
		return new RawMessage( "Sign here description" );
	}

	/**
	 * @inheritDoc
	 */
	public function getIcon(): string {
		return 'signature';
	}

	/**
	 * @inheritDoc
	 */
	public function getRLModule(): string {
		return 'ext.bluespice.signhere.visualEditorTagDefinition';
	}

	/**
	 * @return array
	 */
	public function getCategories(): array {
		return [ 'content' ];
	}

	/**
	 *
	 * @return string
	 */
	protected function getTagName(): string {
		return 'bs:signhere';
	}

	/**
	 * @return array
	 */
	protected function getAttributes(): array {
		return [];
	}

	/**
	 * @return bool
	 */
	protected function hasContent(): bool {
		return false;
	}

	/**
	 * @return string|null
	 */
	public function getVeCommand(): ?string {
		return 'signHereCommand';
	}

}
