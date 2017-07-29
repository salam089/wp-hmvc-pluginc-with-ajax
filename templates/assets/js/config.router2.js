'use strict';

/**
 * Config for the router
 */
app.config(['$stateProvider', '$httpProvider', '$locationProvider', '$urlRouterProvider', '$controllerProvider', '$compileProvider', '$filterProvider', '$provide', '$ocLazyLoadProvider', 'JS_REQUIRES',
    function ($stateProvider, $httpProvider, $locationProvider, $urlRouterProvider, $controllerProvider, $compileProvider, $filterProvider, $provide, $ocLazyLoadProvider, jsRequires) {
        $locationProvider.html5Mode(true);

        app.controller = $controllerProvider.register;
        app.directive = $compileProvider.directive;
        app.filter = $filterProvider.register;
        app.factory = $provide.factory;
        app.service = $provide.service;
        app.constant = $provide.constant;
        app.value = $provide.value;


        $httpProvider.interceptors.push([function () {
            //console.log(nonceLocalized.nonce);
            return {
                'request': function (config) {
                    config.headers = config.headers || {};
                    //add nonce to avoid CSRF issues
                    //config.headers['X-WP-Nonce'] = '';

                    return config;
                }
            };
        }]);


        // LAZY MODULES

        $ocLazyLoadProvider.config({
            debug: false,
            events: true,
            modules: jsRequires.modules
        });

        // APPLICATION ROUTES
        // -----------------------------------
        // For any unmatched url, redirect to /app/dashboard
        //$urlRouterProvider.otherwise("/signin");
        // $urlRouterProvider.otherwise("/signin");

        if (requestUri) {
            $urlRouterProvider.otherwise(requestUri);
        } else {
            $urlRouterProvider.otherwise('/signin.html');
        }


        // sign in
        $stateProvider.state('app', {
            url: "/app",
            templateUrl: "../wp-content/plugins/oel-cmp/templates/assets/views/app.html",
            resolve: loadSequence('chartjs', 'chart.js', 'chatCtrl','loginCtrl'),
            abstract: true,
            authenticated: true
        }).state('app.dashboard', {
            url: "/dashboard.html",
            templateUrl: "../wp-content/plugins/oel-cmp/templates/assets/views/dashboard.html",
            resolve: loadSequence('ngTable', 'ngTableCtrl', 'd3', 'ui.knob', 'countTo', 'dashboardCtrl'),
            authenticated: true,
            title: 'Dashboard',
            ncyBreadcrumb: {
                label: 'Dashboard'
            },

        }).state('app.settings',{
            url: '/settings.html',
            title: 'user-settings',
            templateUrl: siteUrl+"/wp-content/plugins/oel-cmp/templates/assets/views/user-settings.html",
            resolve: loadSequence('ui.mask','userCtrl'),
            controller:'userSettingCtrl',
            authenticated: true

        }).state('app.customer-quote', {
            url: '/order-quote.html',
            title: '/order-quote',
            templateUrl: siteUrl + "/wp-content/plugins/oel-cmp/templates/assets/views/order_quote_without_temp.html",
            resolve: loadSequence('orderQuoteStepCtrl', 'ngNotify'),
            authenticated: true

        }).state('app.placeorder', {
            url: '/place-order.html',
            title: '/placeorder',
            templateUrl: siteUrl + "/wp-content/plugins/oel-cmp/templates/assets/views/place_order.html",
            resolve: loadSequence('PlaceorderCtrl', 'ngNotify'),
            authenticated: true

        }) .state('app.quotations', {
            url: '/quotations.html',
            title: '/quotations',
            templateUrl: siteUrl + "/wp-content/plugins/oel-cmp/templates/assets/views/quotations.html",
            resolve: loadSequence('ngTable', 'QuotationListCtrl'),
            authenticated: true

          }).state('app.ui', {
            url: '/ui',
            template: '<div ui-view class="fade-in-up"></div>',
            title: 'UI Elements',
            ncyBreadcrumb: {
                label: 'UI Elements'
            }
        }).state('app.form', {

            url: '/form',

            template: '<div ui-view class="fade-in-up"></div>',

            title: 'Forms',

            ncyBreadcrumb: {

                label: 'Forms'

            }

        }).state('app.form.upload', {

            url: '/upload',

            templateUrl: siteUrl + "/wp-content/plugins/oel-cmp/templates/assets/views/form_file_upload.html",

            title: 'Multiple File Upload',

            ncyBreadcrumb: {

                label: 'File Upload'

            },

            resolve: loadSequence('angularFileUpload', 'uploadCtrl')

        }).state('app.form.upload2', {
            url: '/upload2.html',
            templateUrl: siteUrl + "/wp-content/plugins/oel-cmp/templates/assets/views/angularjs.html",
            title: 'Multiple File Upload',
            ncyBreadcrumb: {
                label: 'File Upload'
            },
            resolve: loadSequence('angularFileUpload', 'uploadCtrl')

        }).state('app.form.wizard', {

            url: '/wizard',

            templateUrl: siteUrl + "/wp-content/plugins/oel-cmp/templates/assets/views/form_wizard.php",

            title: 'Form Wizard',

            ncyBreadcrumb: {

                label: 'Wizard'

            },

            resolve: loadSequence('wizardCtrl', 'ngNotify')

        })

        .state('login', {
            template: '<div ui-view class="fade-in-right-big smooth"></div>',
            abstract: true
        })
        .state('login.registration', {
            url: '/sign-up.html',
            title: 'Signup',
            templateUrl: siteUrl + "/wp-content/plugins/oel-cmp/templates/assets/views/login_registration.html",
            resolve: loadSequence('loginCtrl')

        }).state('login.signin', {
            url: '/sign-in.html',
            title: 'Signin',
            templateUrl: siteUrl + "/wp-content/plugins/oel-cmp/templates/assets/views/login_login.html",
            // resolve: loadSequence('cookies','flow','userCtrl','loginCtrl')
            resolve: loadSequence('loginCtrl'),
            controller: 'loginCtrl'
        }).state('login.resetpass', {
            url: '/reset-pass.html',
            templateUrl: siteUrl + "/wp-content/plugins/oel-cmp/templates/assets/views/login_forgot.html",
            resolve: loadSequence('loginCtrl')
        }).state('login.verifypass', {
            url: '/verify.html',
            templateUrl: siteUrl + "/wp-content/plugins/oel-cmp/templates/assets/views/verify_pass.html",
            resolve: loadSequence('loginCtrl')
        }).state('login.changepass', {
            url: '/change-pass.html',
            templateUrl: siteUrl + "/wp-content/plugins/oel-cmp/templates/assets/views/change_pass.html",
            resolve: loadSequence('loginCtrl')
        }).state('login.freequote', {
                url: '/quote-request.html',
                title: 'Quote request',
                templateUrl: siteUrl + "/wp-content/plugins/oel-cmp/templates/assets/views/quotation.html",
                resolve: loadSequence('quotationCtrl', 'uploadCtrl')

        }).state('quote-request-free-trial', {
            url: '/quote-request-free-trial.html',
            title: 'Quote Request free trial',
            templateUrl: siteUrl + "/wp-content/plugins/oel-cmp/templates/assets/views/free_quote_trial.html",
            ncyBreadcrumb: {
                label: 'Wizard'
            },
            resolve: loadSequence('ngNotify', 'uploadCtrl', 'quotationCtrl' )

        }) .state('thankyou', {
                url: '/thank-you.html',
                title: 'welcome message',
                templateUrl: siteUrl + "/wp-content/plugins/oel-cmp/templates/assets/views/welcome_page.html",
                resolve: loadSequence('xeditable','welcomeCtrl','notifyCtrl','ngNotify')

        }) .state('/', {
            url: '/sign-in.html',
            title: 'Signin',
            templateUrl: siteUrl + "/wp-content/plugins/oel-cmp/templates/assets/views/login_login.html",
            // resolve: loadSequence('cookies','flow','userCtrl','loginCtrl')
            resolve: loadSequence('loginCtrl')
        })


// Generates a resolve object previously configured in constant.JS_REQUIRES (config.constant.js)
        function loadSequence() {
            var _args = arguments;
            return {
                deps: ['$ocLazyLoad', '$q',
                    function ($ocLL, $q) {
                        var promise = $q.when(1);
                        for (var i = 0, len = _args.length; i < len; i++) {
                            promise = promiseThen(_args[i]);
                        }
                        return promise;

                        function promiseThen(_arg) {
                            if (typeof _arg == 'function')
                                return promise.then(_arg);
                            else
                                return promise.then(function () {
                                    var nowLoad = requiredData(_arg);
                                    if (!nowLoad)
                                        return $.error('Route resolve: Bad resource name [' + _arg + ']');
                                    return $ocLL.load(nowLoad);
                                });
                        }

                        function requiredData(name) {
                            if (jsRequires.modules)
                                for (var m in jsRequires.modules)
                                    if (jsRequires.modules[m].name && jsRequires.modules[m].name === name)
                                        return jsRequires.modules[m];
                            return jsRequires.scripts && jsRequires.scripts[name];
                        }
                    }]
            };
        }


//$locationProvider.html5Mode(true);
    }]);

