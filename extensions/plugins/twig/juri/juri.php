<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Plugin.Juri
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

defined('_JEXEC') || die;

JLoader::import('twig.library');

use Joomla\CMS\Uri\Uri;
use Phproberto\Joomla\Twig\Extension\JUri;
use Phproberto\Joomla\Twig\Plugin\BasePlugin;
use Twig\Environment;

/**
 * Plugin to integrate juri extension with twig.
 *
 * @since  1.0.0
 */
class PlgTwigJuri extends BasePlugin
{
	/**
	 * Triggered after environment has been loaded.
	 *
	 * @param   Environment  $environment  Loaded environment
	 * @param   array        $params       Optional parameters
	 *
	 * @return  void
	 */
	public function onTwigAfterLoad(Environment $environment, $params)
	{
		$environment->addExtension(new JUri);
		$environment->addGlobal('juri', Uri::getInstance());
	}
}
