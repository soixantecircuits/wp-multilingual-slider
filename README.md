# WP-Multilingual-Slider

## Description 

This plugin allow you to easily manage a slider on a multilingual wordpress site. You can add/edit/remove slides in admin panel and add custom themes to change the layout of the slider. The plugin is delivered with some custom themes as exemple, if you modify them we recommend you to rename the theme file so it won't be override when updating.

## Dependencies

This plugin works with optional plugins :
- qTranslate
- WPML

## Usage 

To display the slider, use the shortcode :

`[display_slider]`

Or paste this code in a theme template :

```Php
if (function_exists('print_home_slider')) {
	print_home_slider();
}
```

## Custom developpement

Some hooks are available with an argument to easily modify the behaviour of the plugin :

### Hooks

- wpms\_init (Called when initializing the plugin)
- wpms\_before\_slider, $slides (Called before drawing the slider)
- wpms\_after\_slider, $slides (Called after drawing the slider)
- wpms\_build\_premissions (Called when giving permissions to modify slides)
- wpms\_create\_top\_menu (Called when creating the admin top menu)
- wpms\_before\_admin\_display, $sel\_lang (Called before displaying the admin page)
- wpms\_after\_admin\_display (Called after displaying the admin page)

### Parameters

- $slides (array) Contains the slides
- $sel\_lang (array) Contains all the languages

## Credits

This plugin have been developped by Soixante Circuits team members that are :

- https://github.com/gabrielstuff
- https://github.com/qwazerty

The following sliders have been used as exemple :

- [Flexslider] (http://www.woothemes.com/flexslider/)
- [jmpress] (http://tympanus.net/Tutorials/SlideshowJmpress/)
- [refineslide] (http://alexdunphy.github.com/refineslide/)
- [slidesjs] (http://slidesjs.com/examples/images-with-captions/)

Used showdown for themes description :
- [showdown] (https://github.com/coreyti/showdown/)
