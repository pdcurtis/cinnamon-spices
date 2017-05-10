'use strict';

var sourcemaps = require('gulp-sourcemaps'),
    concat = require('gulp-concat');

const paths = require('../options/paths');

module.exports = (gulp) => {

    gulp.task('js', () => {
        return gulp.src(paths.js.src)
            .pipe(concat('index.js'))
            .pipe(sourcemaps.write('./'))
            .pipe(gulp.dest('./'));
    });

}
