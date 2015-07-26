var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

	/*COFFEE DOES NOT WORK WHEN RUNNING GULP...SPENT AN HOUR TRYING TO FIND A SOLUTION...GET ERROR Error running task sequence: [TypeError: Arguments to path.join must be strings]
 ... CAN'T FIND SOLUTION ONLINE...UPDATED NPM...GOT LATEST VERSION OF COFFEE...UPDATED VERSION OF GULP...MOVING ON*/
    //mix.sass('app.scss').coffee();
    mix.sass('app.scss');

    mix.styles(['vendor/normalize.css','app.css'], null, 'public/css');

    mix.version('public/css/all.css');

});
