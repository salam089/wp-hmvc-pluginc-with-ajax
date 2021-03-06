<!-- start: BREADCRUMB -->
<div class="breadcrumb-wrapper">
    <h4 class="mainTitle no-margin" translate="sidebar.nav.forms.TEXTEDITOR">TEXT EDITOR</h4>

    <div ncy-breadcrumb class="pull-right"></div>
</div>
<!-- end: BREADCRUMB -->
<!-- start: CKEDITOR -->
<div class="container-fluid container-fullw">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-body">
                    <h5 class="over-title">CKEditor</h5>

                    <p class="margin-bottom-30">
                        CKEditor is a ready-for-use HTML text editor designed to simplify web content creation. It's a
                        WYSIWYG editor that brings common word processor features directly to your web pages. Enhance
                        your website experience with our community maintained editor.
                    </p>
                    <!-- /// controller:  'CkeditorCtrl' -  localtion: assets/js/controllers/ckeditorCtrl.js /// -->
                    <div ng-controller="CkeditorCtrl">
                        <div ckeditor="options" ng-model="content" ready="onReady()"></div>
                        <div class="well margin-top-20">
                            {{content}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: CKEDITOR -->