'use strict';

const gulp = require('gulp');

require('./styles/gulp/tasks/style')(gulp);
require('./styles/gulp/tasks/watch')(gulp);

gulp.task('default', ['style:lint','style:dev', 'watch']);
gulp.task('release', ['style:release']);
