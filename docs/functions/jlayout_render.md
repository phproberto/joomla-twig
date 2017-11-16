## jlayout_render($layoutFile, $displayData = null, $basePath = '', $options = null)

Fast rendering of JLayout files inside a twig layouts. Proxy of `\Joomla\CMS\LayoutHelper::render()`.  

1. [Parameters](#parameters)
1. [Returns](#returns)
2. [Examples](#examples)

### Parameters <a id="parameters"></a>

* `string`  **$layoutFile**   Dot separated path to the layout file, relative to base path.
* `mixed`   **$displayData**  [optional] Array|Object which the data for the layout file. Default: `null`
* `string`  **$basePath**     [optional] Base path to use when loading layout files.
* `mixed`   **$options**      [optional] Custom options to load. Registry or array format

### Returns <a id="returns"></a>

`string`  HTML with layout output

### Examples <a id="examples"></a>

```twig
{#  Render the joomla.html.treeprefix layout with ['level' => 10] as data #}
{% raw %}{{ jlayout_render('joomla.html.treeprefix', {'level' : 10}) }}{% endraw %}
```
