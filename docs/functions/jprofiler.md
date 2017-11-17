## jprofiler($prefix = '')

This function is a proxy of `Joomla\CMS\Profiler\Profiler::getInstance()`. It allows to use a profiler to debug performance inside a twig layouts.  
1. [Parameters](#parameters)
1. [Returns](#returns)
2. [Examples](#examples)

### Parameters <a id="parameters"></a>

* `string`  **$prefix**  Prefix used to distinguish profiler objects.

### Returns <a id="returns"></a>

`Joomla\CMS\Profiler\Profiler`  A profiler instance.

### Examples <a id="examples"></a>

```twig
{% raw %}
{#  Load a profiler and mark to points before and after doing something #}
{% set profiler = jprofiler('twig') %} 
<pre>{{ profiler.mark('before loading something') }}</pre>
<pre>{{ profiler.mark('after loading something') }}</pre>
{% endraw %}
```
