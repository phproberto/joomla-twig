<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Plugin\Stubs;

use Joomla\Registry\Registry;
use Phproberto\Joomla\Twig\Plugin\BasePlugin;

/**
 * Sample plugin to test BasePlugin class.
 *
 * @since   __DEPLOY_VERSION__
 */
class SamplePlugin extends BasePlugin
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->autoloadLanguage = true;

		$config = array();
		$config['name']   = 'Sample';
		$config['type']   = 'System';
		$config['params'] = new Registry;

		$dispatcher = \JEventDispatcher::getInstance();

		// Call the parent constructor
		parent::__construct($dispatcher, $config);
	}
}
