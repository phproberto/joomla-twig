<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Field;

use Phproberto\Joomla\Twig\Field\PluginLayout;

/**
 * PluginLayout field test.
 *
 * @since   __DEPLOY_VERSION__
 */
class PluginLayoutTest extends BaseLayoutFieldTest
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
	 * cacheHash returns different hash for different plugin group.
	 *
	 * @return  void
	 */
	public function testCacheHasReturnsDifferentHashForDifferentGroup()
	{
		$field = $this->field();
		$field2 = $this->field('diff-group');

		$reflection = new \ReflectionClass($field);
		$method = $reflection->getMethod('cacheHash');
		$method->setAccessible(true);

		$this->assertNotSame($method->invoke($field), $method->invoke($field2));
	}

	/**
	 * cacheHash returns different hash for different plugin name.
	 *
	 * @return  void
	 */
	public function testCacheHasReturnsDifferentHashForDifferentName()
	{
		$field = $this->field();
		$field2 = $this->field('diff-name');

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
			JPATH_BASE . '/plugins/content/vote/tmpl',
			JPATH_BASE . '/templates/' . \JFactory::getApplication()->getTemplate() . '/html/plugins/content/vote'
		];

		$this->assertSame($expected, array_values($folders));
	}

	/**
	 * Setup sets group and name test.
	 *
	 * @return  void
	 */
	public function testSetupSetsGroupAndName()
	{
		$field = $this->field();

		$reflection = new \ReflectionClass($field);
		$pluginGroupProperty = $reflection->getProperty('pluginGroup');
		$pluginGroupProperty->setAccessible(true);
		$pluginNameProperty = $reflection->getProperty('pluginName');
		$pluginNameProperty->setAccessible(true);

		$this->assertSame('content', $pluginGroupProperty->getValue($field));
		$this->assertSame('vote', $pluginNameProperty->getValue($field));
	}

	/**
	 * setup returns false when parent fails.
	 *
	 * @return  void
	 */
	public function testSetupReturnsFalseWhenParentFails()
	{
		$field = new PluginLayout;

		$this->assertFalse($field->setup(new \SimpleXMLElement('<test name="twig_layout"/>'), 'my-layout'));
	}

	/**
	 * Get the class of the field being tested.
	 *
	 * @return  array
	 */
	protected function fieldClass()
	{
		return PluginLayout::class;
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
				type="twig.pluginlayout"
				label="Twig layout"
				pluginGroup="content"
				pluginName="vote"
				default="default"
				description="Twig layout to render"
			/>',
			'diff-group' => '<field
				name="twig_layout"
				type="twig.pluginlayout"
				label="Twig layout"
				pluginGroup="system"
				pluginName="vote"
				default="default"
				description="Twig layout to render"
			/>',
			'diff-name' => '<field
				name="twig_layout"
				type="twig.pluginlayout"
				label="Twig layout"
				pluginGroup="content"
				pluginName="other"
				default="default"
				description="Twig layout to render"
			/>'
		];
	}
}
