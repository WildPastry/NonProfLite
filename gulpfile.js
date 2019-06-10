var gulp = require('gulp');
var postcss = require('gulp-postcss');
var less = require('gulp-less');
var autoprefixer = require('autoprefixer');
var cssnano = require('cssnano');
var concat = require('gulp-concat');

gulp.task('css', function() {
	var processors = [autoprefixer, cssnano];
	return gulp
		.src('assets/less/**/*.less')
		.pipe(concat('nonproflite'))
		.pipe(less())
		.pipe(postcss(processors))
		.pipe(gulp.dest('assets/css'));
});
