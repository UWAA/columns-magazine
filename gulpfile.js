var gulp = require('gulp');
var less = require('gulp-less');
var rename = require("gulp-rename");
var watch = require('gulp-watch');
var uglify = require('gulp-uglifyjs');
var header = require('gulp-header');
var concat = require('gulp-concat');
var foreach = require('gulp-foreach');
var minifyCss = require('gulp-minify-css');
var mainBowerFiles = require('main-bower-files');
// var sourcemaps = require('gulp-sourcemaps');




var pkg = require('./package.json');
var banner = ['/*',
  ' Theme Name: <%= pkg.name %>',
  ' Theme Uri: <%= pkg.authorUri %>',
  ' Description: <%= pkg.description %>',
  ' Author: <%= pkg.author %>',
  ' Template: <%= pkg.template %>',
  ' Version: <%= pkg.version %>',
  ' License: <%= pkg.license %>',
  ' */',
  ''].join('\n');


var mainFiles = mainBowerFiles();


// Catches errors.  Will play a system tone and display your mistake.
function catchErrors(error){
console.log(error);
}

var paths = {
  scripts: {
    support: ['./js/support/*.js', '!./js/support/*.min.js'],
  }
}

gulp.task('default', function() {
  
});


// Builds both dev and minified version of our JS files.
gulp.task('scripts', function() {

  
  gulp.src([ './js/_*.js'])
    .pipe(concat('columns.site.dev.js'))
    .on('error', catchErrors)
    .pipe(gulp.dest('./js'));

  gulp.src([ './js/admin/_*.js'])
      .pipe(concat('admin.dev.js'))
      .on('error', catchErrors)
      .pipe(gulp.dest('./js/admin'));

 gulp.src(paths.scripts.support)
 .pipe(foreach(function(stream, file){
    return stream
    .pipe(rename(function (path){
      path.basename += ".min";
      path.extname = ".js";
    }))
    .pipe(uglify({
      mangle: true,
      output: {
        beautify: false
      }
    }))    
    .on('error', catchErrors)
  }))
    .pipe(gulp.dest('./js/support'));

  gulp.src(['./js/_*.js'])
    .pipe(uglify('columns.site.js', {
      mangle: true,
      output: {
        beautify: false
      }
    }))
    .on('error', catchErrors)
    .pipe(gulp.dest('./js'));

gulp.src(['./js/admin/_*.js'])
    .pipe(uglify('admin.js', {
      mangle: true,
      output: {
        beautify: false
      }
    }))
    .on('error', catchErrors)
    .pipe(gulp.dest('./js/admin'));
});



gulp.task('less', function () {
     gulp.src('./less/style.less')
    .pipe(less())
    .pipe(minifyCss())
    .pipe(header(banner, { pkg : pkg } ))

    .on('error', catchErrors)    
    .pipe(gulp.dest('./'));

    gulp.src('./less/style.less')    
    .pipe(header(banner, { pkg : pkg } ))
    .pipe(less())
    .pipe(rename("style.dev.css"))    
    .on('error', catchErrors)     
    .pipe(gulp.dest('./'));

    gulp.src('./less/admin/admin.less')     
    .pipe(less())
    .pipe(minifyCss())
    .on('error', catchErrors)     
    .pipe(gulp.dest('./'));


  });

gulp.task('watch', function () {
    gulp.watch('less/**/*.less', ['less']);
    gulp.watch(['js/_*.js', 'js/admin/_*.js', 'js/support/*.js', '!js/support/*.min.js'], ['scripts']);
});

gulp.task('error', function () {
  catchErrors('Test');
});


gulp.task('library', function() {
    gulp.src(mainBowerFiles(/* options */), { base: 'bower_components' })
    .pipe(gulp.dest('./js/libraries'));

    //Unslider Components
    gulp.src('./bower_components/unslider/dist/js/unslider-min.js')
      .pipe(gulp.dest('./js/libraries/unslider/'));

    gulp.src('./bower_components/unslider/src/css/*')    
       .pipe(gulp.dest('./less/unslider'));

    gulp.src('./bower_components/unslider/src/css/unslider/*')    
       .pipe(gulp.dest('./less/unslider/unslider'));

    //Flickity

    // gulp.src('./bower_components/flickity/dist/flickity.css')
      // .pipe(gulp.dest('./less/flickity.less'));


});
 
 