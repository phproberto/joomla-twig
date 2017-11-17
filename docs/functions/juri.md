## juri($uri = 'SERVER')

This function is a proxy of `Joomla\CMS\Uri\Uri::getInstance()`. It allows to deal with URLs as objects inside twig layouts.  

1. [Parameters](#parameters)
1. [Returns](#returns)
2. [Examples](#examples)

### Parameters <a id="parameters"></a>

* `string`  **$uri**  [optional] The URI to parse. Default: active URL

### Returns <a id="returns"></a>

`Joomla\CMS\Uri\Uri`  The Uri object.

### Examples <a id="examples"></a>

```twig
{% raw %}
{# Load a URL into a uri object. Add Itemid=1976, remove view=category and finally ouput it as string #}
{% set uri = juri('index.php?option=com_content&view=category') %}

{# Add Itemid=1976 to the uri #}
{% do uri.setVar('Itemid', 1976) %}

{# Remove view=category from the uri #}
{% do uri.delVar('view') %}

{# Print final URL #}
<pre>Final URL is: {{ uri.toString() }}</pre>

{# This will also print the url because Uri implements `__toString()` magic method #}
<pre>Final URL is: {{ uri }}</pre>
{% endraw %}
```
