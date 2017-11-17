## jposition($position, $attribs = [])

It allows to render a module position inside a twig layout.  

1. [Parameters](#parameters)
1. [Returns](#returns)
2. [Examples](#examples)

### Parameters <a id="parameters"></a>

* `string`  **$position**  Name of the position to render
* `array`   **$attribs**   An array of attributes for the module chrome function.

### Returns <a id="returns"></a>

`string`  HTML with the position content

### Examples <a id="examples"></a>

```twig
{% raw %}
{#  Render the content of the template position-8 #}
{{ jposition('position-8') }}
{% endraw %}
```
