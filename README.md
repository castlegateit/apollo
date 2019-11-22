# Apollo

Apollo is a basic [WordPress](https://wordpress.org/) theme template. It uses [npm](https://www.npmjs.com/) and [Composer](https://getcomposer.org/) to manage its PHP dependencies and [Gulp](https://gulpjs.com/) to compile its CSS and JavaScript files.

## Install

    git clone https://github.com/castlegateit/apollo.git
    cd apollo
    composer install
    npm install

## Extend

The site uses [Boostrap](https://getbootstrap.com/) and [Atlas](https://github.com/castlegateit/atlas) to provide basic styles. The class name prefix used by Atlas components is set in the `config.json` file, which is read by Gulp and PHP to ensure that the prefix is set consistently in the HTML, CSS, and JavaScript output.

The prefix is available as `$atlas-prefix` in Sass, `ATLAS_PREFIX` in JavaScript, and `ATLAS_PREFIX` in PHP.

### CSS

Edit the following files to configure the theme:

*   Edit `src/scss/_bootstrap.scss` to override the default Bootstrap variables defined in `node_modules/bootstrap/scss/_variables.scss`.
*   Edit `src/scss/_atlas.scss` to override the default Atlas variables defined in `node_modules/castlegate-atlas/src/scss/_variables.scss`.

You can also edit `src/scss/style.scss` to provide your own styles. You will need to run `npm run build` or `npm run watch` to compile the production CSS files.

As far as possible, the CSS should be written using the [BEM](http://getbem.com/) method. Each __block__ should have its own Sass file in `src/scss/components`.

### JavaScript

The site includes [jQuery](https://jquery.com/), Bootstrap, Atlas. Any additional files in the `src/js` directory will be compiled into the production JavaScript files when you run `npm run build`.

Third-party scripts should be installed with npm. For example:

    npm install --save-dev castlegate-truncate
    npm install --save-dev magnific-popup
    npm install --save-dev tiny-slider

You will then need to edit `gulpfile.js` and `src/scss/style.scss` to include the necessary files. Example Gulp configuration:

~~~ javascript
const config = {
    paths: {
        src: {
            css: './src/scss/*.scss',
            js: [
                './node_modules/jquery/dist/jquery.js',
                './node_modules/bootstrap/dist/js/bootstrap.js',
                './node_modules/castlegate-atlas/src/js/**/*.js',
                '!./node_modules/castlegate-atlas/src/js/atlas.js',

                './node_modules/castlegate-truncate/dist/truncate.js',
                './node_modules/magnific-popup/dist/jquery.magnific-popup.js',
                './node_modules/tiny-slider/dist/tiny-slider.js',

                './src/js/**/*.js'
            ]
        }
        // ...
    },
    // ...
};
~~~

Example Sass import:

~~~ scss
// Framework and library source
@import 'node_modules/bootstrap/scss/bootstrap';
@import 'node_modules/castlegate-atlas/src/scss/atlas';
@import 'node_modules/magnific-popup/src/main';
@import 'node_modules/tiny-slider/src/tiny-slider';
// ...
~~~

You can also add files to `src/js` to provide your own JavaScript code. You will need to run `npm run build` or `npm run watch` to compile these files into the production JavaScript file.

### PHP

#### Constants

Constants used throughout the site should be defined in the `wp-config.php` file in the document root directory. Constants used throughout the theme, independent of environment, should be defined in the `helpers/constants.php` file.

#### Functions

Functions defined for use in the theme should be defined in `helpers/functions.php` with the `Castlegate\Apollo` namespace.

#### Classes

Classes should be defined in separate files in the `classes` directory and should follow the [PHP-FIG](https://www.php-fig.org/) standards. The classes defined in this directory are autoloaded by Composer in the `Castlegate\Apollo` namespace.

#### Theme features and definitions

Additional theme features, such as image sizes, enqueued CSS and JavaScript files, and navigation menu definitions, should be set in separate PHP files in the `helpers` directory. These files should then be included in an appropriate order in the main theme `functions.php` file.

#### Page templates

Page templates saved in the `templates` directory. These files should always include the WordPress template name comment so that they can be selected by the user. Page templates should not be restricted to a particular page ID or slug.

#### Components

Template parts should be saved in the `components` directory. As far as possible, each component file should contain a single BEM block and should have a corresponding Sass file defining the styles for that block. For example `components/text-box.php` would contain a block with the BEM class `text-box` and the styles for that class would be defined in `src/scss/components/_text-box.scss`.

#### Composer

Third-party PHP code should be installed via Composer. For example:

    composer require castlegate/foo

Note that Apollo requires `castlegate/monolith-core` and `castlegate/monolith-wordpress` and these will be installed by composer when you first run `composer install`.

#### Static files

Static files, including images, should be stored in the `dist` directory. For example, images would be stored in `dist/images`. Do not edit the compiled CSS and JavaScript files in `dist/css` and `dist/js`.

## License

Copyright (c) 2019 Castlegate IT. All rights reserved.

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see <https://www.gnu.org/licenses/>.
