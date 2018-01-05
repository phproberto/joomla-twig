var gulp = require('gulp');

var extension = require('./package.json');
var config    = require('./gulp-config.json');

var requireDir = require('require-dir');
var zip        = require('gulp-zip');
var fs         = require('fs');
var xml2js     = require('xml2js');
var parser     = new xml2js.Parser();

var jgulp = requireDir('./node_modules/joomla-gulp', {recurse: true});
var dir = requireDir('./joomla-gulp-extensions', {recurse: true});

var rootPath = '../extensions';

// Override of the release script
gulp.task('release', function (cb) {
	fs.readFile( '../extensions/pkg_twig.xml', function(err, data) {
		parser.parseString(data, function (err, result) {
			var version = result.extension.version[0];

			var fileName = extension.name + '-v' + version + '.zip';

			return gulp.src([
					rootPath + '/**/*',
					'!' + rootPath + '/libraries/twig/vendor/twig/extensions/test',
					'!' + rootPath + '/libraries/twig/vendor/twig/extensions/test/**',
					'!' + rootPath + '/libraries/twig/vendor/twig/twig/test',
					'!' + rootPath + '/libraries/twig/vendor/twig/twig/test/**',
					'!' + rootPath + '/libraries/twig/vendor/**/docs/**/*',
					'!' + rootPath + '/libraries/twig/vendor/**/docs',
					'!' + rootPath + '/libraries/twig/vendor/**/doc/**/*',
					'!' + rootPath + '/libraries/twig/vendor/**/doc',
					'!' + rootPath + '/libraries/twig/vendor/**/composer.*',
					'!' + rootPath + '/libraries/twig/vendor/**/build.php',
					'!' + rootPath + '/libraries/twig/vendor/**/phpunit.*',
				],{ base: rootPath })
				.pipe(zip(fileName))
				.pipe(gulp.dest('releases'))
				.on('end', cb);
		});
	});
});
