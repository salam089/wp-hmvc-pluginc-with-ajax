<?php
/**
 * Template Name:Portal Main Template
 *
 *
 */
?>
<!DOCTYPE html>
<html lang="en" data-ng-app="app" >
<head>
	<meta name="fragment" content="!">
	<base href="/portal/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="{{app.description}}">
    <meta name="keywords" content="app, responsive, angular, bootstrap, dashboard, admin">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="HandheldFriendly" content="true" />
    <meta name="apple-touch-fullscreen" content="yes" />
    <title data-ng-bind="pageTitle()">Packet - Angular Bootstrap Admin Template</title>
    <!-- Google fonts -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <!-- Packet CSS -->
    <link rel="stylesheet" href="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/css/app.min.css">

    <!-- Packet Theme -->
    <link rel="stylesheet" data-ng-href="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/css/themes/{{ app.layout.theme }}.css" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/favicon.ico" />

</head>
<body ng-controller="AppCtrl">
 
<div ui-view id="app" ng-class="{'app-mobile' : app.isMobile, 'app-navbar-fixed' : app.layout.isNavbarFixed, 'app-sidebar-fixed' : app.layout.isSidebarFixed, 'app-sidebar-closed':app.layout.isSidebarClosed, 'app-footer-fixed':app.layout.isFooterFixed}"></div>

<!--<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/app.src.js"></script>-->
   <script  data-cfasync="false">
        var siteUrl = '<?php echo site_url(); ?>'
        ajaxUrl =  '<?php echo admin_url('admin-ajax.php'); ?>';
        var templateDirRootUrl = '<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/';
        var pluginsDirUr = '<?php echo site_url(); ?>/wp-content/plugins/oel-cmp';
    </script>

<!-- jQuery -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/jquery/dist/jquery.min.js" data-cfasync="false"></script>
<!-- Fastclick -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/fastclick/lib/fastclick.js" data-cfasync="false"> </script>
<!-- Modernizr -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/components-modernizr/modernizr.js" data-cfasync="false"></script>
<!-- Moment -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/moment/min/moment.min.js" data-cfasync="false"></script>
<!-- Perfect Scrollbar -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/perfect-scrollbar/js/min/perfect-scrollbar.jquery.min.js" data-cfasync="false"></script>
<!-- Date Range Picker -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/bootstrap-daterangepicker/daterangepicker.js" data-cfasync="false"></script>
<!-- Sweet Alert -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/sweetalert/lib/sweet-alert.min.js" data-cfasync="false"></script>
<!-- Spin -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/spin.js/spin.js" data-cfasync="false"></script>
<!-- Ladda Buttons -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/ladda/dist/ladda.min.js" data-cfasync="false"></script>
<!-- Slick Carousel -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/slick-carousel/slick/slick.min.js" data-cfasync="false"></script>
<!-- Angular -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular/angular.min.js" data-cfasync="false"></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-cookies/angular-cookies.min.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-animate/angular-animate.min.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-touch/angular-touch.min.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-sanitize/angular-sanitize.min.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-ui-router/release/angular-ui-router.min.js" data-cfasync="false" ></script>
<!-- Angular storage -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/ngstorage/ngStorage.min.js" data-cfasync="false" ></script>
<!-- Angular Translate -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-translate/angular-translate.min.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-translate-loader-url/angular-translate-loader-url.min.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-translate-loader-static-files/angular-translate-loader-static-files.min.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-translate-storage-local/angular-translate-storage-local.min.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-translate-storage-cookie/angular-translate-storage-cookie.min.js" data-cfasync="false" ></script>
<!-- oclazyload -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/oclazyload/dist/ocLazyLoad.min.js" data-cfasync="false" ></script>
<!-- breadcrumb -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-breadcrumb/dist/angular-breadcrumb.min.js" data-cfasync="false" ></script>
<!-- angular-swipe -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-swipe/dist/angular-swipe.min.js" data-cfasync="false" ></script>
<!-- UI Bootstrap -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js" data-cfasync="false" ></script>
<!-- Loading Bar -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-loading-bar/build/loading-bar.min.js" data-cfasync="false" ></script>
<!-- Angular Scroll -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-scroll/angular-scroll.min.js" data-cfasync="false" ></script>
<!-- Angular Fullscreen -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-fullscreen/src/angular-fullscreen.js" data-cfasync="false" ></script>
<!-- Angular DateRangePicker -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/ng-bs-daterangepicker/dist/ng-bs-daterangepicker.min.js" data-cfasync="false" ></script>
<!-- Angular Truncate -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-truncate/src/truncate.js" data-cfasync="false" ></script>
<!-- Angular Moment -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-moment/angular-moment.min.js" data-cfasync="false" ></script>
<!-- Angular ui-switch -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-ui-switch/angular-ui-switch.min.js" data-cfasync="false" ></script>
<!-- Angular Ladda -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-ladda/dist/angular-ladda.min.js" data-cfasync="false" ></script>
<!-- Angular Toaster -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/AngularJS-Toaster/toaster.js" data-cfasync="false" ></script>
<!-- Angular Ng-Aside -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-aside/dist/js/angular-aside.min.js" data-cfasync="false" ></script>
<!-- V-Accordion -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/v-accordion/dist/v-accordion.min.js" data-cfasync="false" ></script>
<!-- V-Button -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/v-button/dist/v-button.min.js" data-cfasync="false" ></script>
<!-- Angular Sweet Alert -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-sweetalert-promised/SweetAlert.min.js" data-cfasync="false" ></script>
<!-- Angular Notification Icons -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-notification-icons/dist/angular-notification-icons.min.js"  data-cfasync="false" ></script>
<!-- Angular Awesome Slider -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-awesome-slider/dist/angular-awesome-slider.min.js" data-cfasync="false" ></script>
<!-- Angular Slick Carousel -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/bower_components/angular-slick-carousel/dist/angular-slick.min.js" data-cfasync="false"  ></script>
<!-- Packet Scripts -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/app.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/main.js" data-cfasync="false" ></script>

<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/config.constant.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/config.router.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/factory/authFact.js" data-cfasync="false"></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/factory/dashBoardService.js" data-cfasync="false" ></script>


<!-- Packet Directives -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/toggle.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/perfect-scrollbar.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/empty-links.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/sidebars.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/off-click.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/full-height.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/panel-tools.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/char-limit.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/dismiss.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/compare-to.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/select.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/messages.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/chat.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/touchspin.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/file-upload.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/letter-icon.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/landing-header.js" data-cfasync="false" ></script>
<!-- Packet Controllers -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/controllers/mainCtrl.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/controllers/inboxCtrl.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/controllers/bootstrapCtrl.js" data-cfasync="false" ></script>
</body>
</html>