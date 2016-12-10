var gulp = require('gulp'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    LessPluginCleanCSS = require('less-plugin-clean-css'),
    cleancss = new LessPluginCleanCSS({advanced: true}),
    less = require('gulp-less'),
    imagemin = require('gulp-imagemin'),
    sourcemaps = require('gulp-sourcemaps'),
    use_sourcemaps = true;


// LESS compilation
gulp.task('less', function () {
    var pipe = gulp.src('./less/style.less');
    if (use_sourcemaps) {
        pipe = pipe.pipe(sourcemaps.init());
    }
    pipe = pipe
        .pipe(less({
            plugins: [cleancss]
        }))
        .pipe(rename({suffix: '.min'}));
    if (use_sourcemaps) {
        pipe = pipe.pipe(sourcemaps.write('maps'));
    }
    return pipe
        .pipe(gulp.dest('./assets/css/'))
        .on('error', errorHandler);
});

// Optimisation des images
gulp.task('images', function () {
    return gulp.src(['assets/images/*'])
        .pipe(imagemin({
            progressive: true
        }))
        .pipe(gulp.dest('assets/images/')).on('error', errorHandler);
});

gulp.task('default', ['less']);
gulp.task('watch', function () {
    gulp.watch(['./less/*'], ['less']);
    gulp.watch(['./assets/images/*'], ['images']);
});

// Handle the error
function errorHandler(error) {
    console.log(error.toString());
    this.emit('end');
}
