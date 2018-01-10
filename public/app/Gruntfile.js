module.exports = function (grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        concat: {
            options: {
                separator: ';'
            },
            dist: {
                src: ['angular.js',
                    'angular-ui-router.js',
                    'config/*.js',
                    'service/*.js',
                    'main.js',
                    'modules/**/*.js'],
                dest: 'compiled/js/<%= pkg.name %>.js'
            }
        },
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= grunt.template.today() %> */\n'
            },
            dist: {
                files: {
                    'compiled/js/<%= pkg.name %>.min.js': ['<%= concat.dist.dest %>']
                }
            }
        },
        jshint: {
            files: ['Gruntfile.js',
                'config/*.js',
                'service/*.js',
                'main.js',
                'modules/**/*.js'],
            options: {
                globals: {
                    jQuery: true,
                }
            }
        },
        // cssmin: {
        //     options: {
        //         roundingPrecision: -1,
        //         shorthandCompacting: true,
        //         keepSpecialComments: 0
        //     },
        //     target: {
        //         files: {
        //             'app/compiled/css/<%= pkg.name %>.min.css': [
        //                 'build/css/*.css',
        //                 'css/*.css',
        //                 'test/**/*.css'
        //             ]
        //         }
        //     }
        // },
        watch: {
            files: ['<%= jshint.files %>'],
            tasks: ['jshint', 'concat', 'uglify'/* , 'cssmin' */]
        }

    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');
    // grunt.loadNpmTasks('grunt-contrib-cssmin');


    grunt.registerTask('default', ['jshint', 'concat', 'uglify', /* 'cssmin', */ 'watch']);

};