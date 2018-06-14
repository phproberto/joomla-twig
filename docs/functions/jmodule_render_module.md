## jmodule_render_module($module, $attribs = array())

Render a module object. 

1. [Parameters](#parameters)
1. [Returns](#returns)
2. [Examples](#examples)

### Parameters <a id="parameters"></a>

* `object`  **$module**   Object containing module information
* `array`   **$attribs**  [optional] Array of attributes for the module (probably from the XML).

### Returns <a id="returns"></a>

`\string`  Rendered module.

### Examples <a id="examples"></a>

```twig
{% raw %}
{#  Retrieve and display all the modules in a sidebar position #}
{% for module in jmodule_get_modules('sidebar') %}
	{{ jmodule_render_module(module) }}
{% endfor %}

{% endraw %}
```
