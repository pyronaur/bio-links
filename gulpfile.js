var gulp = require( 'gulp' )
var pot  = require( 'gulp-wp-pot' )
var sort = require( 'gulp-sort' )

gulp.task( 'pot', function () {
    gulp.src( '**/*.php' )
        .pipe( sort() )
        .pipe( pot( {
            domain        : 'biolinks',
            destFile      : 'biolinks.pot',
            package       : 'Bio Links',
            bugReport     : 'http://help.colormelon.com',
            lastTranslator: 'Colormelon <help@colormelon.com>',
            team          : 'Colormelon <help@colormelon.com>',
        } ) )
        .pipe( gulp.dest( 'languages' ) )
} )
