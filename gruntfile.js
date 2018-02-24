module.exports = function (grunt) {
    'use strict';

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        // App configurations
        app: {
            styles: {
                paths: [],
                dir: ['src/app/assets/styles/**/*.{scss,sass}'],
                src: ['src/app/assets/styles/app.{scss,sass}'],
                dist: 'src/public/css/app.css'
            },
            scripts: {
                dir: ['src/app/assets/scripts/**/*.js'],
                lib: ['src/app/assets/scripts/lib/*.js'],
                src: ['src/app/assets/scripts/app.js'],
                build: 'src/public/js/app.js',
                dist: 'src/public/js/app.dist.js',
                min: 'src/public/js/app.min.js'
            }
        },

        // Compile Sass
        sass: {
            options: {
                includePaths: '<%= app.styles.paths %>',
                outputStyle: 'compressed'
            },
            files: {
                src: '<%= app.styles.src %>',
                dest: '<%= app.styles.dist %>'
            }
        },

        // Compile ES6
        browserify: {
            options: {
                browserifyOptions: {
                    debug: true
                },
                transform: ['babelify']
            },
            files: {
                src: '<%= app.scripts.src %>',
                dest: '<%= app.scripts.build %>'
            }
        },

        // Concatenate files
        concat: {
            files: {
                src: ['<%= app.scripts.lib %>', '<%= app.scripts.build %>'],
                dest: '<%= app.scripts.dist %>'
            }
        },

        // Minify files
        uglify: {
            options: {
                compress: {
                    drop_console: true
                },
                preserveComments: false
            },
            files: {
                src: '<%= app.scripts.dist %>',
                dest: '<%= app.scripts.min %>'
            }
        },

        // Watch for changes
        watch: {
            options: {
                spawn: false
            },
            styles: {
                files: '<%= app.styles.dir %>',
                tasks: ['sass']
            },
            scripts: {
                files: '<%= app.scripts.dir %>',
                tasks: ['browserify']
            },
            livereload: {
                options: {
                    livereload: true
                },
                files: ['src/**/**.*']
            }
        }
    });

    // Load plugins
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-browserify');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Build tasks
    grunt.registerTask('build', ['sass']); //browserify

    // Production tasks
    grunt.registerTask('production', ['sass', 'concat', 'uglify']); //browserify

    // Default tasks
    grunt.registerTask('default', ['build', 'watch']);
};
