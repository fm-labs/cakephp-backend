/*global module:false*/
module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    // Metadata.
    pkg: grunt.file.readJSON('package.json'),
    banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' +
      '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
      '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
      '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' +
      ' Licensed <%= _.pluck(pkg.licenses, "type").join(", ") %> */\n',
    // Task configuration.
    less: {
      development: {
        options: {
          paths: ['webroot/less', 'webroot/css'],
          banner: '/** <%= pkg.title || pkg.name %> - v<%= pkg.version %> **/\n'
        },
        files: {
          'webroot/css/layout.auth.css': 'webroot/less/layout.auth.less',
          'webroot/css/layout.default.css': 'webroot/less/layout.default.less',
          'webroot/css/layout.iframe.css': 'webroot/less/layout.iframe.less',
          'webroot/css/backend.css': 'webroot/less/backend.less',
          'webroot/css/jstree/themes/backend/style.css': 'webroot/less/jstree.less'
        }

      },
      production: {
        options: {
          paths: ['webroot/less', 'webroot/css'],
          compress: true,
          plugins: [
            new (require('less-plugin-autoprefix'))({browsers: ["last 2 versions"]}),
            new (require('less-plugin-clean-css'))({ advanced: true })
          ]
        },
        files: {
          'webroot/css/layout.auth.min.css': 'webroot/less/layout.auth.less',
          'webroot/css/layout.default.min.css': 'webroot/less/layout.default.less',
          'webroot/css/layout.iframe.min.css': 'webroot/less/layout.iframe.less',
          'webroot/css/backend.min.css': 'webroot/less/backend.less',
          'webroot/css/jstree/themes/backend/style.min.css': 'webroot/less/jstree.less'
        }
      }
    },
    copy: {
      bower: {
        files: [
          // includes files within path
          {expand: true, cwd: 'bower_components/AdminLTE/', src: ['bootstrap/**', 'dist/**', 'plugins/**'], dest: 'webroot/libs/adminlte/'},
          {expand: true, cwd: 'bower_components/font-awesome/', src: ['css/**', 'fonts/**'], dest: 'webroot/libs/fontawesome/'},
          {expand: true, cwd: 'bower_components/Ionicons/', src: ['css/**', 'fonts/**'], dest: 'webroot/libs/ionicons/'},
          {expand: true, cwd: 'bower_components/html5shiv/dist/', src: ['**'], dest: 'webroot/libs/html5shiv/'},
          {expand: true, cwd: 'bower_components/respond/dest/', src: ['**'], dest: 'webroot/libs/respond/'}
        ]
      }
    },
    watch: {
      assets: {
        files: [
          'webroot/less/**/*.less'
        ],
        tasks: ['less'],
        options: {
          spawn: false
        }
      }
    }
  });

  // These plugins provide necessary tasks.
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-copy');

  // Default task.
  grunt.registerTask('default', ['less', 'copy']);

};
