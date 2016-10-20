//=====================================================//
//## BOWER COMPONENTS 
//=====================================================//

// :: VENDORS JS COMPONENT FILES
//
// See the Bower.json file overrides for additions.
// Task will also move all components files from bower for later concatenation/s.
// Run "gulp bower" Manually, this ain't part of default task.

var mainBowerFiles = require('main-bower-files'); 

module.exports = function (gulp, plugins) {
  return function () {
    gulp.src(mainBowerFiles('**/*.js'))
    .pipe(plugins.uglify())
    .pipe(plugins.plumber.stop())
    .on("error", console.log)
    .pipe(gulp.dest('resources/assets/javascript/vendors/'));
  };
};