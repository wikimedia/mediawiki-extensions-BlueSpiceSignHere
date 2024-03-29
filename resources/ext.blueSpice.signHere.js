(function (mw, $, d, undefined) {

	function _sign(pageId, targetCount) {
		var count = -1;
		var api = new mw.Api();
		api.get({
			'action': 'query',
			'pageids': pageId,
			'prop': 'revisions',
			'rvprop': 'content',
			'indexpageids': ''
		})
			.done(function (resp, jqXHR) {
				var pageId = resp.query.pageids[0];
				var content = resp.query.pages[pageId].revisions[0]['*'];
				var newContent = content.replace(/<(bs:)?signhere/g, function (fullMatch, group, pos, fullString) {
					count++;

					if ( parseInt( targetCount ) !== count ) {
						return fullMatch;
					}

					return "--~~~~\n\n" + fullMatch;
				});

				var editPageAPI = new mw.Api();
				editPageAPI.postWithToken('csrf', {
					'action': 'edit',
					'pageid': pageId,
					'text': newContent,
					'summary': mw.message('bs-signhere-edit-summary').plain()
				})
					.done(function (resp, jqXHR) {
						window.location.reload();
						$('.signhere-alert-message')[0].innerHTML = mw.message('bs-signhere-anouncement-label').plain();
					});
			});
	}

	$(d).on('click', '.bs-signhere', function () {
		$(this).find('.bs-signhere-icon').addClass('bs-signhere-spin');
		_sign(mw.config.get('wgArticleId'), $(this).data('bs-counter'));
	});
	$(d).on('keyup', '.bs-signhere', function (e) {
		if ((e.keyCode == 13) || (e.keyCode == 32)) {
			$(this).find('.bs-signhere-icon').addClass('bs-signhere-spin');
			_sign(mw.config.get('wgArticleId'), $(this).data('bs-counter'));
		}
	});

})(mediaWiki, jQuery, document);
