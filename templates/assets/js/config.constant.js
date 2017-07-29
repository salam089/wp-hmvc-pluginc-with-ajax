
'use strict';
/**
 * Config constant

 */

app.constant('APP_MEDIAQUERY', {

    'desktopXL': 1200,

    'desktop': 992,

    'tablet': 768,

    'mobile': 480

});

app.constant('JS_REQUIRES', {

    //*** Scripts

    scripts: {

        //*** Javascript Plugins

        'd3': siteUrl+'/wp-content/plugins/oel-cmp/bower_components/d3/d3.min.js',



        //*** jQuery Plugins

        'chartjs': siteUrl+'/wp-content/plugins/oel-cmp/bower_components/chartjs/Chart.min.js',

        'ckeditor-plugin': siteUrl+'/wp-content/plugins/oel-cmp//bower_components/ckeditor/ckeditor.js',

        'jquery-nestable-plugin': [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/jquery-nestable/jquery.nestable.js'],

        'touchspin-plugin': [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js', siteUrl+'/wp-content/plugins/oel-cmp/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css'],

        'jquery-appear-plugin': [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/jquery-appear/build/jquery.appear.min.js'],

        'spectrum-plugin': [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/spectrum/spectrum.js', siteUrl+'/wp-content/plugins/oel-cmp/bower_components/spectrum/spectrum.css'],

        //*** Controllers

        'dashboardCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/dashboardCtrl.js',

        'iconsCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/iconsCtrl.js',

        'vAccordionCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/vAccordionCtrl.js',

        'ckeditorCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/ckeditorCtrl.js',

        'laddaCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/laddaCtrl.js',

        'ngTableCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/ngTableCtrl.js',

        'cropCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/cropCtrl.js',

        'asideCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/asideCtrl.js',

        'toasterCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/toasterCtrl.js',

        'sweetAlertCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/sweetAlertCtrl.js',

        'mapsCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/mapsCtrl.js',

        'chartsCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/chartsCtrl.js',

        'calendarCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/calendarCtrl.js',

        'nestableCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/nestableCtrl.js',

        'validationCtrl': [siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/validationCtrl.js'],

        'formStepCtrl': siteUrl + '/wp-content/plugins/oel-cmp/templates/assets/js/controllers/formStepCtrl.js',

        'orderQuoteStepCtrl': siteUrl + '/wp-content/plugins/oel-cmp/templates/assets/js/controllers/orderQuoteStepCtrl.js',

        'QuotationListCtrl': siteUrl + '/wp-content/plugins/oel-cmp/templates/assets/js/controllers/QuotationListCtrl.js',

        'welcomeCtrl': siteUrl + '/wp-content/plugins/oel-cmp/templates/assets/js/controllers/welcomeCtrl.js',

        'PlaceorderCtrl': siteUrl + '/wp-content/plugins/oel-cmp/templates/assets/js/controllers/PlaceorderQtrl.js',


        'userCtrl': [siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/userCtrl.js'],

        'selectCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/selectCtrl.js',

        'wizardCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/wizardCtrl.js',

        'uploadCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/uploadCtrl.js',

        'treeCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/treeCtrl.js',

        'inboxCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/inboxCtrl.js',

        'xeditableCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/xeditableCtrl.js',

        'chatCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/chatCtrl.js',

        'dynamicTableCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/dynamicTableCtrl.js',

        'notificationIconsCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/notificationIconsCtrl.js',

        'dateRangeCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/daterangeCtrl.js',

        'notifyCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/notifyCtrl.js',

        'sliderCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/sliderCtrl.js',

        'knobCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/knobCtrl.js',

        'loginCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/loginCtrl.js',

        'quotationCtrl': siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/controllers/quotationCtrl.js',

    },

    //*** angularJS Modules







    modules: [{

        name: 'toaster',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/AngularJS-Toaster/toaster.js', siteUrl+'/wp-content/plugins/oel-cmp/bower_components/AngularJS-Toaster/toaster.css']

    }, {

        name: 'angularBootstrapNavTree',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/angular-bootstrap-nav-tree/dist/abn_tree_directive.js', siteUrl+'/wp-content/plugins/oel-cmp/bower_components/angular-bootstrap-nav-tree/dist/abn_tree.css']

    }, {

        name: 'ngTable',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/ng-table/dist/ng-table.min.js', siteUrl+'/wp-content/plugins/oel-cmp/bower_components/ng-table/dist/ng-table.min.css']

    }, {

        name: 'ui.mask',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/angular-ui-utils/mask.min.js']

    }, {

        name: 'ngImgCrop',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/ngImgCrop/compile/minified/ng-img-crop.js', siteUrl+'/wp-content/plugins/oel-cmp/bower_components/ngImgCrop/compile/minified/ng-img-crop.css']

    }, {

        name: 'angularFileUpload',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/angular-file-upload/angular-file-upload.js']

    }, {

        name: 'monospaced.elastic',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/angular-elastic/elastic.js']

    }, {

        name: 'ngMap',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/ngmap/build/scripts/ng-map.min.js']

    }, {

        name: 'chart.js',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/angular-chart.js/dist/angular-chart.min.js', siteUrl+'/wp-content/plugins/oel-cmp/bower_components/angular-chart.js/dist/angular-chart.min.css']

    }, {

        name: 'flow',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/ng-flow/dist/ng-flow-standalone.min.js']

    }, {

        name: 'ckeditor',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/angular-ckeditor/angular-ckeditor.min.js']

    }, {

        name: 'mwl.calendar',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/angular-bootstrap-calendar/dist/js/angular-bootstrap-calendar-tpls.js', siteUrl+'/wp-content/plugins/oel-cmp/bower_components/angular-bootstrap-calendar/dist/css/angular-bootstrap-calendar.min.css', siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/config/config-calendar.js']

    }, {

        name: 'ng-nestable',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/ng-nestable/src/angular-nestable.js']

    }, {

        name: 'ngNotify',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/ng-notify/dist/ng-notify.min.js', siteUrl+'/wp-content/plugins/oel-cmp/bower_components/ng-notify/dist/ng-notify.min.css']

    }, {

        name: 'xeditable',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/angular-xeditable/dist/js/xeditable.min.js', siteUrl+'/wp-content/plugins/oel-cmp/bower_components/angular-xeditable/dist/css/xeditable.css', siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/js/config/config-xeditable.js']

    }, {

        name: 'checklist-model',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/checklist-model/checklist-model.js']

    }, {

        name: 'ui.knob',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/ng-knob/dist/ng-knob.min.js']

    }, {

        name: 'ngAppear',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/angular-appear/build/angular-appear.min.js']

    }, {

        name: 'countTo',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/angular-count-to-0.1.1/dist/angular-filter-count-to.min.js']

    }, {

        name: 'angularSpectrumColorpicker',

        files: [siteUrl+'/wp-content/plugins/oel-cmp/bower_components/angular-spectrum-colorpicker/dist/angular-spectrum-colorpicker.min.js']

    }]

});