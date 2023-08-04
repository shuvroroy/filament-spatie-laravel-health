const mix = require('laravel-mix')

mix
  .postCss('resources/css/plugin.css', 'resources/dist/plugin.css', [
    require('tailwindcss')
  ]);
