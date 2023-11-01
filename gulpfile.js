'use strict';

const {src, dest, watch, series} = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const minifyCss = require('gulp-clean-css');
const concatCss = require('gulp-concat-css');
const rename = require("gulp-rename");
const {merge} = require("browser-sync/dist/cli/cli-options");

// compiler folder css
function compilerFolderCss(folder) {
    return src(`./assets/scss/${folder}/*.scss`)
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(dest(`./assets/css/${folder}`));
}

// compiler lib css
function compilerLibCss(folder, folderDesc) {
    return src(`./node_modules/${folder}`)
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(minifyCss({
            compatibility: 'ie8',
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`./assets/${folderDesc}`))
}

// compiler lib js
function compilerLibJs(folder, folderDesc) {
    return src(`./node_modules/${folder}`, {allowEmpty: true})
        .pipe(uglify())
        .pipe(rename( {suffix: '.min'} ))
        .pipe(dest(`./assets/${folderDesc}`))
}

// Task build Bootstrap
async function buildStylesBootstrap() {
    return src('./assets/scss/bootstrap.scss')
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(minifyCss({
            compatibility: 'ie8',
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(dest('./assets/libs/bootstrap/css'));
}
async function buildJsBootstrap() {
    compilerLibJs('bootstrap/dist/js/bootstrap.bundle.js', 'libs/bootstrap/js')
}

// Task build slick
async function buildSlickStyle() {
    compilerLibCss('slick-carousel/slick/slick.css', 'libs/slick-carousel/css')
}
async function buildSlickJs() {
    compilerLibJs('slick-carousel/slick/slick.js', 'libs/slick-carousel/js')
}

// Task build masonry
async function buildMasonryJs() {
    return src([
        './node_modules/imagesloaded/imagesloaded.pkgd.js',
        './node_modules/masonry-layout/dist/masonry.pkgd.js',
    ], {allowEmpty: true})
        .pipe(concat('masonry.min.js'))
        .pipe(uglify())
        .pipe(dest('./assets/libs/masonry'));
}

// Task build lity
async function buildLityStyle() {
    compilerLibCss('lity/dist/lity.css', 'libs/lity')
}

async function buildLityJs() {
    compilerLibJs('lity/dist/lity.js', 'libs/lity')
}

// Task build styles
async function buildStyles() {
    return src('./assets/scss/style.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(dest('./'));
}

// Task build template page
async function buildTemplateStyles() {
    compilerFolderCss('templates')
}

// Task build post type
const postTypeFolders = ['post', 'discover', 'product', 'project', 'tool'];

async function buildPostType() {
     postTypeFolders.map(function (element) {
        compilerFolderCss(`post-type/${element}`)
    })
}

// Build all
async function buildAll() {
    // build lib bootstrap
    await buildStylesBootstrap()
    await buildJsBootstrap()

    // build lib slick
    await buildSlickStyle()
    await buildSlickJs()

    // build lib masonry
    await buildMasonryJs()

    // build lib lity
    await buildLityStyle()
    await buildLityJs()

    await buildStyles()
    await buildTemplateStyles()
    await buildPostType()
}
exports.buildAll = buildAll

// watch
async function watchRun() {
    watch('./assets/scss/bootstrap.scss', buildStylesBootstrap)
    watch([
        './assets/scss/**/*.scss',
        '!./assets/scss/bootstrap.scss',
        '!./assets/scss/post-type/**/*.scss',
        '!./assets/scss/templates/*.scss',
    ], buildStyles)
    watch([
        './assets/scss/components/*.scss',
        './assets/scss/templates/*.scss'
    ], buildTemplateStyles)
    watch([
        './assets/scss/components/*.scss',
        './assets/scss/post-type/**/*.scss'
    ], buildPostType)
}

exports.watchRun = watchRun;