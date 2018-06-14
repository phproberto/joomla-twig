<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Plugin.Jposition
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

defined('_JEXEC') || die;

JLoader::import('twig.library');

use Phproberto\Joomla\Twig\Extension\JModuleHelper;
use Phproberto\Joomla\Twig\Plugin\BasePlugin;
use Twig\Environment;

/**
 * Plugin to use ModuleHelper common functions in twig.
 *
 * @since  1.0.0
 */
class PlgTwigJmodule extends BasePlugin
{
	/**
	 * Triggered after environment has been loaded.
	 *
	 * @param   Environment  $environment  Loaded environment
	 * @param   array        $params       Optional parameters
	 *
	 * @return  void
	 */
	public function onTwigAfterLoad(Environment $environment, $params = [])
	{
		$environment->addExtension(new JModuleHelper);
	}
}
