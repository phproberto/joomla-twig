## jhtml($key, $...)

This function is a proxy of `HTMLHelper::_($key)`. It allows to access HTML drawing classes inside twig layouts.  

1. [Parameters](#parameters)
1. [Returns](#returns)
2. [Examples](#examples)

### Parameters <a id="parameters"></a>

* `string`  **$key**  The name of helper method to load, (prefix).(class).function prefix and class are optional and can be used to load custom html helpers.
* `mixed`   **$...**  Optional parameters for the helper method.

### Returns <a id="returns"></a>

`mixed`  Result of HTMLHelper::call($function, $args)

### Examples <a id="examples"></a>

```twig
{% raw %}
{# Render a form token. It will render something like:  
	<input type="hidden" name="19fa6812708e295180f8d5e08963cd5b" value="1" />#}
{{ jhtml('form.token') }}
{% endraw %}
```
