'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const minifyCss = require('gulp-clean-css');
const concatCss = require('gulp-concat-css');

// Task build styles
function buildStyles() {
  return gulp.src('./assets/scss/style.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./'));
}

exports.buildStyles = buildStyles;
exports.watch = function () {
  gulp.watch('./assets/scss/**/*.scss', buildStyles)
};

// Task compress mini library css theme
function compressLibraryCssMin() {
  return gulp.src([
    './node_modules/bootstrap/dist/css/bootstrap.css',
    './node_modules/owl.carousel/dist/assets/owl.carousel.css',
    './node_modules/slick-carousel/slick/slick.css'
  ]).pipe(concatCss("library.min.css"))
    .pipe(minifyCss({
      compatibility: 'ie8',
      level: {1: {specialComments: 0}}
    }))
    .pipe(gulp.dest('./assets/css/'));
}

exports.compressLibraryCssMin = compressLibraryCssMin

// Task compress lib js & mini file
function compressLibraryJsMin() {
  return gulp.src([
    './node_modules/bootstrap/dist/js/bootstrap.bundle.js',
    './node_modules/owl.carousel/dist/owl.carousel.js',
    './node_modules/slick-carousel/slick/slick.js',
    './node_modules/masonry-layout/dist/masonry.pkgd.js',
    './node_modules/imagesloaded/imagesloaded.js',
  ], {allowEmpty: true})
    .pipe(concat('library.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./assets/js/'));
}

exports.compressLibraryJsMin = compressLibraryJsMin