( function ( mw, $, d ) {

	function _sign( pageId, targetCount ) { // eslint-disable-line no-underscore-dangle
		let count = -1;
		const api = new mw.Api();
		api.get( {
			action: 'query',
			pageids: pageId,
			prop: 'revisions',
			rvprop: 'content',
			indexpageids: ''
		} )
			.done( ( resp ) => {
				const pageId = resp.query.pageids[ 0 ]; // eslint-disable-line no-shadow
				const content = resp.query.pages[ pageId ].revisions[ 0 ][ '*' ];
				const newContent = content.replace( /<(bs:)?signhere/g, ( fullMatch ) => {
					count++;

					if ( parseInt( targetCount ) !== count ) {
						return fullMatch;
					}

					return '--~~~~\n\n' + fullMatch;
				} );

				const editPageAPI = new mw.Api();
				editPageAPI.postWithToken( 'csrf', {
					action: 'edit',
					pageid: pageId,
					text: newContent,
					summary: mw.message( 'bs-signhere-edit-summary' ).plain()
				} )
					.done( () => {
						window.location.reload();
						$( '.signhere-alert-message' )[ 0 ].innerHTML = mw.message( 'bs-signhere-anouncement-label' ).plain();
					} );
			} );
	}

	$( d ).on( 'click', '.bs-signhere', function () {
		$( this ).find( '.bs-signhere-icon' ).addClass( 'bs-signhere-spin' );
		_sign( mw.config.get( 'wgArticleId' ), $( this ).data( 'bs-counter' ) );
	} );
	$( d ).on( 'keyup', '.bs-signhere', function ( e ) {
		if ( ( e.key === 'Enter' ) || ( e.key === ' ' ) ) {
			$( this ).find( '.bs-signhere-icon' ).addClass( 'bs-signhere-spin' );
			_sign( mw.config.get( 'wgArticleId' ), $( this ).data( 'bs-counter' ) );
		}
	} );

}( mediaWiki, jQuery, document ) );
