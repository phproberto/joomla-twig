<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Plugin.Cache
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

defined('_JEXEC') || die;

JLoader::import('twig.library');

use Joomla\CMS\Factory;
use Phproberto\Joomla\Twig\Plugin\BasePlugin;
use Twig\Environment;
use Twig\Loader\LoaderInterface;
use Twig\Extension\DebugExtension;

/**
 * Plugin to activate twig cache.
 *
 * @since  1.0.0
 */
class PlgTwigCache extends BasePlugin
{
	/**
	 * Triggered before environment has been loaded.
	 *
	 * @param   Environment      $environment  Loaded environment
	 * @param   LoaderInterface  $loader       Loader going to be sent to environment
	 * @param   array            $options      Options to initialise environment
	 *
	 * @return  void
	 */
	public function onTwigBeforeLoad(Environment $environment, LoaderInterface $loader, &$options)
	{
		$options['cache'] = Factory::getConfig()->get('cache_path', JPATH_CACHE) . '/twig';
	}
}
