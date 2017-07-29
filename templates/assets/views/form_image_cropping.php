<!-- start: BREADCRUMB -->
<div class="breadcrumb-wrapper">
    <h4 class="mainTitle no-margin" translate="sidebar.nav.forms.CROPPING">IMAGE CROPPING</h4>

    <div ncy-breadcrumb class="pull-right"></div>
</div>
<!-- end: BREADCRUMB -->
<!-- start: IMAGE CROP EXAMPLE -->
<div class="container-fluid container-fullw">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-body">
                    <h5 class="over-title margin-bottom-15">Image Crop <span class="text-bold">example</span></h5>

                    <p class="margin-bottom-20">
                        Add the image crop directive <code>
                            &lt;img-crop&gt;
                        </code>
                        to the HTML file where you want to use an image crop control.
                        <br/>
                        <em>Note:</em>
                        a container, you place the directive to, should have some pre-defined size (absolute or relative
                        to its parent). That's required, because the image crop control fits the size of its container.
                    </p>
                    <!-- /// controller:  'CropCtrl' -  localtion: assets/js/controllers/cropCtrl.js /// -->
                    <div ng-controller="CropCtrl">
                        <div class="row">
                            <div class="col-md-12 margin-bottom-30">
                                <span class="btn btn-primary btn-file">
                                    Select an image file
                                    <input type="file" id="fileInput"/>
                                </span>

                                <div class="btn-group">
                                    <label class="btn btn-default btn-primary btn-o" ng-model="cropType"
                                           uib-btn-radio="'square'"> Square </label>
                                    <label class="btn btn-primary btn-o" ng-model="cropType" uib-btn-radio="'circle'">
                                        Circle </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="cropBox">
                                    <div class="cropArea">
                                        <img-crop image="myImage" result-image="myCroppedImage"
                                                  area-type="{{cropType}}"></img-crop>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="cropBox croppedBox">
                                    <div>
                                        <img ng-src="{{myCroppedImage}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: IMAGE CROP EXAMPLE -->