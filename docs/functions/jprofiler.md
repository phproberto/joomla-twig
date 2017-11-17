## jprofiler($prefix = '')

This function is a proxy of `Joomla\CMS\Profiler\Profiler::getInstance()`. It allows to use a profiler to debug performance inside twig layouts.  
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
{#  Load a custom profiler with twig prefix. Best of jprofiler is that you can share profilers from PHP & twig to fully trace performance issues. #}
{% set profiler = jprofiler('twig') %} 

{# echo memory & time consumed before doing something. If you want to hide in production while debugging an issue this you can use display: hidden in the container #}
<pre>{{ profiler.mark('before loading something') }}</pre>

{# Here what you want to debug #}

{# echo memory & time consumed after something.
<pre>{{ profiler.mark('after loading something') }}</pre>
{% endraw %}
```
