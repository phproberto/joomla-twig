## jroute($url, $xhtml = true, $ssl = null)

This function is a proxy of `Joomla\CMS\Router\Route::_()`. It allows to build SEF urls inside twig layouts.  

1. [Parameters](#parameters)
1. [Returns](#returns)
2. [Examples](#examples)

### Parameters <a id="parameters"></a>

* `string`   **$url**    Absolute or Relative URI to Joomla resource.
* `boolean`  **$xhtml**  Replace & by &amp; for XML compliance.
* `integer`  **$ssl**    Secure state for the resolved URI.
    * 0: (default) No change, use the protocol currently used in the request
    * 1: Make URI secure using global secure site URI.
    * 2: Make URI unsecure using the global unsecure site URI.

### Returns <a id="returns"></a>

`string` The translated humanly readable URL.

### Examples <a id="examples"></a>

```twig
{% raw %}
{#  Load a profiler and mark to points before and after doing something #}
<a href="{{ jroute('index.php?option=com_content&view=category&id=27')}}">View category</a>
{% endraw %}
```
