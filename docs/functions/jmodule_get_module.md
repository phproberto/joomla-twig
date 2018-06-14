## jmodule_get_module($name, $title = null)

Get a module published on the current page by its name or folder.  

1. [Parameters](#parameters)
1. [Returns](#returns)
2. [Examples](#examples)

### Parameters <a id="parameters"></a>

* `string`  **$name**   Name of the module (real, eg 'Breadcrumbs' or folder, eg 'mod_breadcrumbs')
* `array`   **$title**  [optional] Title of the module.

### Returns <a id="returns"></a>

`\stdClass|null`   - The first module found that matches the name if found. Empty object if module not found and name starts with `mod_`. Null otherwise.

### Examples <a id="examples"></a>

```twig
{% raw %}
{#  Retrieve a `mod_menu` module #}
{% set module = jmodule_get_module('mod_menu') %}

{#  Retrieve a `mod_menu` module by its name (name is the module element removing the mod_ part). #}
{% set module = jmodule_get_module('menu') %}

{#  Retrieve a `mod_menu` module with a specific title. #}
{% set module = jmodule_get_module('mod_menu', 'Main Menu') %}

{% endraw %}
```
