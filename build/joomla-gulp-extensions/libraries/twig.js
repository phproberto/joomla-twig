var gulp = require('gulp');

var config = require('../../gulp-config.json');

// Dependencies
var browserSync = require('browser-sync');
var del         = require('del');

var libraryName = 'twig';

var baseTask        = 'libraries.' + libraryName;
var extPath         = '../extensions/libraries/' + libraryName;
var manifestFile    = libraryName + '.xml';
var assetsPath      = './media/libraries/' + libraryName;
var nodeModulesPath = './node_modules';

var wwwManifestsFolder = config.wwwDir + '/administrator/manifests/libraries';
var wwwPath            = config.wwwDir + '/libraries/' + libraryName;

// Clean
gulp.task('clean:' + baseTask,
	[
		'clean:' + baseTask + ':library',
		'clean:' + baseTask + ':manifest'
	],
	function() {
});

// Clean: library
gulp.task('clean:' + baseTask + ':library', function(cb) {
	return del(wwwPath, {force : true});
});

// Clean: manifest
gulp.task('clean:' + baseTask + ':manifest', function(cb) {
	return del(wwwManifestsFolder + '/' + manifestFile, {force : true});
});


// Composer
gulp.task('composer:' + baseTask, function(cb) {
	composer({ cwd: extPath});
});

// Copy
gulp.task('copy:' + baseTask,
	[
		'copy:' + baseTask + ':library',
		'copy:' + baseTask + ':manifest'
	],
	function() {
});

// Copy: library
gulp.task('copy:' + baseTask + ':library',
	['clean:' + baseTask + ':library'], function() {
	return gulp.src([
		extPath + '/*(library.php)',
		extPath + '/form/**',
		extPath + '/language/**',
		extPath + '/src/**',
		extPath + '/vendor/**',
		'!' + extPath + '/vendor/**/doc',
		'!' + extPath + '/vendor/**/doc/**',
		'!' + extPath + '/vendor/**/docs',
		'!' + extPath + '/vendor/**/docs/**',
		'!' + extPath + '/vendor/**/test',
		'!' + extPath + '/vendor/**/test/**',
		'!' + extPath + '/vendor/**/tests',
		'!' + extPath + '/vendor/**/tests/**',
		'!' + extPath + '/vendor/**/Test',
		'!' + extPath + '/vendor/**/Test/**',
		'!' + extPath + '/vendor/**/Tests',
		'!' + extPath + '/vendor/**/Tests/**',
		'!' + extPath + '/vendor/**/composer.json',
		'!' + extPath + '/vendor/**/phpunit.*',
		'!' + extPath + '/vendor/**/build.php'
	],{ base: extPath })
	.pipe(gulp.dest(wwwPath));
});

// Copy: manifest
gulp.task('copy:' + baseTask + ':manifest', ['clean:' + baseTask + ':manifest'], function() {
	return gulp.src(extPath + '/' + manifestFile)
		.pipe(gulp.dest(config.wwwDir + '/administrator/manifests/libraries'));
});

// Watch
gulp.task('watch:' + baseTask,
	[
		'watch:' + baseTask + ':library',
		'watch:' + baseTask + ':manifest'
	],
	function() {
});

// Watch: library
gulp.task('watch:' +  baseTask + ':library', function() {
	gulp.watch([
			extPath + '/**/*',
			'!' + extPath + '/' + manifestFile,
		], ['copy:' + baseTask + ':library', browserSync.reload]);
});

// Watch: manifest
gulp.task('watch:' +  baseTask + ':manifest', function() {
	gulp.watch(extPath + '/' + manifestFile, ['copy:' + baseTask + ':manifest', browserSync.reload]);
});
