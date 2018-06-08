## Using Twig in modules

Start using Twig layouts in your modules is easy. And you can even do it on a B/C way!

### Extending BaseTwigModule

Joomla-twig provides a base module that you can extend and have your twig module working in minutes.

Let's imagine that we want to create a module named `mod_phproberto_login` and we want it to use Twig layouts for it.

Our module final folder structure would be something like:  

```
* mod_phproberto_login
    * language
        * en-GB
    * src
        * LoginModule.php
    * tmpl
        * default.html.twig
        * logout.html.twig
    * mod_phproberto_login.xml
    * mod_phproberto_login.php
```

Most of that structure will be already familiar for you. The only differences are:

* `src` : The folder where our module class will reside. Joomla provides a base class to render almost everything except for modules. Joomla-twig gives you a nice base class to start with.
* `tmpl`: Inside the tmpl folder we have files with the `.html.twig` extension. Those files are the twig layouts that we will use instead of our traditional php layouts.

The first thing we will do is to create the content of the module entry point. That's the `mod_phproberto_login.php` file:

```php
<?php
/**
 * @package     Phproberto.Module
 * @subpackage  Site.mod_phproberto.login
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

defined('_JEXEC') || die;

// This will allow that we start using our namespaced classes
$loader = new \Composer\Autoload\ClassLoader;
$loader->setPsr4('Phproberto\\Joomla\\Module\\Site\\Login\\', __DIR__ . '/src');
$loader->register(true);

use Phproberto\Joomla\Module\Site\Login\LoginModule;

$modInstance = new LoginModule($params, $module);

$layout = '@module/mod_phproberto_login/' . $params->get('layout', 'default') . '.html.twig';

echo $modInstance->render($layout);

```

Let's explain the sections we added:

1. First we use Composer to register our own namespace in the `src` folder. You could use old class names but you have to register a prefix through JLoader anyway so why not use latest PHP practices?
2. Then we create an instance of the module passing `$params` & `$module` vars so module can do a lot of awesome stuff for us based on them.
3. Finally we retrieve the layout that the user assigned in the module params (using `default` if somehow no layout was assigned) and render it.

Now let's create our namespaced module class in `src/LoginModule.php`:

```php
<?php
/**
 * @package     Phproberto.Module
 * @subpackage  Site.mod_phproberto.login
 *
 * @copyright  Copyright (C) 2017-2018 Roberto Segura López, Inc. All rights reserved.
 * @license    See COPYING.txt
 */

defined('_JEXEC') || die;

\JLoader::import('twig.library');

use Phproberto\Joomla\Twig\Module\BaseTwigModule;

/**
 * Login module.
 *
 * @since  1.0.0
 */
class LoginModule extends BaseTwigModule
{
}

```

Basically an empty class that extends the `BaseTwigModule` class that Joomla-twig provides.  There is nothingg really to explain except that we load Joomla-twig library through:

```php
\JLoader::import('twig.library');
```

which allows us to start using Joomla-Twig classes.  

Time to create our layouts!  

Let's create an example file `tmpl/default.html.twig` with some content:

```twig
{% raw %}
{% set postText = params.get('posttext') %}
<div class="{{ cssClass }}" id="{{ cssId }}">
	<form action="{{ jroute('index.php')}}" method="post" id="login-form" class="form-inline">
		<input id="{{ cssId }}-username" type="text" name="username" class="input-small" tabindex="0" size="18" placeholder="{{ jtext('MOD_LOGIN_VALUE_USERNAME') }}" />
		<input id="{{ cssId }}-username" type="password" name="password" class="input-small" tabindex="0" size="18" placeholder="{{ jtext('JGLOBAL_PASSWORD') }}" />

		{# Hidden stuff #}
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.login" />
		<input type="hidden" name="return" value="{{ return }}" />
		{{ jhtml('form.token') }}

		{% if postText %}
			<div class="posttext">
				<p>{{ postText }}</p>
			</div>
		{% endif %}

		<button type="submit" tabindex="0" name="Submit" class="btn btn-primary login-button">{{ jtext('JLOGIN') }}</button>
	</form>
</div>
{% endraw %}
```

I stole the previous code from Joomla's `mod_login` module to show some of the features that we can use in the module. Let's hightlight some key features we are using in this layout:

1. We access params and create a `postText` Twig variable.
2. We use the `cssClass` and `cssIds` that the module automatically generates for us. I like to wrap all my modules like that so I can style them with CSS or connect any required JS logic to them.
3. We use `jroute()` to generate the url for the form action.
4. We use `jtext()` for translatable strings.
5. We use `{# #}` for Twig comments that won't be shown in the source code by the user browsing the page.
6. We use `jhtml()` to generate a form token. 

The rest of the module (XML manifest, language files, etc.) uses the standard markup that you would generate for any Joomla module. 

