<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Unit\Extension;

use Joomla\CMS\Application\CMSApplication;
use Phproberto\Joomla\Twig\Extension\JApplication;

/**
 * JApplication extension test.
 *
 * @since   __DEPLOY_VERSION__
 */
class JApplicationTest extends \TestCaseDatabase
{
	use Traits\HasFunctions;

	private $extension;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return  void
	 */
	protected function setUp()
	{
		parent::setUp();
		$this->saveFactoryState();
		\JFactory::$session     = $this->getMockSession();
		\JFactory::$config      = $this->getMockConfig();
		\JFactory::$application = $this->getMockCmsApp();

		$this->extension = new JApplication;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @return  void
	 */
	protected function tearDown()
	{
		$this->restoreFactoryState();
		parent::tearDown();
	}

	/**
	 * Test getFunctions returns correct data.
	 *
	 * @return  void
	 */
	public function testGetFunctions()
	{
		$this->genericFunctionsTest();
	}

	/**
	 * getName returns japp.
	 *
	 * @return  void
	 */
	public function testGetNameReturnsJapp()
	{
		$this->assertEquals('japp', $this->extension->getName());
	}

	/**
	 * Functions expected to be added by the extension.
	 *
	 * @return  array
	 */
	protected function expectedFunctions()
	{
		return [
			'japp'        => [
				'class'  => CMSApplication::class,
				'method' => 'getInstance'
			]
		];
	}
}
