'use strict';

var sourcemaps = require('gulp-sourcemaps'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify');

const paths = require('../options/paths');

module.exports = (gulp) => {

    gulp.task('js:dev', () => {
        return gulp.src(paths.js.src)
            .pipe(sourcemaps.init())
            .pipe(concat('index.js'))
            .pipe(sourcemaps.write('./'))
            .pipe(gulp.dest('./'));
    });

    gulp.task('js:release', () => {
        return gulp.src(paths.js.src)
            .pipe(concat('index.js'))
            .pipe(uglify())
            .pipe(gulp.dest('./'));
    });

}
