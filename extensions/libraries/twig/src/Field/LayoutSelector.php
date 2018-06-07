<?php
/**
 * @package     Phproberto.Joomla-Twig
 * @subpackage  Field
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

namespace Phproberto\Joomla\Twig\Field;

defined('_JEXEC') || die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormHelper;
use Joomla\CMS\HTML\HTMLHelper;

FormHelper::loadFieldClass('groupedlist');

/**
 * Base twig extension plugin.
 *
 * @since  1.0.0
 */
abstract class LayoutSelector extends \JFormFieldGroupedList
{
	/**
	 * Active templates names.
	 *
	 * @var  string
	 */
	protected static $activeTemplates = [];

	/**
	 * Application client id.
	 *
	 * @var  integer
	 */
	protected $clientId;

	/**
	 * Cached groups.
	 *
	 * @var  array
	 */
	protected static $cachedGroups = [];

	/**
	 * Get the list of layout folders.
	 *
	 * @return  array  Key: group name. Value: folder
	 */
	abstract public function layoutFolders() : array;

	/**
	 * Get the active frontend template.
	 *
	 * @return  string
	 */
	protected function activeTemplate() : string
	{
		if (!isset(static::$activeTemplates[$this->clientId]))
		{
			$db = Factory::getDbo();

			$query = $db->getQuery(true)
				->select('template')
				->from($db->qn('#__template_styles'))
				->where('client_id = ' . (int) $this->clientId)
				->where('home = 1');

			$db->setQuery($query);

			static::$activeTemplates[$this->clientId] = (string) $db->loadResult();
		}

		return static::$activeTemplates[$this->clientId];
	}

	/**
	 * Get unique hash for cache.
	 *
	 * @return  string
	 */
	protected function cacheHash() : string
	{
		return md5($this->type . '|' . $this->clientId);
	}

	/**
	 * Method to get the field option groups.
	 *
	 * @return  array  The field option objects as a nested array in groups.
	 *
	 * @throws  UnexpectedValueException
	 */
	protected function getGroups()
	{
		$hash = $this->cacheHash();

		if (!isset(self::$cachedGroups[$hash]))
		{
			self::$cachedGroups[$hash] = $this->loadGroups();
		}

		return self::$cachedGroups[$hash];
	}

	/**
	 * Get available layouts on a folder.
	 *
	 * @param   string  $folder  Folder to check for layouts
	 *
	 * @return  array
	 */
	protected function folderLayouts(string $folder) : array
	{
		$folder = \JPath::clean($folder);

		if (!is_dir($folder))
		{
			return [];
		}

		$layouts = array_map(
			function ($file)
			{
				return [
					basename($file, '.html.twig') => basename($file)
				];
			},
			glob($folder . "/*.html.twig") ?: []
		);

		return $layouts ? call_user_func_array('array_merge', $layouts) : [];
	}

	/**
	 * Load available option groups
	 *
	 * @return  array
	 */
	protected function loadGroups() : array
	{
		$groups = parent::getGroups();
		$added = [];

		foreach ($this->layoutFolders() as $title => $folder)
		{
			$layouts = array_diff_key($this->folderLayouts($folder), $added);

			if (!$layouts)
			{
				continue;
			}

			$groups[$title] = [];

			foreach ($layouts as $layout => $file)
			{
				$groups[$title][] = HTMLHelper::_('select.option', $layout, $layout, 'value', 'text', false);
				$added[$layout] = $file;
			}
		}

		return $groups;
	}

	/**
	 * Method to attach a JForm object to the field.
	 *
	 * @param   SimpleXMLElement  $element  The SimpleXMLElement object representing the `<field>` tag for the form field object.
	 * @param   mixed             $value    The form field value to validate.
	 * @param   string            $group    The field name group control value. This acts as as an array container for the field.
	 *                                      For example if the field has name="foo" and the group value is set to "bar" then the
	 *                                      full field name would end up being "bar[foo]".
	 *
	 * @return  boolean  True on success.
	 *
	 * @see     JFormField::setup()
	 */
	public function setup(\SimpleXMLElement $element, $value, $group = null)
	{
		if (!parent::setup($element, $value, $group))
		{
			return false;
		}

		$this->__set('clientId', (int) $this->getAttribute('clientId', 0));

		return true;
	}
}
