// gulp
var gulp = require('gulp');

// tools
var concat = require('gulp-concat');
var less = require('gulp-less');
var cssnano = require('cssnano');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var jshint = require('gulp-jshint');
var ts = require('gulp-typescript');
var tsProject = ts.createProject('tsconfig.json');
var uglify = require('gulp-uglify');
var font = require('postcss-font-magician');
var notify = require('gulp-notify');

// banner
var header = require('gulp-header');
var pkg = require('./package.json');
var banner = [
	'/**',
	' * <%= pkg.name %> - <%= pkg.description %>',
	' * @version v<%= pkg.version %>',
	' * @link <%= pkg.homepage %>',
	' * @author <%= pkg.author %>',
	' */',
	'',
].join('\n');

// less
gulp.task('less', function() {
	var processors = [
		autoprefixer,
		cssnano,
		font({
			foundries: ['google'],
		}),
	];
	return gulp
		.src('assets/less/**/*.less')
		.pipe(concat('nonproflite'))
		.pipe(less())
		.pipe(postcss(processors))
		.pipe(
			header(banner, {
				pkg: pkg,
			})
		)
		.pipe(notify('success'))
		.pipe(gulp.dest('assets/css'));
});

// ts
gulp.task('ts', function() {
	return tsProject
		.src()
		.pipe(tsProject())
		.js.pipe(gulp.dest('assets/js'));
});

// js lint
gulp.task('lint', function() {
	return gulp
		.src('assets/js/*.js')
		.pipe(jshint())
		.pipe(jshint.reporter('default'));
});

// js compress
gulp.task('compress', function() {
	return gulp
		.src('assets/js/*.js')
		.pipe(uglify())
		.pipe(gulp.dest('assets/js'));
});

// watchers
gulp.task('watch', function(event) {
	gulp.watch('assets/less/**/*.less', { usePolling: true }, gulp.series('less'));
	gulp.watch('assets/ts/*.ts', { usePolling: true }, gulp.series('ts', 'lint'));
	event();
});

// load tasks
gulp.task('default', gulp.series('ts', 'less', 'lint', 'compress', 'watch'));
