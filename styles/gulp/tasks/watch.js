'use strict';

const paths = require('../options/paths');

module.exports = (gulp) => {
    gulp.task('watch', () => {
        gulp.watch(paths.style.src_watch, ['style:lint', 'style:dev']);
        gulp.watch(paths.js.src, ['js']);
    });
}
