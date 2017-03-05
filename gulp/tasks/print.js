'use strict';

const banner = require('../util/banner');

module.exports = (gulp, $, config, error) => {
  gulp.task('print', () => {
    return gulp.src(config.print.src)
    .pipe($.plumber({ errorHandler: error}))
    .pipe($.sourcemaps.init()) // Add Sourcemaps
    .pipe($.header(banner.full)) // Add the Occhio banner
    .pipe($.sassGlob()) // Use Sass globbing
    .pipe($.sassLint({ // Lint the Sass files
      options: {
        configFile: '/gulp/config/.sass-config.yml'
      }
    }))
    .pipe($.sassLint.format())
    .pipe($.sassLint.failOnError())
    .pipe($.sass({ // Compile Sass
      outputStyle: 'expanded'
    }))
    .pipe($.autoprefixer({ // Prefix css
      browsers: ['> 1%', 'last 3 versions'],
      cascade: false
    }))
    .pipe($.cssUrlAdjuster({ // Adjust img-urls in css to get new version
      prependRelative: '../img/',
      append: '?version=' + Date.now()
    }))

    .pipe($.sourcemaps.write('./'))
      .pipe($.cssmin())
      .pipe($.rename(config.print.destFile))
      .pipe(gulp.dest(config.dist + config.print.folder));
  });
};
