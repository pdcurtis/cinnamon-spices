'use strict';

const gulp = require('gulp');

require('./styles/gulp/tasks/style')(gulp);
require('./styles/gulp/tasks/js')(gulp);
require('./styles/gulp/tasks/watch')(gulp);

gulp.task('default', ['style:lint','style:dev', 'js:dev', 'watch']);
gulp.task('release', ['style:release', 'js:release']);
