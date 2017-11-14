While a full documentation is written here is a quick start.

## Quick start.

To start using twig layout you have to include the library call:  

```php
JLoader::import('twig.library');
```

Then you can render any layout like:  

```php
/**
 * Render a component view layout. This will search for layouts in:
 * - templates/{ACTIVE_TEMPLATE}/html/com_users/login/default.html.twig
 * - components/com_users/views/login/default.html.twig
 */
echo Twig::render('@component/com_users/login/default.html.twig');

/**
 * Render a module layout. This will search for layouts in:
 * - templates/{ACTIVE_TEMPLATE}/html/mod_menu/default.html.twig
 * - modules/mod_menu/tmpl/default.html.twig
 */
echo Twig::render('@module/mod_menu/default.html.twig');

/**
 * Render a library layout. This will search for layouts in:
 * - templates/{ACTIVE_TEMPLATE}/html/libraries/phproberto/default.html.twig
 * - libraries/phproberto/layouts/default.html.twig
 */
echo Twig::render('@library/phproberto/default.html.twig');

/**
 * Render a plugin layout. This will search for layouts in:
 * - templates/{ACTIVE_TEMPLATE}/html/plugins/content/joomla/default.html.twig
 * - plugins/content/joomla/tmpl/default.html.twig
 */
echo Twig::render('@plugin/content/joomla/default.html.twig');

/**
 * Render a template layout. This will search for layouts in:
 * - templates/{ACTIVE_TEMPLATE}/html/default.html.twig
 */
echo Twig::render('@template/default.html.twig');
```

## Available Twig global variables.

Here is a fast list for now:  

* **japp** - Equivalent to JFactory::getApplication()
* **jdoc** - Equivalent to Factory::getDocument()
* **jlang** - Equivalent to JFactory::getLanguage()
* **jsession** - Equivalent to JFactory::getSession()
* **juser** - Equivalent to JFactory::getUser()
* **juri** - Equivalent to JUri::getInstance()

## Available Joomla! Twig functions.

* **japp()** - Retrieve a specific Joomla application.
* **jdoc()** - Retrieve a specific document type.
* **jhtml()** - Equivalent to JHtml::_()
* **jlang()** - Load active or specific language.
* **jlayout()** - Create an instance of JLayoutFile to use it inside your twig layouts.
* **jlayout_render()** - Equivalent to JLayoutHelper::render()
* **jlayout_debug()** - Equivalent to JLayoutHelper::debug()
* **jposition()** - Render a module position inside your twig layouts.
* **jprofiler()** - JProfiler integration for performance tests.
* **jroute()** - Equivalent to JRoute::_()
* **jtext()** - Equivalent to JText::_()
* **jtext_sprintf()** - Equivalent to JText::sprintf()
* **juri()** - Equivalent to JUri::getInstance()
* **juser()** - Retrieve a specific Joomla user.

## Available Twig filters

* **to_array** - Cast a variable to array
* **unserialize** - Unserialize data. Mainly to deal with session stuff.
