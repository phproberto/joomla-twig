## jregistry($data = null)

This function returns an instance of `Joomla\Registry\Registry::getInstance()`. It allows to handle data coming from extension params or to create setting objects with defaults.  

1. [Parameters](#parameters)
1. [Returns](#returns)
2. [Examples](#examples)

### Parameters <a id="parameters"></a>

* `mixed`  **$data**  JSON string | Array.

### Returns <a id="returns"></a>

`Joomla\Registry\Registry`  A registry instance.

### Examples <a id="examples"></a>

```twig
{% raw %}
{#  Create a registry object from module parameters #}
{% set params = jregistry(module.params) %} 

{% if params.get('format') === 'short' %}
	<pre>Short format selected in module params</pre>
{% endif %}

{% endraw %}
```
