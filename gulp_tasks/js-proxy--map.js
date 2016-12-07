module.exports = function (gulp, plugins) {
  return function () {
    gulp.src([
        'resources/assets/proxy/javascript/map/map.js'])
    .pipe(plugins.plumber())
    .pipe(plugins.include())
    .pipe(plugins.uglify())
    .pipe(plugins.plumber.stop())
    .pipe(plugins.rename({
      extname: ".min.js"
    }))
    .pipe(plugins.filesize())
    .on("error", console.log)
    .pipe(gulp.dest('public/assets/proxy/js/'));
  };
};
