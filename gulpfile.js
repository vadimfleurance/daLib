var gulp = require('gulp'); 					//récupère le module gulp
var autoprefixer = require('gulp-autoprefixer'); //autopréfixe les propriétés css
var minifycss = require('gulp-minify-css'); 	//minifie le css
var rename = require("gulp-rename"); 			//renomme les fichiers (notamment extension .min.)
var uglify = require('gulp-uglify'); 			//minifie le js
var concat = require('gulp-concat'); 			//combine les fichiers js
var sass = require('gulp-sass');				//sass !

//à exécuter avec "gulp css"
//version avec vanilla CSS
/*
gulp.task('css', function(){
	return gulp.src('src/css/*.css')
			.pipe(autoprefixer())
			.pipe(gulp.dest('./css'))
			.pipe(rename({suffix: '.min'}))
			.pipe(minifycss())
			.pipe(gulp.dest('./css'))
});
*/

//version avec SASS
gulp.task('css', function(){
	return gulp.src('src/scss/*.scss') //ATTENTION, dossier Scss !
			.pipe(sass({ outputStyle: 'expanded' }))
			.pipe(autoprefixer())
			.pipe(gulp.dest('./public/assets/css'))
			.pipe(rename({suffix: '.min'}))
			.pipe(minifycss())
			.pipe(gulp.dest('./public/assets/css'))
});

//à exécuter avec "gulp js"
gulp.task('js', function(){
	return gulp.src(['src/js/main.js', 'src/js/chat.js', 'src/js/*.js']) //force cet ordre d'inclusion
		.pipe(concat('all.js'))
		.pipe(gulp.dest('./public/assets/js'))
		.pipe(uglify())
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest('./public/assets/js'))
});

//à exécuter avec "gulp watch"
//les changements aux fichiers sources seront détectés automatiquement
gulp.task('watch', function(){
	gulp.watch('src/js/*.js', ['js']);
	gulp.watch('src/scss/*.scss', ['css']);
});
//à exécuter avec "gulp"
gulp.task('default', ['css','js']);