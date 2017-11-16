## unserialize

Filter to unserialize a variable. Equivalent to PHP's [`unserialize($variable)`](http://php.net/manual/en/function.unserialize.php)

1. [Returns](#returns)
2. [Examples](#examples)

### Returns <a id="returns"></a>

The converted value is returned, and can be a boolean, integer, float, string, array or object.

In case the passed string is not unserializeable, FALSE is returned and E_NOTICE is issued. 

### Examples <a id="examples"></a>

```twig
{# If you have serialized a variable in session you can recover it and unserialize it in twig #}
{% raw %}{% set cartItems = jsession.get('cartItems', []) %}{% endraw %}
{% raw %}{% if cartItems is not iterable %}{% endraw %}
	{% raw %}{% set cartItems = cartItems|unserialize %}{% endraw %}
{% raw %}{% endif %}{% endraw %}
```