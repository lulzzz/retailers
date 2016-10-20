//=====================================================//
//## TEMPLATE SPECIFIC JAVASCRIPT FILES
//=====================================================//


// Javascripts to load on runtime of each Template. The code
// will be relvelent to the template (page). 

module.exports = function (gulp, plugins) {
  return function () {
    gulp.src(['resources/assets/javascript/views/*.js'])
    .pipe(plugins.plumber())
    .pipe(plugins.include())
    .pipe(plugins.uglify())
    .pipe(plugins.plumber.stop())
    .pipe(plugins.rename({ extname: ".min.js" }))
    .pipe(plugins.filesize())
    .on("error", console.log)
    .pipe(gulp.dest('public/js/views/'));
  };
};