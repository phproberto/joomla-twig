## jdoc

This variable is a proxy of Factory::getDocument(). It allows to access the active document inside twig layouts.  

1. [Returns](#returns)
2. [Examples](#examples)

### Returns <a id="returns"></a>

`\Joomla\CMS\Document\Document`  The active document.

### Examples <a id="examples"></a>

```twig
{% raw %}
{# Load a script in this page from a twig layout #}
{% do jdoc.addScriptDeclaration('alert("Hello world!")') %}
{% endraw %}
```
