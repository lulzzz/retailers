//=====================================================//
//## JAVASCRIPT CORE FILES
//=====================================================//

// CORE / JavaScript
//
// Merge all core .js files. These files are treated as runtime .js files.
// They will run onload in <head>. 

module.exports = function (gulp, plugins) {
  return function () {
    gulp.src([
        'resources/assets/javascript/proxy/core.js'])
    .pipe(plugins.plumber())
    .pipe(plugins.include())
    .pipe(plugins.uglify())
    .pipe(plugins.plumber.stop())
    .pipe(plugins.rename({ extname: ".min.js" }))
    .pipe(plugins.filesize())
    .on("error", console.log)
    .pipe(gulp.dest('public/proxy/js/'));
  };
};
