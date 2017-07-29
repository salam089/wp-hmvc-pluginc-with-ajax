<?php
/**
 * Template Name: Angular package new theme
 *
 * A template used to demonstrate how to include the template
 * using this plugin.
 *
 * @package PTE
 * @since 	1.0.0
 * @version	1.0.0
 */
?>
<?php get_header('header2');?>

<style>
        #form1 .quotation-upoader i {
                color: #fff;
                margin-top: 3px;
                margin-left: 4px;
                background: #59758b;
                border-radius: 50%;
                padding: 2px;
                font-weight: bold;
                font-size: 10px;
        }
</style>



<div ui-view id="app" ng-class="{'app-mobile' : app.isMobile, 'app-navbar-fixed' : app.layout.isNavbarFixed, 'app-sidebar-fixed' : app.layout.isSidebarFixed, 'app-sidebar-closed':app.layout.isSidebarClosed, 'app-footer-fixed':app.layout.isFooterFixed}"></div>




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



<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/uploader/vendor/jquery.ui.widget.js"></script>

<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/uploader/load-image.all.min.js"></script>
<!--<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>-->

<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/uploader/canvas-to-blob.min.js"></script>
<!--<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>-->

<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/uploader/bootstrap.min.js"></script>
<!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>-->

<!-- blueimp Gallery script -->
<!--<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>-->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/uploader/jquery.blueimp-gallery.min.js"></script>

<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/uploader/jquery.iframe-transport.js"></script>

<!-- The basic File Upload plugin -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/uploader/jquery.fileupload.js"></script>

<!-- The File Upload processing plugin -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/uploader/jquery.fileupload-process.js"></script>

<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/uploader/jquery.fileupload-image.js"></script>

<!-- The File Upload audio preview plugin -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/uploader/jquery.fileupload-audio.js"></script>

<!-- The File Upload video preview plugin -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/uploader/jquery.fileupload-video.js"></script>

<!-- The File Upload validation plugin -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/uploader/jquery.fileupload-validate.js"></script>

<!-- The File Upload Angular JS module -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/uploader/jquery.fileupload-angular.js"></script>

<!-- The main application script -->





<!-- Packet Scripts -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/app.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/main.js" data-cfasync="false" ></script>

<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/config.constant.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/config.router2.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/factory/authFact.js" data-cfasync="false"></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/factory/dashBoardService.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/factory/captchaFact.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/factory/multiplierFact.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/factory/resizeTo.js"
        data-cfasync="false"></script>


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
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/captcha.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/multiplierlabel.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/directives/resizeTo.js"
        data-cfasync="false"></script>
<!-- Packet Controllers -->
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/controllers/mainCtrl.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/controllers/inboxCtrl.js" data-cfasync="false" ></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/oel-cmp/templates/assets/js/controllers/bootstrapCtrl.js" data-cfasync="false" ></script>




</body>
</html>