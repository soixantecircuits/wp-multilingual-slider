To display the slider, paste this code in a theme template :

   `if (function_exists('print_home_slider')) {
       print_home_slider();
    }`

## Custom developpement

Some hooks are available with an arguments to easily modify the behaviour of the plugin :

### Parameters

- $slides (array) Contains the slides
- $sel\_lang (array) Contains all the languages

### Hooks

- wpms\_init (Called when initializing the plugin)
- wpms\_before\_slider, $slides (Called before drawing the slider)
- wpms\_after\_slider, $slides (Called after drawing the slider)
- wpms\_build\_premissions (Called when giving permissions to modify slides)
- wpms\_create\_top\_menu (Called when creating the admin top menu)
- wpms\_before\_admin\_display, $sel\_lang (Called before displaying the admin page)
- wpms\_after\_admin\_display (Called after displaying the admin page)

Git repo by gabrielstuff
 Automatically generated on Jeu 28 jui 2012 16:10:22 CEST
