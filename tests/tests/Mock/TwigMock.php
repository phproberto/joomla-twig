<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Mock;

defined('_JEXEC') || die;

use Phproberto\Joomla\Twig\Twig;
use Twig\Loader\LoaderInterface;
use Phproberto\Joomla\Twig\Environment;

/**
 * Twig tests.
 *
 * @since   __DEPLOY_VERSION__
 */
class TwigMock extends \TestCaseDatabase
{
	/**
	 * Create a twig mock.
	 *
	 * @param   LoaderInterface|null  $loader  [description]
	 *
	 * @return  Twig
	 */
	public static function create(LoaderInterface $loader = null)
	{
		$twig = Twig::instance();

		$reflection = new \ReflectionClass($twig);
		$environmentProperty = $reflection->getProperty('environment');
		$environmentProperty->setAccessible(true);
		$environmentProperty->setValue($twig, new Environment($loader));

		return $twig;
	}

	/**
	 * Persist a twig so it's server by Twig:instance
	 *
	 * @param   Twig    $twig  Twig instance to persist
	 *
	 * @return  void
	 */
	public static function setInstance(Twig $twig)
	{
		$reflection = new \ReflectionClass(Twig::class);

		$instanceProperty = $reflection->getProperty('instance');
		$instanceProperty->setAccessible(true);
		$instanceProperty->setValue(Twig::class, $twig);
	}
}
