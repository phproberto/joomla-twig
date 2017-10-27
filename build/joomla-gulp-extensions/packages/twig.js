var gulp = require('gulp');

var config = require('../../gulp-config.json');

// Dependencies
var browserSync = require('browser-sync');
var del         = require('del');

var packageName        = 'twig';

var baseTask           = 'packages.' + packageName;
var extPath            = '../extensions';
var wwwManifestsFolder = config.wwwDir + '/administrator/manifests/packages';
var wwwInstallerFolder = wwwManifestsFolder + '/' + packageName;
var manifestFile       = 'pkg_' + packageName + '.xml';
var installerFile      = 'install.php';

// Clean
gulp.task('clean:' + baseTask,['clean:' + baseTask + ':installer', 'clean:' + baseTask + ':manifest'],
	function() {
		return true;
});

// Clean: installer
gulp.task('clean:' + baseTask + ':installer', function(cb) {
	return del(wwwInstallerFolder, {force : true});
});

// Clean: manifest
gulp.task('clean:' + baseTask + ':manifest', function(cb) {
	return del(wwwManifestsFolder + '/' + manifestFile, {force : true});
});

// Copy
gulp.task('copy:' + baseTask, [
		'copy:' + baseTask + ':installer',
		'copy:' + baseTask + ':manifest'
	],function() {
		return true;
});

// Copy: installer
gulp.task('copy:' + baseTask + ':installer', ['clean:' + baseTask + ':installer'], function() {
	return gulp.src(extPath + '/' + installerFile)
		.pipe(gulp.dest(wwwInstallerFolder));
});

// Copy: manifest
gulp.task('copy:' + baseTask + ':manifest', ['clean:' + baseTask + ':manifest'], function() {
	return gulp.src(extPath + '/' + manifestFile)
		.pipe(gulp.dest(wwwManifestsFolder));
});

// Watch
gulp.task('watch:' + baseTask,[
		'watch:' + baseTask + ':installer',
		'watch:' + baseTask + ':manifest'
	],
	function() {
		return true;
});

// Watch: installer
gulp.task('watch:' + baseTask + ':installer', function() {
	gulp.watch(extPath + '/' + installerFile, ['copy:' + baseTask + ':installer']);
});

// Watch: manifest
gulp.task('watch:' + baseTask + ':manifest', function() {
	gulp.watch(extPath + '/' + manifestFile, ['copy:' + baseTask + ':manifest']);
});
