<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Loader;

use Joomla\Registry\Registry;
use Joomla\CMS\Application\AdministratorApplication;
use Phproberto\Joomla\Twig\Tests\Loader\Stubs\SampleLoader;

/**
 * Base ExtensionLoader class tests.
 *
 * @since   1.1.0
 */
class ExtensionLoaderTest extends BaseExtensionLoaderTest
{
	/**
	 * Construct sets paths.
	 *
	 * @return  void
	 */
	public function testConstructorSetsPaths()
	{
		$loader = new SampleLoader;

		$reflection = new \ReflectionClass($loader);
		$pathsProperty = $reflection->getProperty('paths');
		$pathsProperty->setAccessible(true);

		$paths = $pathsProperty->getValue($loader);

		$this->assertSame(1, count($paths['sample-loader']));
	}

	/**
	 * getBaseAppPath returns correct path.
	 *
	 * @return  void
	 */
	public function testGetBaseAppPathReturnsCorrectPath()
	{
		$loader = new SampleLoader;

		$reflection = new \ReflectionClass($loader);
		$method = $reflection->getMethod('getBaseAppPath');
		$method->setAccessible(true);

		$this->assertSame(JPATH_SITE, $method->invoke($loader));

		\JFactory::$application = new AdministratorApplication($this->getMockInput(), new Registry(['session' => false]));

		$this->assertSame(JPATH_ADMINISTRATOR, $method->invoke($loader));
	}

	/**
	 * nameInExtensionNamespace returns correct value.
	 *
	 * @return  void
	 */
	public function testNameInExtensionNamespaceReturnsCorrectValue()
	{
		$loader = new SampleLoader;

		$reflection = new \ReflectionClass($loader);
		$method = $reflection->getMethod('nameInExtensionNamespace');
		$method->setAccessible(true);

		$this->assertTrue($method->invoke($loader, '@sample-loader/test.html.twig'));
		$this->assertFalse($method->invoke($loader, '@another-namespace/test.html.twig'));
	}

	/**
	 * parseExtensionName returns provided name.
	 *
	 * @return  void
	 */
	public function testParseExtensionNameReturnsProvidedName()
	{
		$loader = new SampleLoader;

		$reflection = new \ReflectionClass($loader);
		$method = $reflection->getMethod('parseExtensionName');
		$method->setAccessible(true);

		$name = '@sample-loader/test.html.twig';

		$this->assertSame($name, $method->invoke($loader, $name));
	}

	/**
	 * findTemplate returns false if name is not in the namespace.
	 *
	 * @return  void
	 */
	public function testFindTemplateReturnsFalseIfNameIsNotInTheNamespace()
	{
		$loader = new SampleLoader;

		$reflection = new \ReflectionClass($loader);
		$method = $reflection->getMethod('findTemplate');
		$method->setAccessible(true);

		$name = '@another-namespace';

		$this->assertFalse($method->invoke($loader, $name));
	}

	/**
	 * findTemplate returns template if found.
	 *
	 * @return  void
	 */
	public function testFindTemplateReturnsTemplateIfFound()
	{
		$loader = new SampleLoader;

		$reflection = new \ReflectionClass($loader);
		$method = $reflection->getMethod('findTemplate');
		$method->setAccessible(true);

		$name = '@sample-loader/default.html.twig';

		$this->assertNotFalse($method->invoke($loader, $name));
	}

	/**
	 * findTemplate throws exception if template not found.
	 *
	 * @return  void
	 *
	 * @expectedException  \Twig_Error_Loader
	 */
	public function testFindTemplateThrowsExceptionIfTemplateNotFound()
	{
		$loader = new SampleLoader;

		$reflection = new \ReflectionClass($loader);
		$method = $reflection->getMethod('findTemplate');
		$method->setAccessible(true);

		$name = '@sample-loader/unexisting.html.twig';

		$this->assertNotFalse($method->invoke($loader, $name));
	}

	/**
	 * findTemplate returns false if template not found and throw is disabled.
	 *
	 * @return  void
	 */
	public function testFindTemplateReturnsFalseIfTemplateNotFoundAndThrowIsDisabled()
	{
		$loader = new SampleLoader;

		$reflection = new \ReflectionClass($loader);
		$method = $reflection->getMethod('findTemplate');
		$method->setAccessible(true);

		$name = '@sample-loader/unexisting.html.twig';

		$this->assertFalse($method->invoke($loader, $name, false));
	}

	/**
	 * findTemplate returns parent findTemplate if parsed name is different than sent name.
	 *
	 * @return  void
	 */
	public function testFindTemplateReturnsParentFindTemplateIfParsedNameIsDifferentThanSentName()
	{
		$name = '@sample-loader/unexisting.html.twig';

		$loader = new SampleLoader;
		$loader->parsedExtensionName = '@sample-loader/tmpl/unexisting.html.twig';

		$reflection = new \ReflectionClass($loader);
		$method = $reflection->getMethod('findTemplate');
		$method->setAccessible(true);

		$this->assertFalse($method->invoke($loader, $name, false));
	}
}

