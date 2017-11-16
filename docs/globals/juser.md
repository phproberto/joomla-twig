## juri

This variable is a proxy of Factory::getUser(). It allows to access the active user as a User object inside twig layouts.  

1. [Returns](#returns)
2. [Examples](#examples)

### Returns <a id="returns"></a>

`Joomla\CMS\User\User`  The active User object.

### Examples <a id="examples"></a>

```twig
{# Check if user is guest and say hello #}
{% raw %}{% if juser.get('guest') %}{% endraw %}
	Hello guest!
{% raw %}{% else %}{% endraw %}
	Hello {% raw %}{{ juser.get('name') }}{% endraw %}!
{% raw %}{% endif %}{% endraw %}
```
