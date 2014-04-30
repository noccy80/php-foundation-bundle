NoccyLabs Foundation Bundle
===========================

This bundle provides a modular foundation for webpages, letting you quickly
add components such as jquery, bootstrap and more.


CDNs
----

Currently **netdna** and **cloudflare** are supported. To select the content
delivery networks you would like to use, edit your config.yml:

.. code-block:: yaml

    foundation:
        cdn:       
            - cloudflare
            - netdna



Components
----------

Defining your components is as simple:

.. code-block:: yaml

    foundation:
        components:
            - jquery
            - bootstrap


Command

.. code-block:: text

    $ app/console foundation:update
    Writing foundation.html.twig ... done
    $

The foundation.html.twig will look like this:

.. code-block:: twig

    <html lang="{{ html.language|default("en") }}">
    <head>
        {% block head %}{% endblock %}
        ...links...
    </head>
    <body>
        {% block body %}
        ...scripts...
    </body>
    </html>

And to use it, modify your base.html.twig:

.. code-block:: twig

    {% extends "::foundation.html.twig" %}
    {% block head %}
    <title>...</title>
    {% endblock %}
    {% block body %}
    ...
    {% endblock %}