'use strict';

var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var sassLint = require('gulp-sass-lint');
var rename = require('gulp-rename');
var prefixer = require('gulp-autoprefixer');

const paths = require('../options/paths');
const sassLintRules = require('../options/sass-lint-rules');

module.exports = (gulp) => {

    gulp.task('style:lint', () => {
        return gulp.src(paths.style.src_watch)
            .pipe(sassLint({rules: sassLintRules}))
            .pipe(sassLint.format())
            .pipe(sassLint.failOnError());
    });

    gulp.task('style:dev', () => {
        return gulp.src(paths.style.src)
            .pipe(sourcemaps.init())
            .pipe(sass()
                .on('error', sass.logError))
            .pipe(prefixer({
              browsers: ['last 2 versions'],
              cascade: true }))
            .pipe(rename('style.css'))
            .pipe(sourcemaps.write('./'))
            .pipe(gulp.dest(paths.style.dist))
    });

    gulp.task('style:release', () => {
        return gulp.src(paths.style.src)
            .pipe(sass({outputStyle: 'compressed'})
                .on('error', sass.logError))
            .pipe(prefixer({
              browsers: ['last 2 versions'],
              cascade: true }))
            .pipe(rename('style.css'))
            .pipe(gulp.dest(paths.style.dist));
    });

}
