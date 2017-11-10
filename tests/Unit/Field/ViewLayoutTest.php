<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Unit\Field;

use Phproberto\Joomla\Twig\Field\ViewLayout;

/**
 * ViewLayout field test.
 *
 * @since   __DEPLOY_VERSION__
 */
class ViewLayoutTest extends BaseLayoutFieldTest
{
	/**
	 * cacheHash returns different id for different settings.
	 *
	 * @return  void
	 */
	public function testCacheHashReturnsSameHasForSameXml()
	{
		$field = $this->field();
		$field2 = $this->field();

		$reflection = new \ReflectionClass($field);
		$method = $reflection->getMethod('cacheHash');
		$method->setAccessible(true);

		$this->assertSame($method->invoke($field), $method->invoke($field2));
	}

	/**
	 * cacheHash returns different hash for different component.
	 *
	 * @return  void
	 */
	public function testCacheHasReturnsDifferentHashForDifferentComponent()
	{
		$field = $this->field();
		$field2 = $this->field('diff-component');

		$reflection = new \ReflectionClass($field);
		$method = $reflection->getMethod('cacheHash');
		$method->setAccessible(true);

		$this->assertNotSame($method->invoke($field), $method->invoke($field2));
	}

	/**
	 * cacheHash returns different hash for different view name.
	 *
	 * @return  void
	 */
	public function testCacheHasReturnsDifferentHashForDifferentView()
	{
		$field = $this->field();
		$field2 = $this->field('diff-view');

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
			JPATH_BASE . '/components/com_users/views/login/tmpl',
			JPATH_BASE . '/templates/' . \JFactory::getApplication()->getTemplate() . '/html/com_users/login'
		];

		$this->assertSame($expected, array_values($folders));
	}

	/**
	 * Setup sets component and view.
	 *
	 * @return  void
	 */
	public function testSetupSetsComponentAndView()
	{
		$field = $this->field();

		$reflection = new \ReflectionClass($field);
		$componentProperty = $reflection->getProperty('component');
		$componentProperty->setAccessible(true);
		$viewProperty = $reflection->getProperty('view');
		$viewProperty->setAccessible(true);

		$this->assertSame('com_users', $componentProperty->getValue($field));
		$this->assertSame('login', $viewProperty->getValue($field));
	}

	/**
	 * setup returns false when parent fails.
	 *
	 * @return  void
	 */
	public function testSetupReturnsFalseWhenParentFails()
	{
		$field = new ViewLayout;

		$this->assertFalse($field->setup(new \SimpleXMLElement('<test name="twig_layout"/>'), 'my-layout'));
	}

	/**
	 * Get the class of the field being tested.
	 *
	 * @return  array
	 */
	protected function fieldClass()
	{
		return ViewLayout::class;
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
				type="twig.viewlayout"
				label="Twig layout"
				component="com_users"
				view="login"
				default="default"
				description="Twig layout to render"
			/>',
			'diff-component' => '<field
				name="twig_layout"
				type="twig.viewlayout"
				label="Twig layout"
				component="com_phproberto"
				view="login"
				default="default"
				description="Twig layout to render"
			/>',
			'diff-view' => '<field
				name="twig_layout"
				type="twig.viewlayout"
				label="Twig layout"
				component="com_users"
				view="my_view"
				default="default"
				description="Twig layout to render"
			/>'
		];
	}
}
