<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Plugin.Cache
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

defined('_JEXEC') || die;

JLoader::import('twig.library');

use Joomla\CMS\Factory;
use Phproberto\Joomla\Twig\Plugin\BasePlugin;
use Twig\Environment;
use Twig\Loader\LoaderInterface;

/**
 * Plugin to activate twig cache.
 *
 * @since  1.0.0
 */
class PlgTwigCache extends BasePlugin
{
	/**
	 * Cache status inherited.
	 *
	 * @const
	 * @since  1.1.0
	 */
	const STATUS_INHERITED = 0;

	/**
	 * Cache status enabled.
	 *
	 * @const
	 * @since  1.1.0
	 */
	const STATUS_ENABLED = 1;

	/**
	 * Cache status disabled.
	 *
	 * @const
	 * @since  1.1.0
	 */
	const STATUS_DISABLED = 2;

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
		if (!$this->isEnabled())
		{
			return;
		}

		$cacheFolder = Factory::getConfig()->get('cache_path', JPATH_CACHE) . '/twig';

		if ($cacheFolder !== JPATH_CACHE)
		{
			$cacheFolder .= '/' . (Factory::getApplication()->isSite() ? 'site' : 'admin');
		}

		$options['cache'] = $cacheFolder;
	}

	/**
	 * Check if the cache is enabled.
	 *
	 * @return  boolean
	 *
	 * @since   1.1.0
	 */
	private function isEnabled()
	{
		$status = (int) $this->params->get('enabled', 0);

		if (self::STATUS_INHERITED === $status)
		{
			return (0 !== (int) Factory::getConfig()->get('caching'));
		}

		return $status === self::STATUS_ENABLED;
	}
}
