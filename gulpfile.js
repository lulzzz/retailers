//=====================================================//
//## PLUGINS
//=====================================================//

var gulp = require('gulp');
var plugins = require('gulp-load-plugins')();

//=====================================================//
// ## SASS / SCSS / Liquid
//=====================================================//
gulp.task('sass-admin', require('./gulp_tasks/sass-admin.js')(gulp, plugins));
gulp.task('sass-proxy', require('./gulp_tasks/sass-proxy.js')(gulp, plugins));
gulp.task('sass-site', require('./gulp_tasks/sass-site.js')(gulp, plugins));


//=====================================================//
//## JAVASCRIPT / jQuery / JavaScript / Liquid
//=====================================================//
gulp.task('js-core', require('./gulp_tasks/js-core.js')(gulp, plugins));
gulp.task('js-modules', require('./gulp_tasks/js-modules.js')(gulp, plugins));
gulp.task('js-views', require('./gulp_tasks/js-views.js')(gulp, plugins));
gulp.task('js-proxy', require('./gulp_tasks/js-proxy.js')(gulp, plugins));
gulp.task('js-blade', require('./gulp_tasks/js-blade.js')(gulp, plugins));

//=====================================================//
//## BOWER / Import Bower Components / Minify / Vendors
//=====================================================//

gulp.task('bower', require('./gulp_tasks/bower.js')(gulp, plugins));


//=====================================================//
//## GULP WATCH
//=====================================================//

// ## Watch Directories

gulp.task('watch', function () {

	// Watch SASS and LIQUID SASS Files and Directories
	gulp.watch([
		'resources/assets/sass/**/**/*.scss',
		'resources/assets/sass/proxy.scss'], ['sass-admin']);
	gulp.watch([
		'resources/assets/sass/**/**/*.scss',
		'resources/assets/sass/stylesheet.scss'], ['sass-proxy']);

		gulp.watch([
			'resources/assets/sass/**/**/**/*.scss',
			'resources/assets/sass/site.scss'], ['sass-site']);


	// Watch JAVASCRIPT Files and Directories
	gulp.watch([
		'resources/assets/javascript/**/*.js',
		'!resources/assets/javascript/modules/*',
		'!resources/assets/javascript/templates/*'], ['js-core']);

	gulp.watch([
		'resources/assets/javascript/proxy/**/*.js',
		'!resources/assets/javascript/proxy/blade/*.js'], ['js-proxy']);

	gulp.watch([
		'resources/assets/javascript/proxy/blade/**/*.js',
		'resources/assets/javascript/proxy/views/*.js',
		], ['js-blade']);



	// Watch JAVASCRIPT Files and Directories
	gulp.watch(['resources/assets/javascript/modules/*.js'], ['js-modules']);

	// Watch JAVASCRIPT Files and Directories
	gulp.watch(['resources/assets/javascript/views/*.js'], ['js-views']);

	});


//=====================================================//
//## RUN GULP TASK
//=====================================================//

gulp.task('default', ['watch']);


//--------- MIT License ----------//
// Do what the fuck you want license.
//
// Stream via @heynicos
