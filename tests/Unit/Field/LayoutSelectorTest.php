<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Unit\Field;

use Phproberto\Joomla\Twig\Tests\Unit\Field\Stubs\SampleField;

/**
 * Base LayoutSelector class test.
 *
 * @since   __DEPLOY_VERSION__
 */
class LayoutSelectorTest extends BaseLayoutFieldTest
{
	/**
	 * activeTemplate returns active template.
	 *
	 * @return  void
	 */
	public function testActiveTemplateReturnsActiveTemplate()
	{
		$field = new SampleField;

		$reflection = new \ReflectionClass($field);
		$method = $reflection->getMethod('activeTemplate');
		$method->setAccessible(true);

		$this->assertSame(\JFactory::getApplication()->getTemplate(), $method->invoke($field));
	}

	/**
	 * getGroups returns cached data.
	 *
	 * @return  void
	 */
	public function testGetGroupsReturnsCachedData()
	{
		$field = new SampleField;

		$reflection = new \ReflectionClass($field);

		$cacheHashMethod = $reflection->getMethod('cacheHash');
		$cacheHashMethod->setAccessible(true);

		$getGroupsMethod = $reflection->getMethod('getGroups');
		$getGroupsMethod->setAccessible(true);

		$hash = $cacheHashMethod->invoke($field);

		$cachedGroups = [$hash => [1, 2, 3]];

		$cachedGroupsProperty = $reflection->getProperty('cachedGroups');
		$cachedGroupsProperty->setAccessible(true);
		$cachedGroupsProperty->setValue($field, $cachedGroups);

		$this->assertSame($cachedGroups[$hash], $getGroupsMethod->invoke($field));
	}

	/**
	 * getGroups calls loadGroups if not cached.
	 *
	 * @return  void
	 */
	public function testGetGroupsCallsLoadGroupsIfNotCached()
	{
		$loadedGroups = [5, 6, 7];

		$field = new SampleField;
		$field->loadGroups = $loadedGroups;

		$reflection = new \ReflectionClass($field);

		$cachedGroupsProperty = $reflection->getProperty('cachedGroups');
		$cachedGroupsProperty->setAccessible(true);
		$cachedGroupsProperty->setValue($field, null);

		$getGroupsMethod = $reflection->getMethod('getGroups');
		$getGroupsMethod->setAccessible(true);

		$this->assertSame($loadedGroups, $getGroupsMethod->invoke($field));
	}

	/**
	 * folderLayouts returns empty array for unexisting folder.
	 *
	 * @return  void
	 */
	public function testFolderLayoutsReturnsEmptyArrayForUnexistingFolder()
	{
		$field = new SampleField;

		$reflection = new \ReflectionClass($field);

		$folderLayoutsMethod = $reflection->getMethod('folderLayouts');
		$folderLayoutsMethod->setAccessible(true);

		$this->assertSame([], $folderLayoutsMethod->invoke($field, JPATH_SITE . '/jooma-twig-testsss'));
	}

	/**
	 * folderLayouts returns layouts in existing folder.
	 *
	 * @return  void
	 */
	public function testFolderLayoutsReturnsLayoutsInExistingFolder()
	{
		$field = new SampleField;

		$reflection = new \ReflectionClass($field);

		$folderLayoutsMethod = $reflection->getMethod('folderLayouts');
		$folderLayoutsMethod->setAccessible(true);

		$expected = [
			'another' => 'another.html.twig',
			'default' => 'default.html.twig'
		];

		$this->assertSame($expected, $folderLayoutsMethod->invoke($field, __DIR__ . '/Stubs/tmpl'));
	}

	/**
	 * loadGroups loads groups.
	 *
	 * @return  void
	 */
	public function testLoadGroupsLoadsGroups()
	{
		$field = new SampleField;
		$reflection = new \ReflectionClass($field);

		$elementProperty = $reflection->getProperty('element');
		$elementProperty->setAccessible(true);
		$elementProperty->setValue($field, new \SimpleXMLElement('<field name="test"/>'));

		$loadGroupsMethod = $reflection->getMethod('loadGroups');
		$loadGroupsMethod->setAccessible(true);

		$expected = [
			'Tests' => [
				(object) [
					'value'   => 'another',
					'text'    => 'another',
					'disable' => false
				],
				(object) [
					'value'   => 'default',
					'text'    => 'default',
					'disable' => false
				]
			]
		];

		$this->assertEquals($expected, $loadGroupsMethod->invoke($field));
	}

	/**
	 * Get the class of the field being tested.
	 *
	 * @return  array
	 */
	protected function fieldClass()
	{
		return SampleField::class;
	}

	/**
	 * Get the sample fields XML strings.
	 *
	 * @return  array
	 */
	protected function sampleFields()
	{
		return [];
	}
}
