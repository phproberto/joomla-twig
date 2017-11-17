## jlayout_debug($layoutFile, $displayData = null, $basePath = '', $options = null)

Fast debug of JLayout files rendering inside a twig layouts. Proxy of `\Joomla\CMS\LayoutHelper::debug()`.  

1. [Parameters](#parameters)
1. [Returns](#returns)
2. [Examples](#examples)

### Parameters <a id="parameters"></a>

* `string`  **$layoutFile**   Dot separated path to the layout file, relative to base path.
* `mixed`   **$displayData**  [optional] Array|Object which the data for the layout file. Default: `null`
* `string`  **$basePath**     [optional] Base path to use when loading layout files.
* `mixed`   **$options**      [optional] Custom options to load. Registry or array format

### Returns <a id="returns"></a>

`string`  HTML with layout output + debug info

### Examples <a id="examples"></a>

```twig
{#  Debug the joomla.html.treeprefix layout with ['level' => 10] as data #}
{% raw %}{{ jlayout_debug('joomla.html.treeprefix', {'level' : 10}) }}{% endraw %}
```
