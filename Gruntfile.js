module.exports = function(grunt) {

    grunt.initConfig({
        concat: {
            js: {
                options: {
                    separator: '\n\n;;\n\n'
                },
                src: [
                    'source/javascript/libraries/knockout-*.js'
                    , 'source/javascript/libraries/knockout.*.js'
                    , 'source/javascript/app.js'
                ],
                dest: 'store_zone_shipping/javascript/store_zone_shipping.min.js'
            }
        },
        uglify: {
            options: {
                mangle: false
            },
            js: {
                files: {
                    'store_zone_shipping/javascript/store_zone_shipping.min.js': ['store_zone_shipping/javascript/store_zone_shipping.min.js']
                }
            }
        },
        watch: {
            source_js: {
                files: ['source/javascript/*.js', 'source/javascript/*/*.js'],
                tasks: ['concat:js', 'uglify:js']
            },
            live_js: {
                files: ['store_zone_shipping/javascript/*.js']
            },
            gruntfile: {
                files: ['Gruntfile*'],
                tasks: ['concat', 'uglify']
            }
        }

    });

    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', 'watch');
    // grunt.registerTask('watch', 'watch' );
};
//