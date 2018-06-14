<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Extension;

use Joomla\CMS\Helper\ModuleHelper;
use Phproberto\Joomla\Twig\Extension\JModuleHelper;

/**
 * JModuleHelper extension test.
 *
 * @since   __DEPLOY_VERSION__
 */
class JModuleHelperTest extends \TestCase
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

		$this->extension = new JModuleHelper;
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
	 * getName returns correct name.
	 *
	 * @return  void
	 */
	public function testGetNameReturnsCorrectName()
	{
		$this->assertEquals('jmodule', $this->extension->getName());
	}

	/**
	 * Functions expected to be added by the extension.
	 *
	 * @return  array
	 */
	protected function expectedFunctions()
	{
		return [
			'jmodule_get_module' => [
				'class'  => ModuleHelper::class,
				'method' => 'getModule'
			],
			'jmodule_get_modules' => [
				'class'  => ModuleHelper::class,
				'method' => 'getModules'
			],
			'jmodule_render_module' => [
				'class'  => ModuleHelper::class,
				'method' => 'renderModule'
			],
			'jmodule_module_cache' => [
				'class'  => ModuleHelper::class,
				'method' => 'moduleCache'
			]
		];
	}
}
