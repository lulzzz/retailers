//=====================================================//
//## TEMPLATE SPECIFIC JAVASCRIPT FILES
//=====================================================//


// Javascripts to load on runtime of each Template. The code
// will be relvelent to the template (page).

var merge = require('merge-stream');

module.exports = function (gulp, plugins) {
  return function () {
   var Blade =  gulp.src([
     'resources/assets/proxy/javascript/blade/**/*.js',
     '!resources/assets/proxy/javascript/blade/_min/*.js'
    ])
   .pipe(plugins.plumber())
   .pipe(plugins.uglify())
   .pipe(plugins.plumber.stop())
   .pipe(plugins.filesize())
   .on("error", console.log)
   .pipe(gulp.dest('resources/assets/proxy/javascript/blade/_min/'));

   var Snippet = gulp.src('resources/assets/proxy/javascript/views/*.js')
   .pipe(plugins.include())
   .pipe(plugins.rename({
    extname: ".blade.php"
  }))
   .pipe(gulp.dest('resources/views/proxy/skriptz/'));

   return merge(Blade, Snippet);
 };
};
