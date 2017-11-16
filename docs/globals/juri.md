## juri

This variable is a proxy of JUri::getInstance(). It allows to access the active URL as a Uri object inside twig layouts.  

1. [Returns](#returns)
2. [Examples](#examples)

### Returns <a id="returns"></a>

`Joomla\CMS\Uri\Uri`  The active Uri instance.

### Examples <a id="examples"></a>

```twig
{# Create a link to the home page #}
<a href="{% raw %}{{ juri.root() }}{% endraw %}">Home</a>
```
