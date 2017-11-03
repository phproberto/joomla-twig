<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Tests.Unit
 *
 * @copyright  Copyright (C) 2017 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Tests\Unit\Extension;

use Joomla\CMS\Document\Document;
use Phproberto\Joomla\Twig\Extension\JDocument;

/**
 * JDocument extension test.
 *
 * @since   __DEPLOY_VERSION__
 */
class JDocumentTest extends \TestCase
{
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

		$this->extension = new JDocument;
	}

	/**
	 * Test getFunctions returns correct data.
	 *
	 * @return  void
	 */
	public function testGetFunctionsReturnsCorrectData()
	{
		$this->assertEquals(1, count($this->extension->getFunctions()));

		$function = $this->extension->getFunctions()[0];

		$callable = $function->getCallable();
		$this->assertTrue(is_callable($callable));
		$this->assertEquals('jdoc', $function->getName());
		$this->assertEquals(Document::class, $callable[0]);
		$this->assertEquals('getInstance', $callable[1]);
	}

	/**
	 * getName returns correct name.
	 *
	 * @return  void
	 */
	public function testGetNameReturnsCorrectName()
	{
		$this->assertEquals('jdoc', $this->extension->getName());
	}
}
