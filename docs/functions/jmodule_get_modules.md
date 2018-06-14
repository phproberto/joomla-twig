## jmodule_get_modules($position)

Gets modules assigned to a specific position.  

1. [Parameters](#parameters)
1. [Returns](#returns)
2. [Examples](#examples)

### Parameters <a id="parameters"></a>

* `string`  **$position**  Name of the position

### Returns <a id="returns"></a>

`array`  An array containing modules of that position. Empty array if no modules were found.

### Examples <a id="examples"></a>

```twig
{% raw %}
{#  Retrieve modules available in a `sidebar` position #}
{% set modules = jmodule_get_modules('sidebar') %}
{% for module in modules %}
	<pre>Found module: {{ module.name }} with title: {{ module.title }}</pre>	
{% endfor %}

{% endraw %}
```
