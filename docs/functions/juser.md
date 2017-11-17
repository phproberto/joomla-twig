## juser($id = null)

This function is a proxy of `Joomla\CMS\Factory::getUser()`. It allows to retrieve users to use them inside twig layouts.  

1. [Parameters](#parameters)
1. [Returns](#returns)
2. [Examples](#examples)

### Parameters <a id="parameters"></a>

* `integer`  **$id**  [optional] User to load. Default: use active user

### Returns <a id="returns"></a>

`Joomla\CMS\User\User`  The User object.

### Examples <a id="examples"></a>

```twig
{% raw %}
{# Retrieve active user not using any id #}
{% set activeUser = juser() %}

{# Retrieve the user with id: 668 #}
{% set user = juser(668) %}

{# Let's test if user was found #}
{% if user.get('guest') %}
	User could not be loaded
{% else %}
	User found with email: {{ user.email }}
{% endif %}
{% endraw %}
```
