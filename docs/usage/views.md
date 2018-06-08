## Using Twig in component views

This library provides a Trait that will do the main part to start using Twig in your component views.

## Using HasTwigRenderer trait.

If you already have a component the easiest way to integrate Twig is to make use of the `HasTwigRenderer` trait.  

Let's do the conversion for a view that is complex: com_content article view. Do you think we can start using Twig in with 20 lines of code there? Yes! And I did it in 5 minutes while writing this doc!  

First let's open `/components/com_content/views/article/view.html.php`. The file starts with:  

```php
<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * HTML Article View class for the Content component
 *
 * @since  1.5
 */
class ContentViewArticle extends JViewLegacy
{
	protected $item;
```

We have to connect the twig library + the traits it provides to ease integration with existing solutions. Modify the view like this:  

```php
<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::import('twig.library');

use Phproberto\Joomla\Twig\Traits\HasLayoutData;
use Phproberto\Joomla\Twig\View\Traits\HasTwigRenderer;

/**
 * HTML Article View class for the Content component
 *
 * @since  1.5
 */
class ContentViewArticle extends JViewLegacy
{
	use HasLayoutData, HasTwigRenderer;

	protected $item;
```

We:

* Called the Twig library with `JLoader::import('twig.library')`. I've added this here so you can see how easy is to integrate Twig but ideally this change would be inside your component's dispatcher. That would be `/components/com_content/content.php` file in our example. Loading the Twig library there will make it available for all our component views. 
* Added the use statements to the traits we want to integrate: `HasLayoutData` and `HasTwigRenderer`. The first one provides a way to prepare the data that will be sent to layouts. The second one connects the Twig rendering engine to the view.

Now we have to add the abstract methods required by the traits. `HasTwigRenderer` requires a `getLayoutData()` method but `HasLayoutData` already provides it with support for caching to ensure that layout data is only loaded once. So we only need to add a 'loadLayoutData()' to our views. Article view already loads all the stuff in the `display()` method so we can just use it:  

```php
	/**
	 * Load layout data.
	 *
	 * @return  array
	 */
	protected function loadLayoutData()
	{
		return [
			'view'          => $this,
			'pageclass_sfx' => $this->pageclass_sfx,
			'params'        => $this->params,
			'item'          => $this->item,
			'state'         => $this->state,
			'user'          => $this->user,
			'print'         => $this->print
		];
	}
```

Then if you create a twig layout in `/components/com_content/views/article/tmpl/default.html.twig` like:

```twig
{% raw %}
	<h1>{{ item.title }}</h1>
	<div>{{ item.introtext|raw }}</div>
{% endraw %}
```

You will see that is renderer correctly. 

And you know what? it works with any layout received in the url like standard layouts. So it you try an url like:

`index.php/article-category-blog/17-first-blog-post/?layout=roberto`  

you can create a file in:  

`/components/com_content/views/article/tmpl/roberto.html.twig`

And it will be rendered. 

Of course it also works with template overrides!
