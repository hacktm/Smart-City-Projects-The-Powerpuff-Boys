module.exports = function (grunt) {

    var jsFileHashes = {};

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        connect: {
            server: {
                options: {
                    port: 9999,
                    base: '.',
                    hostname: "*"
                }
            }
        },
        watch: {
            app: {
                files: ['js/**/*.js', '!js/*.js'],
                tasks: ['concat:code']
            },
            libs: {
                files: ['lib/**/*.js'],
                tasks: ['concat:libs']
            },
            indexTemplate: {
                files: ["templates/index.html"],
                tasks: ["cachebuster:build", "replace:dist"]
            }
        },
        bower: {
            install: {
                options: {
                    copy: false,
                    verbose: true,
                    install: true,
                    bowerOptions: {
                        forceLatest: true
                    }
                }
            }
        },
        cachebuster: {
            build: {
                options: {
                    complete: function(hashes) {
                        var i;
                        for (i in hashes) {
                            jsFileHashes[i] = hashes[i];
                        }
                    }
                },
                src: [
                    "js/<%= pkg.name %>.app.js",
                    "js/<%= pkg.name %>.libs.js",
                    "css/<%= pkg.name %>.css"
                ]
            }
        },
        replace: {
            dist: {
                options: {
                    variables: jsFileHashes,
                    prefix: '@@'
                },
                files: [
                    {
                        expand: true,
                        flatten: true,
                        src: ['templates/index.html'],
                        dest: './'
                    }
                ]
            }
        },
        concat: {
            options: {
                separator: ';'
            },
            libs: {
                src: [
                    "bower_components/jquery/jquery.min.js",
                    "bower_components/bootstrap/dist/js/bootstrap.min.js",
                    "bower_components/angular/angular.min.js",
                    "bower_components/angular-resource/angular-resource.min.js",
                    "bower_components/angular-route/angular-route.min.js",
                    "bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js",
                    "bower_components/commons/bmComponents.js",
                    "bower_components/momentjs/min/moment-with-langs.min.js",
                    "bower_components/bootstrap-select/dist/js/bootstrap-select.js",
                    "bower_components/angular-bootstrap-select/build/angular-bootstrap-select.min.js",
                    "lib/angular-l10n/l10n-with-tools.min.js"
                ],
                dest: 'js/<%= pkg.name %>.libs.js'
            },
            code: {
                src: [
                    "js/config/app.js",
                    "js/languages/**/*.js",
                    "js/config/config.js",
                    "js/controllers/**/*.js",
                    "js/directives/**/*.js",
                    "js/services/**/*.js",
                    "js/filters/**/*.js"
                ],
                dest: "js/<%= pkg.name %>.app.js"
            },
            all: {
                src: [
                    "js/<%= pkg.name %>.libs.js",
                    "js/<%= pkg.name %>.app.js"
                ],
                dest: "js/<%= pkg.name %>.min.js"
            }
        }
    });

    grunt.loadNpmTasks("grunt-contrib-uglify");
    grunt.loadNpmTasks("grunt-contrib-concat");
    grunt.loadNpmTasks("grunt-contrib-connect");
    grunt.loadNpmTasks("grunt-contrib-watch");
    grunt.loadNpmTasks("grunt-bower-task");
    grunt.loadNpmTasks("grunt-cachebuster");
    grunt.loadNpmTasks("grunt-replace");

    // Default task(s).
    grunt.registerTask("build", ["bower", "concat:libs", "concat:code", "cachebuster", "replace"]);
    grunt.registerTask("default", ["concat:code", "cachebuster", "replace"]);
    grunt.registerTask("libs", ["concat:libs", "cachebuster", "replace"]);
    grunt.registerTask("dev", ["build", "connect", "watch"]);

};