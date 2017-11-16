## japp

This variable is a proxy of Factory::getApplication(). It allows to access the active application inside twig layouts.     

1. [Returns](#returns)
2. [Examples](#examples)

### Returns <a id="returns"></a>

`\Joomla\CMS\Application\CMSApplication`  The active application.

### Examples <a id="examples"></a>

```twig
{# 
	This will print something like: 
	The active template is protostar
#}
<pre>The active template is {% raw %}{{ japp.getTemplate() }}{% endraw %}</pre>
```
