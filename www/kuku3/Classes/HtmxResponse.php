<?php

namespace Kuku3\Classes;

use Flight;
use flight\net\Response;

/**
 * Returns the response in the format that can be picked up by the toast listener.
 */
class HtmxResponse extends Response
{
	/**
	 * Returns the response in the format that can be picked up by the toast listener.
	 *
	 * @param string $message
	 * @param string $level - BS5 toast levels 
	 * @param string $cssTarget - The place HTMX targets the responses
	 * @return void
	 */
	public static function renderNotification(string $message = 'Unknown', string $level = 'success', string $cssTarget = '#flashMsg') {
		if (Flight::request()->getHeader('HX-Request') === 'true') {
			Flight::response()->header('HX-Retarget', $cssTarget);
			echo <<<HTML
				<div class="toast-container position-fixed top-0 end-0 p-3">
					<div class="after-request-toast toast align-items-center text-bg-{$level}" role="alert">
						<div class="d-flex">
							<div class="toast-body">$message</div>
							<button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
						</div>
					</div>
				</div>
			HTML;
		}
	}
}
