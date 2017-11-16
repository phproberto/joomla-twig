## japp
> Global variable

This function is equivalent to use JFactory::getApplication()   

* [Returns](#returns)
* [Examples](#examples)

### Returns <a id="returns"></a>

`\Joomla\CMS\Application\CMSApplication`  The active application.

### Examples <a id="examples"></a>

```twig
<pre>The active template is {{ japp.getTemplate() }}</pre>
```