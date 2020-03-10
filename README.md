# Centurion web application

## All general documentation would appear here.

Introduction.

```php

    /**
     * @package Centurion Web application
     * @author  Amadi ifeanyi <amadiify.com>
     * This application is developed with the Moorexa open source PHP framework, developed and managed by Fregate Software Lab.
    */
```

The main controller for public view lives in 'pages/App'. A controller can be generated via the terminal with 

```bash

   php assist new page < page Name >
```

All static files have been autoloaded in 'kernel/loadStatic.json'. Before production, we would bundle all static files and serve them from a CDN. 

```json
{
    "stylesheet": [
        "moorexa.css",
        "plugins/css/plugins.css",
        "theme/style.css",
        "theme/responsiveness.css",
        "skins/default.css"
    ],

    "stylesheet@bundle" : [

    ],
    
    "scripts": [
        "moorexa.min.js",
        "plugins/js/jquery.min.js",
        "plugins/js/bootstrap.min.js",
        "plugins/js/viewportchecker.js",
        "plugins/js/bootsnav.js",
        "plugins/js/slick.min.js",
        "plugins/js/jquery.nice-select.min.js",
        "plugins/js/jquery.fancybox.min.js",
        "plugins/js/jquery.downCount.js",
        "plugins/js/freshslider.1.0.0.js",
        "plugins/js/moment.min.js",
        "plugins/js/daterangepicker.js",
        "plugins/js/wysihtml5-0.3.0.js",
        "plugins/js/bootstrap-wysihtml5.js",
        "plugins/js/jquery.slimscroll.min.js",
        "plugins/js/jquery.metisMenu.js",
        "plugins/js/jquery.easing.min.js",
        "theme/custom.js",
        "theme/jQuery.style.switcher.js"
    ],

    "scripts@bundle" : [
        
    ]
}
```

All static files, general assets are cached in 'public/Assets/assets.paths.json' and served at zero seconds.

# Landing page
You can start the development server by running:

```bash
    php assist serve
```

# HTTP Errors 
Error handler for 404, 204 has been registered in 'kernel/Config/config.xml'. This handler exists as a controller called 'PageError'. During initialization, we set the display for the nav to be active in 'pages/PageError/provider.php', so to give the user some extra links of our application to navigate to.

# Api response
All routes can also serve for apis, you just need to chain ->json(); to the render method in your controller. for more information visit www.moorexa.com 