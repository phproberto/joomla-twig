<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Plugin.Japp
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

defined('_JEXEC') or die;

JLoader::import('twig.library');

use Joomla\CMS\Factory;
use Phproberto\Joomla\Twig\Plugin\BasePlugin;
use Phproberto\Joomla\Twig\Extension\JApplication;
use Twig\Environment;

/**
 * Plugin to integrate japp extension with twig.
 *
 * @since  1.0.0
 */
class PlgTwigJapp extends BasePlugin
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
		$environment->addExtension(new JApplication);
		$environment->addGlobal('japp', Factory::getApplication());
	}
}
