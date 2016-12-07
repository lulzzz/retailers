//=====================================================//
//## PLUGINS
//=====================================================//

var gulp = require('gulp');
var plugins = require('gulp-load-plugins')();

//=====================================================//
// ## SASS / SCSS / Liquid
//=====================================================//
gulp.task('sass:app', require('./gulp_tasks/sass-app.js')(gulp, plugins));
gulp.task('sass:proxy', require('./gulp_tasks/sass-proxy.js')(gulp, plugins));
gulp.task('sass:site', require('./gulp_tasks/sass-site.js')(gulp, plugins));

//=====================================================//
//## JAVASCRIPT / jQuery / JavaScript / Liquid
//=====================================================//
gulp.task('js:app-core', require('./gulp_tasks/js-app--core.js')(gulp, plugins));
gulp.task('js:app-modules', require('./gulp_tasks/js-app--modules.js')(gulp, plugins));
gulp.task('js:app-views', require('./gulp_tasks/js-app--views.js')(gulp, plugins));

gulp.task('js:proxy-core', require('./gulp_tasks/js-proxy--core.js')(gulp, plugins));
gulp.task('js:proxy-blade', require('./gulp_tasks/js-proxy--blade.js')(gulp, plugins));
gulp.task('js:proxy-map', require('./gulp_tasks/js-proxy--map.js')(gulp, plugins));

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
		'resources/assets/app/sass/**/**/*.scss',
		'resources/assets/app/sass/stylesheet.scss'], ['sass:app']
	);

	gulp.watch([
		'resources/assets/proxy/sass/**/**/*.scss',
		'resources/assets/proxy/sass/stylesheet.scss'], ['sass:proxy']
	);

	gulp.watch([
		'resources/assets/site/sass/**/**/**/*.scss',
		'resources/assets/site/sass/stylesheet.scss'], ['sass:site']
	);


	// Watch JAVASCRIPT Files and Directories
	gulp.watch([
		'resources/assets/app/javascript/*.js',
		'resources/assets/app/javascript/components/*.js'], ['js:app-core']
	);
	gulp.watch(['resources/assets/app/javascript/modules/*.js'], ['js:app-modules']);
	gulp.watch(['resources/assets/app/javascript/views/*.js'], ['js:app-views']);

	gulp.watch([
		'resources/assets/proxy/javascript/**/*.js',
		'!resources/assets/proxy/javascript/blade/*.js',
		'!resources/assets/proxy/javascript/blade/*.js'], ['js:proxy-core']
	);
	gulp.watch([
		'resources/assets/javascript/proxy/blade/**/*.js',
		'resources/assets/javascript/proxy/views/*.js'], ['js:proxy-blade']
	);
	gulp.watch([
		'resources/assets/proxy/javascript/map/**/*.js'], ['js:proxy-map']
	);

});


//=====================================================//
//## RUN GULP TASK
//=====================================================//

gulp.task('default', ['watch']);


//--------- MIT License ----------//
// Do what the fuck you want license.
//
// Stream via @heynicos
