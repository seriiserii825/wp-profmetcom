var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var reload      = browserSync.reload;

// Save a reference to the `reload` method

// Watch scss AND html files, doing different things with each.
gulp.task('default', function () {
    var files = [
        './style.css',
        './*.php',
        './template-parts/*.php',
        './inc/*.php'
    ];

    // Serve files from the root of this project
    browserSync.init(files, {
        proxy: "wp-profmetcom/",
        notify: true
    });

    gulp.watch("./**/*.php").on("change", reload);
    gulp.watch("./**/*.css").on("change", reload);
    gulp.watch("./**/*.js").on("change", reload);
});

