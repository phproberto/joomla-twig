## Quick start.

While a full documentation is written here is a quick start.  

To start using twig layout you have to include the library call:  

```php
JLoader::import('twig.library');
```

Then you can render any component, module, library, plugin or template layout like:  

### Component view layout  

```php
/**
 * Render a component view layout. This will search for layouts in:
 * - templates/{ACTIVE_TEMPLATE}/html/com_users/login/default.html.twig
 * - components/com_users/views/login/default.html.twig
 */
echo Twig::render('@component/com_users/login/default.html.twig');
```

### Module layout  

```php
/**
 * Render a module layout. This will search for layouts in:
 * - templates/{ACTIVE_TEMPLATE}/html/mod_menu/default.html.twig
 * - modules/mod_menu/tmpl/default.html.twig
 */
echo Twig::render('@module/mod_menu/default.html.twig');
```

### Library layout  

```php
/**
 * Render a library layout. This will search for layouts in:
 * - templates/{ACTIVE_TEMPLATE}/html/libraries/phproberto/default.html.twig
 * - libraries/phproberto/layouts/default.html.twig
 */
echo Twig::render('@library/phproberto/default.html.twig');
```

### Plugin layout  

```php
/**
 * Render a plugin layout. This will search for layouts in:
 * - templates/{ACTIVE_TEMPLATE}/html/plugins/content/joomla/default.html.twig
 * - plugins/content/joomla/tmpl/default.html.twig
 */
echo Twig::render('@plugin/content/joomla/default.html.twig');
```

### Template layout  

```php
/**
 * Render a template layout. This will search for layouts in:
 * - templates/{ACTIVE_TEMPLATE}/html/default.html.twig
 */
echo Twig::render('@template/default.html.twig');
```
