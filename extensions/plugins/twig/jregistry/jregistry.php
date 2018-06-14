<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Plugin.plg_twig_jregistry
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

defined('_JEXEC') || die;

JLoader::import('twig.library');

use Twig\Environment;
use Phproberto\Joomla\Twig\Plugin\BasePlugin;
use Phproberto\Joomla\Twig\Extension\JRegistry;

/**
 * Plugin to use Joomla Registry class in twig.
 *
 * @since  1.0.0
 */
class PlgTwigJregistry extends BasePlugin
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
		$environment->addExtension(new JRegistry);
	}
}
