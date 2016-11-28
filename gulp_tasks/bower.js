//=====================================================//
//## BOWER COMPONENTS
//=====================================================//

// :: VENDORS JS COMPONENT FILES
//
// See the Bower.json file overrides for additions.
// Task will also move all components files from bower for later concatenation/s.
// Run "gulp bower" Manually, this ain't part of default task.

var mainBowerFiles = require('main-bower-files');
var merge = require('merge-stream');

module.exports = function (gulp, plugins) {
  return function () {


  var bower = gulp.src(mainBowerFiles('**/*.js'))
    .pipe(plugins.uglify())
    .pipe(plugins.plumber.stop())
    .on("error", console.log)
    .pipe(gulp.dest('resources/assets/vendor/'));


    // Custom Bower Imports
    //
   var bootstrap = gulp.src('bower_components/bootstrap/js/dist/*.js')
    .pipe(plugins.uglify())
    .pipe(gulp.dest('resources/assets/vendor/bootstrap/'));

   return merge(bower, bootstrap);

  };
};
