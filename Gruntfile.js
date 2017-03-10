'use strict';

module.exports = function(grunt) {

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

		less: {
			build: {
				options: {
					ieCompat: true
				},
				files: {
					'style.css': 'assets/src/less/style.less',
				}
			},
		},

		cssmin: {
			build: {
				files: [
					{
						src: 'style.css',
						dest: 'style.min.css',
					},
				]
			}
		},

		jshint: {
			test: {
				src: [
					'assets/src/js/**/*.js',
					'lib/WAI-ARIA-Walker_Nav_Menu/*.js'
				]
			}
		},

		concat: {
			build: {
				files: {
					'assets/js/frontend.js': [
						'lib/WAI-ARIA-Walker_Nav_Menu/wai-aria.js',
						'assets/src/js/frontend.js',
						'assets/src/js/frontend-*.js'
					],
					'assets/js/customizer-preview.js': [
						'assets/src/js/customizer-preview-*.js',
						'assets/src/js/customizer-preview.js'
					],
					'assets/js/customizer-control.js': [
						'assets/src/js/customizer-control-*.js',
						'assets/src/js/customizer-control.js'
					],
				}
			}
		},

		uglify: {
			options: {
				banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
			},
			build: {
				files: {
					'assets/js/frontend.min.js' : 'assets/js/frontend.js',
					'assets/js/customizer-preview.min.js' : 'assets/js/customizer-preview.js',
					'assets/js/customizer-control.min.js' : 'assets/js/customizer-control.js'
				}
			}
		},

		watch: {
			less: {
				files: ['assets/src/less/**/*.less'],
				tasks: ['less', 'cssmin']
			},
			js: {
				files: ['assets/src/js/**', 'lib/WAI-ARIA-Walker_Nav_Menu/*.js'],
				tasks: ['jshint', 'concat', 'uglify']
			}
		},

		// Create a .pot file
		makepot: {
			target: {
				options: {
					processPot: function( pot, options ) {
						pot.headers['report-msgid-bugs-to'] = 'https://themeofthecrop.com';
						return pot;
					},
					type: 'wp-theme',
				}
			}
		},

		// Build a package for distribution
		compress: {
			main: {
				options: {
					archive: 'totcbase-<%= pkg.version %>.zip'
				},
				files: [
					{
						src: [
							'*', '**/*',
							'!totcbase-<%= pkg.version %>.zip',
							'!.*', '!Gruntfile.js', '!package.json', '!node_modules', '!node_modules/**/*',
							'!**/.*', '!**/Gruntfile.js', '!**/package.json', '!**/node_modules', '!**/node_modules/**/*',
							'!assets/src', '!assets/src/**/*',
							'!lib/eo-full-calendar-base-style/**',
						],
						dest: 'totcbase/',
					}
				]
			}
		}

	});

	// Load tasks
	grunt.loadNpmTasks('grunt-contrib-compress');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-wp-i18n');

	// Default task(s).
	grunt.registerTask('default', ['watch']);

	grunt.registerTask('build', ['less', 'cssmin', 'jshint', 'concat', 'uglify']);

	grunt.registerTask('package', ['build', 'compress']);

};
