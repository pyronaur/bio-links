Gulp = require( "gulp" )

Gulp.task "build", ( cb ) ->
	GLOBAL.set_production()

	Gulp.start "pot"
	Gulp.start "styl"

