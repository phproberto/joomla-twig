## jtext($string, $jsSafe = false, $interpretBackSlashes = true, $script = false)

This function is a proxy of `Joomla\CMS\Language\Text::_()`. It allows to use translatable strings inside twig layouts.  

1. [Parameters](#parameters)
1. [Returns](#returns)
2. [Examples](#examples)

### Parameters <a id="parameters"></a>

* `string`   **$string**                The string to translate.
* `mixed`    **$jsSafe**                Boolean: Make the result javascript safe.
* `boolean`  **$interpretBackSlashes**  To interpret backslashes (\\=\, \n=carriage return, \t=tabulation).
* `boolean`  **$script**                To indicate that the string will be push in the javascript language store:

### Returns <a id="returns"></a>

`string`  The translated string or the key if $script is true.

### Examples <a id="examples"></a>

```twig
{% raw %}
{#  Display the translation of the JENABLED language string #}
Something is {{ jtext('JENABLED') }}
{% endraw %}
```
