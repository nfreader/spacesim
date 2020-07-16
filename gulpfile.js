// Sass configuration
var gulp = require('gulp');
var sass = require('gulp-dart-sass');
var cleanCSS = require('gulp-clean-css');

gulp.task('sass', function(cb) {
  gulp
    .src('resources/styles/src/**/*.scss')
    .pipe(sass({output: 'compressed'}).on('error', sass.logError))
    .pipe(gulp.dest('public/assets/css/'));
  cb();
});
gulp.task('minify', function(cb) {
  gulp
    .src('public/assets/css/style.css')
    .pipe(cleanCSS())
    .pipe(gulp.dest('public/assets/css/'));
  cb();
});

gulp.task(
  'default',
  gulp.series('sass', function(cb) {
    gulp.watch('resources/styles/src/**/*.scss', gulp.series('sass'));
    gulp.watch('public/assets/css/style.css', gulp.series('minify'));
    cb();
  })
);