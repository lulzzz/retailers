//=====================================================//
// ## SASS / SCSS / Liquid
//=====================================================//

// THEME WEBSITE (FRONT-END)
//
// See the 'theme.scss' file for the entire breakdown.
// Merging stylesheets from bower components in here too. 

module.exports = function (gulp, plugins) {
  return function () {

    var supported     = [
    'Android >= 2.3',
    'BlackBerry >= 7',
    'Chrome >= 9',
    'Firefox >= 4',
    'Explorer >= 9',
    'iOS >= 5',
    'Opera >= 11',
    'Safari >= 5',
    'OperaMobile >= 11',
    'OperaMini >= 6',
    'ChromeAndroid >= 9',
    'FirefoxAndroid >= 4',
    'ExplorerMobile >= 9' 
    ];

    gulp.src('resources/assets/sass/stylesheet.scss')
    .pipe(plugins.sass({outputStyle: 'uncompressed'}).on('error', plugins.sass.logError))
    .pipe(plugins.cssnano({
     autoprefixer: {browsers: supported, add: true}
    }))
    .pipe(plugins.rename('stylesheet.min.css'))
    .pipe(plugins.filesize())
    .pipe(gulp.dest('public/css/'));
  };
};