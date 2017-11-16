## jdoc

This function is equivalent to use Factory::getDocument()  

1. [Returns](#returns)
2. [Examples](#examples)

### Returns <a id="returns"></a>

`\Joomla\CMS\Document\Document`  The active document.

### Examples <a id="examples"></a>

```twig
{# Load a script in this page from a twig layout #}
<pre>{% raw %}{% set script = jdoc.addScriptDeclaration('alert("Hello world!")') %}{% endraw %}</pre>
```