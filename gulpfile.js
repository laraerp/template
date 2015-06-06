var gulp = require('gulp');
var less = require('gulp-less');
var minifyCss = require("gulp-minify-css");
var uglify = require("gulp-uglify");
var concat = require("gulp-concat");


gulp.task('less', function(){
    return gulp.src([
        './src/resources/assets/less/styles.less',
        './node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css',
        './node_modules/dropzone/dist/min/dropzone.min.css'
    ]).pipe(less())
        .pipe(minifyCss())
        .pipe(concat('styles.css'))
        .pipe(gulp.dest('./src/public/css'));
});

gulp.task('minify-js', function () {
    return gulp.src([
        './node_modules/jquery/dist/jquery.min.js',
        './node_modules/bootstrap/dist/js/bootstrap.min.js',
        './node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
        './node_modules/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js',
        './node_modules/jquery-mask-plugin/dist/jquery.mask.min.js',
        './node_modules/dropzone/dist/min/dropzone.min.js',
        './src/resources/assets/js/*.js'
    ]).pipe(uglify())
        .pipe(concat('scripts.js'))
        .pipe(gulp.dest('./src/public/js'));
});

gulp.task('fonts', function() {
    return gulp.src('./node_modules/bootstrap/dist/fonts/*')
        .pipe(gulp.dest('./src/public/fonts'));
});


gulp.task('default', ['less', 'minify-js', 'fonts']);
