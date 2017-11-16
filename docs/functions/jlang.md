## jlang($key = null, $debug = false)

This function is a proxy of `Language::getInstance()`. It allows to access HTML drawing classes inside twig layouts.  

1. [Parameters](#parameters)
1. [Returns](#returns)
2. [Examples](#examples)

### Parameters <a id="parameters"></a>

* `string`   **$lang**   [optional] The language to use. Default: `en-GB`
* `boolean`  **$debug**  [optional] The debug mode. Default: `false`

### Returns <a id="returns"></a>

`\Joomla\CMS\Language\Language`  Language object

### Examples <a id="examples"></a>

```twig
{#  Show the spanish language name #}
{% raw %}{{ jlang('es-ES').getName() }}{% endraw %}
```
