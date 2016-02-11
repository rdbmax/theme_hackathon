var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');

var autoprefixOptions = {
  browsers: ['last 2 versions', '> 5%']
};

var input = {
				'sass'	: 'app/sass/*.scss',
				'js'	: 'app/js/*.js'
			};

var output = {
				'css'	: 'dist/css',
				'js'	: 'dist/js'
			};


gulp.task('sass', function () {
  return gulp
    .src(input.sass)
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(sourcemaps.write())
    .pipe(autoprefixer(autoprefixOptions))
    .pipe(gulp.dest(output.css));
});