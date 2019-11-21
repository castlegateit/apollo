// jshint node: true, esversion: 6

// Strict mode
'use strict';

// Configuration
const config = {
    paths: {
        src: {
            css: './src/scss/**/*.scss',
            js: [
                './node_modules/jquery/dist/jquery.js',
                './node_modules/bootstrap/dist/js/bootstrap.js',
                './node_modules/castlegate-atlas/dist/js/atlas.js',
                './src/js/atlas.js',
                './src/js/**/*.js'
            ]
        },
        dest: {
            css: './dist/css',
            js: './dist/js'
        }
    },
    plugins: {
        autoprefixer: {
            remove: false
        },
        rename: {
            suffix: '.min'
        },
        sass: {
            includePaths: [
                '.'
            ],
            outputStyle: 'nested'
        }
    }
};

// Modules
const del = require('del');
const gulp = require('gulp');

// Plugins
const autoprefixer = require('gulp-autoprefixer');
const concat = require('gulp-concat');
const csso = require('gulp-csso');
const filter = require('gulp-filter');
const plumber = require('gulp-plumber');
const rename = require('gulp-rename');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');

// Tasks
function cssCleanTask()
{
    return del(config.paths.dest.css);
}

function jsCleanTask() {
    return del(config.paths.dest.js);
}

function cssCompileTask() {
    return gulp.src(config.paths.src.css)
        .pipe(plumber())

        // Create map(s) and write uncompressed development version
        .pipe(sourcemaps.init())
        .pipe(sass(config.plugins.sass).on('error', sass.logError))
        .pipe(autoprefixer(config.plugins.autoprefixer))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(config.paths.dest.css))

        // Remove map(s) and write compressed production version
        .pipe(filter('**/*.css'))
        .pipe(rename(config.plugins.rename))
        .pipe(csso())
        .pipe(gulp.dest(config.paths.dest.css));
}

function jsCompileTask() {
    return gulp.src(config.paths.src.js)
        .pipe(plumber())

        // Create map(s) and write uncompressed development version
        .pipe(sourcemaps.init())
        .pipe(concat('script.js'))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(config.paths.dest.js))

        // Remove map(s) and write compressed production version
        .pipe(filter('**/*.js'))
        .pipe(rename(config.plugins.rename))
        .pipe(uglify())
        .pipe(gulp.dest(config.paths.dest.js));
}

function watchTask() {
    gulp.watch(config.paths.src.css, cssTask);
    gulp.watch(config.paths.src.js, jsTask);
}

const cssTask = gulp.series(cssCleanTask, cssCompileTask);
const jsTask = gulp.series(jsCleanTask, jsCompileTask);

const build = gulp.parallel(cssTask, jsTask);
const watch = gulp.parallel(build, watchTask);

// Public tasks
exports.default = build;
exports.watch = watch;
