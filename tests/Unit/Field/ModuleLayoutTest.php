<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Unit\Field;

use Phproberto\Joomla\Twig\Field\ModuleLayout;

/**
 * ModuleLayout field test.
 *
 * @since   __DEPLOY_VERSION__
 */
class ModuleLayoutTest extends BaseLayoutFieldTest
{
	/**
	 * cacheHash returns different id for different settings.
	 *
	 * @return  void
	 */
	public function testCacheHashReturnsSameHasForSameXml()
	{
		$field = $this->field('full');
		$field2 = $this->field('full');

		$reflection = new \ReflectionClass($field);
		$method = $reflection->getMethod('cacheHash');
		$method->setAccessible(true);

		$this->assertSame($method->invoke($field), $method->invoke($field2));
	}

	/**
	 * cacheHash returns different hash for different client.
	 *
	 * @return  void
	 */
	public function testCacheHasReturnsDifferentHashForDifferentClient()
	{
		$field = $this->field('full');
		$field2 = $this->field('full-backend');

		$reflection = new \ReflectionClass($field);
		$method = $reflection->getMethod('cacheHash');
		$method->setAccessible(true);

		$this->assertNotSame($method->invoke($field), $method->invoke($field2));
	}

	/**
	 * cacheHash returns different hash for different client.
	 *
	 * @return  void
	 */
	public function testCacheHasReturnsDifferentHashForDifferentModule()
	{
		$field = $this->field('full');
		$field2 = $this->field('latest-full');

		$reflection = new \ReflectionClass($field);
		$method = $reflection->getMethod('cacheHash');
		$method->setAccessible(true);

		$this->assertNotSame($method->invoke($field), $method->invoke($field2));
	}

	/**
	 * layoutFolders returns correct value.
	 *
	 * @return  void
	 */
	public function testLayoutFoldersReturnsCorrectValue()
	{
		$field = $this->field();

		$folders = $field->layoutFolders();

		$this->assertSame(2, count($folders));

		$expected = [
			JPATH_BASE . '/modules/mod_menu/tmpl',
			JPATH_BASE . '/templates/' . self::ACTIVE_TEMPLATE . '/html/mod_menu'
		];

		$this->assertSame($expected, array_values($folders));
	}

	/**
	 * Constructor test.
	 *
	 * @return  void
	 */
	public function testSetupSetsModule()
	{
		$field = $this->field('latest-full');

		$reflection = new \ReflectionClass($field);
		$moduleProperty = $reflection->getProperty('module');
		$moduleProperty->setAccessible(true);

		$this->assertSame('mod_articles_latest', $moduleProperty->getValue($field));
	}

	/**
	 * setup returns false when parent fails.
	 *
	 * @return  void
	 */
	public function testSetupReturnsFalseWhenParentFails()
	{
		$field = new ModuleLayout;

		$this->assertFalse($field->setup(new \SimpleXMLElement('<test name="twig_layout"/>'), 'my-layout'));
	}

	/**
	 * Get the class of the field being tested.
	 *
	 * @return  array
	 */
	protected function fieldClass()
	{
		return ModuleLayout::class;
	}

	/**
	 * Get the sample fields XML strings.
	 *
	 * @return  array
	 */
	protected function sampleFields()
	{
		return [
			'default' => '<field
				name="twig_layout"
				type="twig.modulelayout"
				label="Twig layout"
				module="mod_menu"
				default="default"
				clientId="0"
				description="Twig layout to render"
			/>',
			'full' => '<field
				name="first_layout"
				type="twig.modulelayout"
				label="First layout"
				module="mod_menu"
				default="default"
				clientId="0"
				description="Twig layout to render"
			/>',
			'full-backend' => '<field
				name="second_layout"
				type="twig.modulelayout"
				label="Second layout"
				module="mod_menu"
				default="default"
				clientId="1"
				description="Twig layout to render"
			/>',
			'latest-full' => '<field
				name="third_layout"
				type="twig.modulelayout"
				label="Third layout"
				module="mod_articles_latest"
				default="default"
				clientId="0"
				description="Twig layout to render"
			/>'
		];
	}
}
