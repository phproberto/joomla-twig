## jsession

This variable is a proxy of Factory::getSession(). It allows to access the active session inside twig layouts.  

1. [Returns](#returns)
2. [Examples](#examples)

### Returns <a id="returns"></a>

`Joomla\CMS\Session\Session`  The active session.

### Examples <a id="examples"></a>

```twig
{# 
	Retrieve a session token to use it in forms/urls:
#}
<a href="index.php?{% raw %}{{ jsession.getToken() }}{% endraw %}=1">Sample link with token</a>
```
