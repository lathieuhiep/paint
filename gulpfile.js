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

// Hàm để lấy tên miền localhost
const execSync = require('child_process').execSync;
function getLocalhostDomain() {
    const hostname = execSync('hostname').toString().trim();

    return `localhost/${hostname}`;
}

// server
const domain = getLocalhostDomain();
function server() {
    browserSync.init({
        proxy: domain,
        open: false,
        cors: true,
        ghostMode: false
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
function compilerFolderScss(folder) {
    return src(`${pathAssetsScss}/${folder}/*/**.scss`)
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
    compilerFolderScss('post-type')
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
        './assets/scss/components/*.scss',
        './assets/scss/templates/*.scss'
    ], buildTemplateStyles)
    watch([
        './assets/scss/components/*.scss',
        './assets/scss/post-type/**/*.scss'
    ], buildPostType)
}

exports.watchRun = watchRun;