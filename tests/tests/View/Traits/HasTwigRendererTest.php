<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\View\Traits;

defined('_JEXEC') || die;

use Joomla\CMS\Factory;
use Phproberto\Joomla\Twig\Twig;
use Phproberto\Joomla\Twig\Environment;
use Phproberto\Joomla\Twig\View\Traits\HasTwigRenderer;
use Phproberto\Joomla\Twig\Tests\View\Traits\Stubs\ClassWithTwigRenderer;

/**
 * HasTwigRenderer tests.
 *
 * @since   1.2.0
 */
class HasTwigRendererTest extends \TestCaseDatabase
{
	/**
	 * @test
	 *
	 * @return void
	 */
	public function getOptionReturnsPropertyValue()
	{
		$mock = $this->getMockForTrait(HasTwigRenderer::class);

		$reflection = new \ReflectionClass($mock);
		$optionProperty = $reflection->getProperty('option');
		$optionProperty->setAccessible(true);

		$this->assertNull($optionProperty->getValue($mock));

		$optionProperty->setValue($mock, 'com_6monthswithoutsmoking');

		$this->assertSame('com_6monthswithoutsmoking', $mock->getOption());
	}

	/**
	 * @test
	 *
	 * @return void
	 */
	public function getOptionDefaultsToOptionFromPrefix()
	{
		$mock = $this->getMockForTrait(
			HasTwigRenderer::class,
			[],
			'ContentViewRoberto'
		);

		$reflection = new \ReflectionClass($mock);
		$optionProperty = $reflection->getProperty('option');
		$optionProperty->setAccessible(true);

		$this->assertNull($optionProperty->getValue($mock));

		$this->assertSame('com_content', $mock->getOption());
	}

	/**
	 * @test
	 *
	 * @dataProvider  getOptionFromProviderMethodProvider
	 *
	 * @return void
	 */
	public function getOptionFromPrefixReturnsCorrectValue($class, $expectedOption)
	{
		$mock = $this->getMockForTrait(
			HasTwigRenderer::class,
			[],
			$class
		);

		$this->assertSame($expectedOption, $mock->getOption());
	}

	/**
	 * @test
	 *
	 * @return void
	 */
	public function getOptionFromPrefixReturnsExpecteValueForNamespacedClass()
	{
		$view = new ClassWithTwigRenderer;

		$reflection = new \ReflectionClass($view);
		$method = $reflection->getMethod('getOptionFromPrefix');
		$method->setAccessible(true);

		$this->assertSame('com_tests', $method->invoke($view));
	}

	/**
	 * Data provider to test getOptionFromProviderMethod
	 *
	 * @return  array
	 */
	public function getOptionFromProviderMethodProvider()
	{
		return [
			['ContentViewRoberto', 'com_content'],
			['K2ViewRoberto', 'com_k2'],
			['BannerViewBanner', 'com_banner'],
			['TESTINGViewTest', 'com_testing']
		];
	}
}
