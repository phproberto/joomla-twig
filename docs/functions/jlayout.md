## jlayout($layoutId, $basePath = null, $options = null)

Create an instance of `\Joomla\CMS\Layout\FileLayout` to use it inside a twig layout .  

1. [Parameters](#parameters)
1. [Returns](#returns)
2. [Examples](#examples)

### Parameters <a id="parameters"></a>

* `string`  **$layoutId**  Dot separated path to the layout file, relative to base path.
* `string`  **$basePath**  [optional] Base path to use when loading layout files.
* `mixed`   **$options**   [optional] Custom options to load. Registry or array format.

### Returns <a id="returns"></a>

`\Joomla\CMS\Layout\FileLayout`  FileLayout instance.

### Examples <a id="examples"></a>

```twig
{% raw %}
{#  Create a layout instance of `joomla.system.message` to render some dynamically generated messages #}
{% set data = { 
		'msgList' : {
			'error' : [
				'Something went wrong. Ask help to @mbabker',
				'Still broken. Contact OSM?'
			],
			'info' : [
				'Using Twig inside Joomla! is cool'
			]
		}
	} 
%}
{% set layout = jlayout('joomla.system.message') %}
{{ layout.render(data)|raw }}
{% endraw %}
```
