<?php

namespace BlueSpice\SignHere\ContentDroplets;

use MediaWiki\Extension\ContentDroplets\Droplet\TagDroplet;
use MediaWiki\Message\Message;

class SignHereDroplet extends TagDroplet {

	/**
	 * @inheritDoc
	 */
	public function getName(): Message {
		return Message::newFromKey( 'bs-signhere-droplet-name' );
	}

	/**
	 * @inheritDoc
	 */
	public function getDescription(): Message {
		return Message::newFromKey( 'bs-signhere-droplet-description' );
	}

	/**
	 * @inheritDoc
	 */
	public function getIcon(): string {
		return 'droplet-signhere';
	}

	/**
	 * @inheritDoc
	 */
	public function getRLModules(): array {
		return [ 'ext.bluespice.signhere.visualEditorTagDefinition' ];
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
