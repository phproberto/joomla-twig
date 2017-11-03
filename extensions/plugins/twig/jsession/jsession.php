<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Plugin.Jsession
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

defined('_JEXEC') or die;

JLoader::import('twig.library');

use Phproberto\Joomla\Twig\Extension\JSession;
use Phproberto\Joomla\Twig\Plugin\BasePlugin;
use Twig\Environment;

/**
 * Plugin to integrate jsession extension with twig.
 *
 * @since  1.0.0
 */
class PlgTwigJsession extends BasePlugin
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
		$environment->addExtension(new JSession);
		$environment->addGlobal('jsession', \JFactory::getSession());
	}
}
