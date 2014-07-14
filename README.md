Re  NoccyLabs Foundation Bundle
===========================

Building websites around modern JavaScript and responsive CSS libraries can be
a bit of a pain. Let us introduce the FoundationBundle that makes building a
useful foundation easy as pie.



## Configuration

No configuration needed at this time.


## Using

To use foundation, use the `foundation()` Twig tag in the head of your document:

    <html>
    <head>
        <title>My Website</title>
        ...
        {{ foundation('jquery,twitter-bootstrap') }}
    </head>
    ...

You can also specifiy components as an array if you prefer:

    {{ foundation([ "jquery", "twitter-bootstrap" ]) }}


### Static template

*not implemented*

To dump a static template with the required links and script tags, use the `foundation:dump`
command.

    $ app/console foundation:dump > app/Resources/views/foundation.html.twig

### Finding usable components

    $ app/console foundation:search bootswatch
     - bootswatch (Cdnjs)
     - bootswatch-amelia (BootstrapCdn)
     - bootswatch-cerulean (BootstrapCdn)
     - bootswatch-cosmo (BootstrapCdn)
     ...
     
 In this case, you should be able to add `bootswatch-cerulean` to your foundation
 call to make your site use the cerulean bootswatch theme for bootstrap:
 
        {{ foundation([
            'jquery', 
            'twitter-bootstrap', 
            'twitter-bootstrap-css',
            'bootswatch-cerulean'
        ]) }}

