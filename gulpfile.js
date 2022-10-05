const gulp = require('gulp');
const sass = require('gulp-dart-sass');

const autoprefixer = require('gulp-autoprefixer');
const babelify = require('babelify');
const browserify = require('browserify');
const source = require('vinyl-source-stream');
const buffer = require('vinyl-buffer');
const uglify = require('gulp-uglify');
const sourcemaps = require('gulp-sourcemaps');
const minify = require('gulp-clean-css');
const gutil = require('gulp-util');
const gulpif = require('gulp-if');
const minimist = require('minimist');
const bs = require('browser-sync').create();
const plumber = require('gulp-plumber');
const notify = require('gulp-notify');

const DIST_DIRECTORY = './dist';
const DEV_DIRECTORY = './dev';
const ADMIN_SCSS_DIRECTORY = './library/admin-style/*.scss';
const SCSS_DIRECTORY = './library/scss/**/*.scss';
const JAVASCRIPT_DIRECTORY = './library/js/**/*.js';
const JAVASCRIPT_APP = './library/js/app.js';

const knownOptions = {
  string: [
    'live',
    'env'
  ]
};

const options = minimist(process.argv.slice(2), knownOptions);

function stylesheet () {
  return gulp.src(SCSS_DIRECTORY)
    .pipe(plumber({
      errorHandler: notify.onError({
        message: 'Error: <%= error.message %>',
        sound: 'Submarine' // deactivate sound?
      })
    }))
    .pipe(gulpif(options.env !== 'production', sourcemaps.init()))
    .pipe(sass({
      includePaths: ['node_modules/foundation-sites/scss']
    }))
    .pipe(autoprefixer({
      cascade: false,
      flexbox: true,
      remove: false
    }))
    .on('error', gutil.log)
    .pipe(minify())
    .pipe(gulpif(options.env !== 'production', sourcemaps.write('./')))
    .pipe(gulp.dest(!options.env ? `${DEV_DIRECTORY}/css/` : `${DIST_DIRECTORY}/css/`))
    .pipe(gulpif(options.env !== 'production' && options.live === 'true', bs.reload({ stream: true })));
}

function adminStylesheet () {
  return gulp.src(ADMIN_SCSS_DIRECTORY)
    .pipe(autoprefixer({
      cascade: false,
      flexbox: true,
      remove: false
    }))
    .pipe(sass())
    .pipe(minify())
    .pipe(gulp.dest('./'));
}

function javascript () {
  return browserify({
    entries: JAVASCRIPT_APP,
    debug: true,
    sourceMaps: true,
    paths: ['./node_modules', './library/js']
  })
  .transform("babelify", {
    global: true,
    presets: ["@babel/preset-env"],
}
  )
    .bundle()
    .on('error', notify.onError('Error: <%= error.message %>'))
    .pipe(source('app.js'))
    .pipe(buffer())
    .pipe(gulpif(options.env !== 'production', sourcemaps.init({ loadMaps: true })))
    // .pipe(uglify())
    .pipe(gulpif(options.env !== 'production', sourcemaps.write('./')))
    .pipe(gulp.dest(!options.env ? `${DEV_DIRECTORY}/js/` : `${DIST_DIRECTORY}/js/`))
    .pipe(gulpif(options.env !== 'production' && options.live === 'true', bs.reload({ stream: true })));
}

function watch (done) {
  gulp.watch(SCSS_DIRECTORY, gulp.series(stylesheet));
  gulp.watch(JAVASCRIPT_DIRECTORY, gulp.series(javascript));
  done();
}

function bsWatch (done) {
  gulp.watch(SCSS_DIRECTORY, gulp.series(stylesheet));
  gulp.watch(JAVASCRIPT_DIRECTORY, gulp.series(javascript));
  gulp.watch('./**/*.php').on('change', bs.reload);
  done();
}

function serve (done) {
  bs.init({
    proxy: 'http://updatewordpress.local'
  });
  done();
}

// Default Task defult just allows you to write gulp
gulp.task('default', gulp.series(javascript, stylesheet, watch));
gulp.task('bs', gulp.series(javascript, stylesheet, serve, bsWatch));
gulp.task('build', gulp.series(stylesheet, javascript));
gulp.task('admin', gulp.series(adminStylesheet));
