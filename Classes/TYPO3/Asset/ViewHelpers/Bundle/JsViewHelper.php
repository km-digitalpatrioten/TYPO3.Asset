<?php
namespace TYPO3\Asset\ViewHelpers\Bundle;

/*                                                                        *
 * This script belongs to the FLOW3 package "Fluid".                      *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 *  of the License, or (at your option) any later version.                *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 *
 * @api
 */
class JsViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {
	/**
	 * @var TYPO3\Asset\Service\AssetService
	 * @Flow\Inject
	 */
	protected $assetService;

	/**
	 * @var string
	 */
	protected $tagName = 'script';

	/**
	 * Initialize arguments
	 *
	 * @return void
	 * @api
	 */
	public function initializeArguments() {
		$this->registerUniversalTagAttributes();
		$this->registerTagAttribute('type', 'string', 'Type of the Script');
		$this->registerTagAttribute('src', 'string', 'Uri to the Script');
	}

	/**
	 * Render the link.
	 *
	 * @param string $name of the Bundle
	 * @return string The rendered link
	 * @api
	 */
	public function render($name) {
		$uris = $this->assetService->getJsBundleUris($name);
		$output = "";
		foreach ($uris as $uri) {
			$this->tag->addAttribute("type", "text/javascript");
			$this->tag->addAttribute("src", $uri);
			$this->tag->forceClosingTag(true);
			$output.= $this->tag->render() . chr(10);
		}
		return $output;
	}
}


?>