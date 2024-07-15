'use strict';

const {src, dest, watch, series} = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const sourcemaps = require('gulp-sourcemaps')
const browserSync = require('browser-sync').create()
const concat = require('gulp-concat')
const uglify = require('gulp-uglify')
const minifyCss = require('gulp-clean-css')
const rename = require("gulp-rename")

const pathAssets = './assets'
const pathAssetsScss = `${pathAssets}/scss`
const pathAssetsCss = `${pathAssets}/css`

// server
const domain = 'localhost/bcolor.vn';
function server() {
    browserSync.init({
        proxy: domain,
        open: false,
        cors: true,
        ghostMode: false,
        notify: false
    })
}

// compiler file scss
function compilerFileScss(fileScss, desc = '') {
    return src(`${pathAssetsScss}/${fileScss}`)
        .pipe(sourcemaps.init())
        .pipe(sass({
            outputStyle: 'expanded'
        }).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(dest(`${pathAssetsCss}/${desc}`))
        .pipe(sourcemaps.init())
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        .pipe(sourcemaps.write())
        .pipe(dest(`${pathAssetsCss}/${desc}`))
        .pipe(browserSync.stream({ match: '**/*.css' }));
}

// compiler folder scss
function compilerFolderScss(folder, levelFile = '*.scss') {
    return src(`${pathAssetsScss}/${folder}/${levelFile}`)
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(dest(`${pathAssetsCss}/${folder}`))
        .pipe(sourcemaps.init())
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        .pipe(sourcemaps.write())
        .pipe(dest(`${pathAssetsCss}/${folder}`))
        .pipe(browserSync.stream({ match: '**/*.css' }))
}

// compiler lib scss
function compilerLibCss(folder, folderDesc) {
    return src(`./node_modules/${folder}`)
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${pathAssets}/${folderDesc}`))
        .pipe(browserSync.stream({ match: '**/*.css' }))
}

// compiler lib js
function compilerLibJs(folder, folderDesc) {
    return src(`./node_modules/${folder}`, {allowEmpty: true})
        .pipe(uglify())
        .pipe(rename( {suffix: '.min'} ))
        .pipe(dest(`${pathAssets}/${folderDesc}`))
        .pipe(browserSync.stream())
}

// Task build Bootstrap
async function buildStylesBootstrap() {
    return src(`${pathAssetsScss}/bootstrap.scss`)
        .pipe(sass({
            outputStyle: 'expanded'
        }).on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        .pipe(dest(`${pathAssets}/libs/bootstrap`))
        .pipe(browserSync.stream({ match: '**/*.css' }))
}
async function buildJsBootstrap() {
    compilerLibJs('bootstrap/dist/js/bootstrap.bundle.js', 'libs/bootstrap')
}

// Task build slick
async function buildSlickStyle() {
    compilerLibCss('slick-carousel/slick/slick.css', 'libs/slick-carousel')
}
async function buildSlickJs() {
    compilerLibJs('slick-carousel/slick/slick.js', 'libs/slick-carousel')
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
async function buildStylesTheme() {
    compilerFileScss('style-theme.scss')
}

// Task build template page
async function buildTemplateStyles() {
    compilerFolderScss('templates')
}

// Task build post type
async function buildPostType() {
    compilerFolderScss('post-type', '*/**.scss')
}

// buildJSTheme
async function buildJSTheme() {
    return src([
        `${pathAssets}/js/**.js`,
        `!${pathAssets}/js/**.min.js`
    ], {allowEmpty: true})
        .pipe(uglify())
        .pipe(rename( {suffix: '.min'} ))
        .pipe(dest(`${pathAssets}/js/`))
        .pipe(browserSync.stream());
}

// Task build style elementor
async function buildStylesElementor() {
    return src(`${pathAssetsScss}/elementor-addon/elementor-addon.scss`)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(dest(`./extension/elementor-addon/css/`))
        .pipe(sourcemaps.init())
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        .pipe(sourcemaps.write())
        .pipe(dest(`./extension/elementor-addon/css/`))
        .pipe(browserSync.stream());
}

async function buildJSElementor() {
    return src([
        './extension/elementor-addon/js/*.js',
        '!./extension/elementor-addon/js/*.min.js'
    ], {allowEmpty: true})
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(dest('./extension/elementor-addon/js/'))
        .pipe(browserSync.stream());
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

    await buildStylesTheme()
    await buildTemplateStyles()
    await buildPostType()
    await buildJSTheme()

    await buildStylesElementor()
    await buildJSElementor()

    browserSync.reload()
}
exports.buildAll = buildAll

// watch
async function watchRun() {
    server()

    watch([
        `${pathAssetsScss}/variables-site/*.scss`,
        `${pathAssetsScss}/bootstrap.scss`
    ], buildStylesBootstrap)

    watch([
        `${pathAssetsScss}/variables-site/*.scss`,
        `${pathAssetsScss}/base/*.scss`,
        `${pathAssetsScss}/style-theme.scss`,
    ], buildStylesTheme)

    watch([
        `${pathAssetsScss}/variables-site/*.scss`,
        `${pathAssetsScss}/components/*.scss`,
        `${pathAssetsScss}/templates/*.scss`
    ], buildTemplateStyles)
    
    watch([
        `${pathAssetsScss}/variables-site/*.scss`,
        `${pathAssetsScss}/components/*.scss`,
        `${pathAssetsScss}/post-type/*/**.scss`
    ], buildPostType)

    watch([
        `${pathAssetsScss}/variables-site/*.scss`,
        `${pathAssetsScss}/elementor-addon/*.scss`
    ], buildStylesElementor)

    watch([`${pathAssets}/js/**.js`, `!${pathAssets}/js/**.min.js`], buildJSTheme)

    watch([
        './extension/elementor-addon/js/*.js',
        '!./extension/elementor-addon/js/*.min.js'
    ], buildJSElementor)

    watch([
        './*.php',
        './**/*.php',
        './assets/images/*/**.{png,jpg,jpeg,gif}'
    ], browserSync.reload);
}

exports.watchRun = watchRun;