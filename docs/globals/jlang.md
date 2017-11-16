## jdoc

This variable is a proxy of Factory::getLanguage(). It allows to access the active language inside twig layouts.  

1. [Returns](#returns)
2. [Examples](#examples)

### Returns <a id="returns"></a>

`Joomla\CMS\Language\Language`  The active language.

### Examples <a id="examples"></a>

```twig
{# 
	Use active language tag inside a layout. Will print something like:
	Active language is en-GB 
#}
<pre>{% raw %}Active language is {{ jlang.getTag() }}{% endraw %}</pre>
```