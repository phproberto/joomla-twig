## to_array

Filter to cast variables to array. Equivalent to PHP's `(array) $variable`.

1. [Returns](#returns)
2. [Examples](#examples)

### Returns <a id="returns"></a>

array  Variable casted

### Examples <a id="examples"></a>

```twig
{# Create an array containing the active user id and dump the result #}
{% raw %}{% set users = juser.get('id')|to_array %}{% endraw %}
{% raw %}{{ dump(users) }}{% endraw %}
```