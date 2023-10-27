'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const minifyCss = require('gulp-clean-css');
const concatCss = require('gulp-concat-css');

function compilerFolderCss(folder) {
  return gulp.src(`./assets/scss/${folder}/*.scss`)
      .pipe(sourcemaps.init())
      .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
      .pipe(sourcemaps.write())
      .pipe(gulp.dest(`./assets/css/${folder}`));
}

// Task compress mini library css theme
async function compressLibraryCssMin() {
  return gulp.src([
    './node_modules/bootstrap/dist/css/bootstrap.css',
    './node_modules/slick-carousel/slick/slick.css',
    './node_modules/lity/dist/lity.css'
  ]).pipe(concatCss("library.min.css"))
      .pipe(minifyCss({
        compatibility: 'ie8',
        level: {1: {specialComments: 0}}
      }))
      .pipe(gulp.dest('./assets/css/'));
}
exports.compressLibraryCssMin = compressLibraryCssMin

// Task build styles
async function buildStyles() {
  return gulp.src('./assets/scss/style.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./'));
}
exports.buildStyles = buildStyles;

// Task build post type
async function buildPostType() {
  compilerFolderCss('post-type')
}
exports.buildPostType = buildPostType

// Task compress lib js & mini file
async function compressLibraryJsMin() {
  return gulp.src([
    './node_modules/bootstrap/dist/js/bootstrap.bundle.js',
    './node_modules/slick-carousel/slick/slick.js',
    './node_modules/imagesloaded/imagesloaded.pkgd.js',
    './node_modules/masonry-layout/dist/masonry.pkgd.js',
    './node_modules/lity/dist/lity.js'
  ], {allowEmpty: true})
    .pipe(concat('library.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./assets/js/'));
}
exports.compressLibraryJsMin = compressLibraryJsMin

// Build all
async function buildAll() {
  await compressLibraryCssMin()
  await buildStyles()
  await buildPostType()
  await compressLibraryJsMin()

}
exports.buildAll = buildAll

// watch
async function watchRun() {
  return gulp.watch('./assets/scss/**/*.scss', buildStyles)
}
exports.watchRun = watchRun;