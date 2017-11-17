## jtext_sprintf($string, $...)

This function is a proxy of `Joomla\CMS\Language\Text::sprintf()`. It allows to use translatable strings inside twig layouts.  

1. [Parameters](#parameters)
1. [Returns](#returns)
2. [Examples](#examples)

### Parameters <a id="parameters"></a>

* `string`  **$string**  The format string.
* `mixed`   **$...**     Replacements for string parts.

### Returns <a id="returns"></a>

`string`  The translated strings or the key if 'script' is true in the array of options.

### Examples <a id="examples"></a>

```twig
{% raw %}
{#  Display the translation of the JNEXT_TITLE language string (which would be something like "Next article: %s"). It will show something like:
	Next article: My article title
 #}
{{ jtext_sprintf('JNEXT_TITLE', 'My article title') }}
{% endraw %}
```
