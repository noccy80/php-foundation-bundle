NoccyLabs Foundation Bundle
===========================

Building websites around modern JavaScript and responsive CSS libraries can be
a bit of a pain. Let us introduce the FoundationBundle that makes building a
useful foundation easy as pie.



## Configuration

Create `app/config/foundation.yml` (or make it a copy of `share/foundation.yml.dist`)
and modify it to include the components that you wish to use.

    foundation:
        cdns: [ netdna ]
        components:
            - jquery
            - bootstrap
            - bootstrap-theme

## Using

To use foundation, use the `foundation()` Twig tag in the head of your document:

    <html>
    <head>
        <title>My Website</title>
        ...
        {{ foundation() }}
    </head>
    ...

You can also specifiy components with the foundation command:

    {{ foundation([ "bootstrap", "typeahead" ]) }}

To dump a static template with the required links and script tags, use the `foundation:dump`
command.

    $ app/console foundation:dump > app/Resources/views/foundation.html.twig

## Customizing and extending

To add a new component, create `component.yml` in the `.../FoundationBundle/Resource/component`
(where the name of the .yml file is *the component name*):

    component:
        name: my-component
        version: 1.1
        files:
            - { name:js/script.js, type:javascript }
            - { name:css/style.css, type:stylesheet }
        sources:
            # multiple versions, selected by the version field
            mycdn: { src:"//static.mycdn.com/libs/mycomponent/{version}/{name}" }
            # only has one version
            othercdn: { src:"//other.cdn.net/jslib/mycomp/{name}" }

This would make `my-component` available for you, and it would include one of
the following based on the `cdn` field of your app config:

 * http(s)://static.mycdm.com/libs/mycomponent/1.1/js/script.js
 * http(s)://static.mycdm.com/libs/mycomponent/1.1/css/style.css
 
...or...

 * http(s)://other.cdn.net/jslib/mycomp/js/script.js
 * http(s)://other.cdn.net/jslib/mycomp/css/style.css

