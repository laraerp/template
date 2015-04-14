var gulp = require('gulp');
var less = require('gulp-less');
var minifyCss = require("gulp-minify-css");
var uglify = require("gulp-uglify");
var concat = require("gulp-concat");


gulp.task('less', function(){
    return gulp.src('./src/resources/assets/less/styles.less')
        .pipe(less())
        .pipe(minifyCss())
        .pipe(gulp.dest('./src/public'));
});

gulp.task('minify-js', function () {
    return gulp.src([
            './node_modules/jquery/dist/jquery.min.js',
    		'./node_modules/bootstrap/dist/js/bootstrap.min.js',
    		'./src/resources/assets/js/*.js'
    ]).pipe(uglify())
      .pipe(concat('scripts.js'))
      .pipe(gulp.dest('./src/public'));
});

gulp.task('fonts', function() {
    return gulp.src('./node_modules/bootstrap/dist/fonts/*')
    .pipe(gulp.dest('./src/public/fonts'));
});


gulp.task('default', ['less', 'minify-js', 'fonts']);