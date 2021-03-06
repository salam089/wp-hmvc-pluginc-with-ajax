<!-- start: BREADCRUMB -->
<div class="breadcrumb-wrapper">
    <h4 class="mainTitle no-margin" translate="sidebar.nav.forms.PICKERS">Pickers</h4>

    <div ncy-breadcrumb class="pull-right"></div>
</div>
<!-- end: BREADCRUMB -->
<!-- start: DATE/TIME Picker -->
<div class="container-fluid container-fullw">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-body">
                    <h5 class="over-title">Date/Time <span class="text-bold">Picker</span></h5>

                    <p class="margin-bottom-30">
                        A clean, flexible, and fully customizable date picker.
                        User can navigate through months and years. The datepicker shows dates that come from other than
                        the main month being displayed. These other dates are also selectable.
                    </p>

                    <div class="panel panel-white no-radius">
                        <div class="panel-body">
                            <!-- /// controller:  'DatepickerDemoCtrl' -  localtion: assets/js/controllers/bootstrapCtrl.js /// -->
                            <div ng-controller="DatepickerDemoCtrl">
                                <div class="row">
                                    <div class="col-md-12">
                                        <pre>Selected date is: {{dt | date:'MM/dd/yyyy  h:mma' }}</pre>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-bold margin-top-25 margin-bottom-15">Inline</h5>

                                        <div class="inline-block min-height-180">
                                            <uib-datepicker ng-model="dt" min-date="minDate" show-weeks="false"
                                                            class="well well-sm clip-datepicker"></uib-datepicker>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-bold margin-top-25 margin-bottom-15">Popup</h5>

                                        <p>

                                        <div class="form-group">
                                            <label>
                                                Inline
                                            </label>
                                            <input type="text" class="form-control" uib-datepicker-popup="{{format}}"
                                                   ng-model="dt" show-weeks="false" is-open="inputopened"
                                                   ng-init="inputopened = false" ng-click="inputopened = !inputopened"
                                                   min-date="minDate" max-date="maxDate"
                                                   datepicker-options="dateOptions" ng-required="true"
                                                   close-text="Close"/>
                                        </div>
                                        </p>
                                        <p>

                                        <div class="form-group">
                                            <label>
                                                Component
                                            </label>

                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                       uib-datepicker-popup="{{format}}" ng-model="dt"
                                                       show-weeks="false" is-open="opened" min-date="minDate"
                                                       max-date="maxDate" datepicker-options="dateOptions"
                                                       ng-required="true" close-text="Close"/>
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-primary"
                                                                ng-click="open($event)">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                            </div>
                                        </div>
                                        </p>
                                        <p>

                                        <div class="form-group">
                                            <label>
                                                Disable weekend selection
                                            </label>
                                            <input type="text" class="form-control" uib-datepicker-popup="{{format}}"
                                                   ng-model="dt" show-weeks="false" is-open="disabledopened"
                                                   ng-init="disabledopened = false"
                                                   ng-click="disabledopened = !disabledopened" min-date="minDate"
                                                   max-date="maxDate" datepicker-options="dateOptions"
                                                   date-disabled="disabled(date, mode)" ng-required="true"
                                                   close-text="Close"/>
                                        </div>
                                        </p>
                                        <div class="form-group">
                                            <label class="text-bold margin-top-25">
                                                Format:
                                            </label>
                                            <span class="clip-select">
                                                <select class="form-control" ng-model="format"
                                                        ng-options="f for f in formats">
                                                    <option></option>
                                                </select>
                                            </span>
                                        </div>
                                        <div class="margin-top-30">
                                            <button type="button" class="btn btn-sm btn-info" ng-click="today()">
                                                Today
                                            </button>
                                            <button type="button" class="btn btn-sm btn-default btn-o"
                                                    ng-click="dt = '2009-08-24'">
                                                2009-08-24
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" ng-click="clear()">
                                                Clear
                                            </button>
                                            <div class="checkbox clip-check check-primary margin-top-10">
                                                <input type="checkbox" id="checkbox1" value="1" ng-click="toggleMin()">
                                                <label for="checkbox1">
                                                    After today restriction
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="text-bold margin-top-25 margin-bottom-15">Timepicker</h5>
                                        <uib-timepicker ng-model="dt" ng-change="changed()" hour-step="hstep"
                                                        minute-step="mstep" show-meridian="ismeridian"></uib-timepicker>
                                        <pre class="alert alert-info">Time is: {{dt | date:'shortTime' }}</pre>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                Hours step is: <select class="form-control" ng-model="hstep"
                                                                       ng-options="opt for opt in options.hstep"></select>
                                            </div>
                                            <div class="col-xs-6">
                                                Minutes step is: <select class="form-control" ng-model="mstep"
                                                                         ng-options="opt for opt in options.mstep"></select>
                                            </div>
                                        </div>
                                        <hr>
                                        <button class="btn btn-info" ng-click="toggleMode()">
                                            12H / 24H
                                        </button>
                                        <button class="btn btn-default" ng-click="update()">
                                            Set to 14:00
                                        </button>
                                        <button class="btn btn-danger" ng-click="clear()">
                                            Clear
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-bold margin-top-25 margin-bottom-15">Date Range Picker</h5>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">
                                                Simple Date Range Picker
                                            </label>

                                            <div class="input-group range-picker">
                                                <div class="start-date">
                                                    <input type="text" class="form-control"
                                                           uib-datepicker-popup="yyyy/MM/dd" ng-model="start"
                                                           show-weeks="false" is-open="startOpened"
                                                           ng-init="startOpened = false" min-date="'1970-12-31'"
                                                           max-date="end" ng-required="true" close-text="Close"
                                                           ng-click="startOpen($event)"/>
                                                </div>
                                                <span class="input-group-addon">to</span>

                                                <div class="end-date">
                                                    <input type="text" class="form-control"
                                                           uib-datepicker-popup="yyyy/MM/dd" ng-model="end"
                                                           show-weeks="false" is-open="endOpened"
                                                           ng-init="endOpened = false" min-date="start"
                                                           max-date="maxDate" ng-required="true" close-text="Close"
                                                           ng-click="endOpen($event)"/>
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="text-bold margin-top-25 margin-bottom-15">Date Range Picker for
                                            Bootstrap</h5>
                                        <!-- /// controller:  'DateRangeCtrl' -  localtion: assets/js/controllers/daterangeCtrl.js /// -->
                                        <div ng-controller="DateRangeCtrl">
                                            <div class="form-group">
                                                <label for="daterange1" class="control-label">
                                                    Default
                                                </label>
                                                <input type="daterange" class="form-control" ng-model="dates"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="daterange1" class="control-label">
                                                    Custom Ranges
                                                </label>
                                                <input type="daterange" class="form-control" ng-model="dates2"
                                                       ranges="ranges"/>
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
    </div>
</div>
<!-- end: DATE/TIME Picker -->
<!-- start: COLOR PICKER -->
<div class="container-fluid container-fullw">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-body">
                    <h5 class="over-title">Angular Spectrum <span class="text-bold">Colorpicker</span></h5>

                    <p class="margin-bottom-30">
                        AngularJS Color Picker Directive.
                    </p>
                    <h5 class="text-bold margin-top-25 margin-bottom-15">Inline</h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title text-center">
                                        Default
                                    </div>
                                </div>
                                <div class="panel-body text-center">
                                    <p class="margin-bottom-30">
                                        Selected Color: <strong>{{inlineColor}}</strong>
                                    </p>
                                    <spectrum-colorpicker ng-model="inlineColor" format="'rgb'"
                                                          options="{flat: true, showInput: true, allowEmpty:true}"></spectrum-colorpicker>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title text-center">
                                        Palette
                                    </div>
                                </div>
                                <div class="panel-body text-center">
                                    <p class="margin-bottom-30">
                                        Selected Color: <strong>{{inlineColor2}}</strong>
                                    </p>
                                    <spectrum-colorpicker ng-model="inlineColor2" format="'rgb'"
                                                          options="{flat: true, showPaletteOnly: true, togglePaletteOnly: true, togglePaletteMoreText: 'more', togglePaletteLessText: 'less', palette: [['#000','#444','#666','#999','#ccc','#eee','#f3f3f3','#fff'], ['#f00','#f90','#ff0','#0f0','#0ff','#00f','#90f','#f0f'], ['#f4cccc','#fce5cd','#fff2cc','#d9ead3','#d0e0e3','#cfe2f3','#d9d2e9','#ead1dc'], ['#ea9999','#f9cb9c','#ffe599','#b6d7a8','#a2c4c9','#9fc5e8','#b4a7d6','#d5a6bd'], ['#e06666','#f6b26b','#ffd966','#93c47d','#76a5af','#6fa8dc','#8e7cc3','#c27ba0'], ['#c00','#e69138','#f1c232','#6aa84f','#45818e','#3d85c6','#674ea7','#a64d79'], ['#900','#b45f06','#bf9000','#38761d','#134f5c','#0b5394','#351c75','#741b47'], ['#600','#783f04','#7f6000','#274e13','#0c343d','#073763','#20124d','#4c1130']]}"></spectrum-colorpicker>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h5 class="text-bold margin-top-25 margin-bottom-15">Pickers</h5>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title text-center">
                                        HSL Format
                                    </div>
                                </div>
                                <div class="panel-body text-center" ng-init="myColor = 'hsl(207, 22%, 55%)'">
                                    <p class="margin-bottom-30">
                                        Selected Color: <strong>{{myColor}}</strong>
                                    </p>
                                    <spectrum-colorpicker ng-model="myColor" format="'hsl'"></spectrum-colorpicker>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title text-center">
                                        HSV Format
                                    </div>
                                </div>
                                <div class="panel-body text-center" ng-init="myColor2 = 'hsv(207, 32%, 65%)'">
                                    <p class="margin-bottom-30">
                                        Selected Color: <strong>{{myColor2}}</strong>
                                    </p>
                                    <spectrum-colorpicker ng-model="myColor2" format="'hsv'"></spectrum-colorpicker>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title text-center">
                                        RGB Format
                                    </div>
                                </div>
                                <div class="panel-body text-center" ng-init="myColor3 = 'rgb(113, 142, 165)'">
                                    <p class="margin-bottom-30">
                                        Selected Color: <strong>{{myColor3}}</strong>
                                    </p>
                                    <spectrum-colorpicker ng-model="myColor3" format="'rgb'"></spectrum-colorpicker>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title text-center">
                                        HEX Format
                                    </div>
                                </div>
                                <div class="panel-body text-center" ng-init="myColor4 = '#718ea5'">
                                    <p class="margin-bottom-30">
                                        Selected Color: <strong>{{myColor4}}</strong>
                                    </p>
                                    <spectrum-colorpicker ng-model="myColor4" format="'hex'"></spectrum-colorpicker>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title text-center">
                                        HEX8 Format
                                    </div>
                                </div>
                                <div class="panel-body text-center" ng-init="myColor5 = '#ff718ea5'">
                                    <p class="margin-bottom-30">
                                        Selected Color: <strong>{{myColor5}}</strong>
                                    </p>
                                    <spectrum-colorpicker ng-model="myColor5" format="'hex8'"></spectrum-colorpicker>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title text-center">
                                        Alpha
                                    </div>
                                </div>
                                <div class="panel-body text-center" ng-init="myColor6 = 'rgba(113, 142, 165, 0.99)'">
                                    <p class="margin-bottom-30">
                                        Selected Color: <strong>{{myColor6}}</strong>
                                    </p>
                                    <spectrum-colorpicker ng-model="myColor6" format="'rgba'"
                                                          options="{showAlpha: true}"></spectrum-colorpicker>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h5 class="text-bold margin-top-25 margin-bottom-15">Picker Control Options</h5>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title text-center">
                                        Show Input
                                    </div>
                                </div>
                                <div class="panel-body text-center" ng-init="myColor7 = '#73a189'">
                                    <p class="margin-bottom-30">
                                        Selected Color: <strong>{{myColor7}}</strong>
                                    </p>
                                    <spectrum-colorpicker ng-model="myColor7"
                                                          options="{showAlpha: true, showInput: true}"></spectrum-colorpicker>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title text-center">
                                        Disabled
                                    </div>
                                </div>
                                <div class="panel-body text-center" ng-init="myColor8 = '#73a189'">
                                    <p class="margin-bottom-30">
                                        Selected Color: <strong>{{myColor8}}</strong>
                                    </p>
                                    <spectrum-colorpicker ng-model="myColor8"
                                                          options="{disabled: true}"></spectrum-colorpicker>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title text-center">
                                        Show Palette
                                    </div>
                                </div>
                                <div class="panel-body text-center" ng-init="myColor9 = '#73a189'">
                                    <p class="margin-bottom-30">
                                        Selected Color: <strong>{{myColor9}}</strong>
                                    </p>
                                    <spectrum-colorpicker ng-model="myColor9"
                                                          options="{showPalette: true, palette: [['black', 'white', 'blanchedalmond', 'rgb(255, 128, 0);', 'hsv 100 70 50'],['red', 'yellow', 'green', 'blue', 'violet']]}"></spectrum-colorpicker>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title text-center">
                                        Show Palette Only
                                    </div>
                                </div>
                                <div class="panel-body text-center" ng-init="myColor10 = '#73a189'">
                                    <p class="margin-bottom-30">
                                        Selected Color: <strong>{{myColor10}}</strong>
                                    </p>
                                    <spectrum-colorpicker ng-model="myColor10"
                                                          options="{showPaletteOnly: true, showPalette: true, hideAfterPaletteSelect:true, palette: [['#000','#444','#666','#999','#ccc','#eee','#f3f3f3','#fff'], ['#f00','#f90','#ff0','#0f0','#0ff','#00f','#90f','#f0f'], ['#f4cccc','#fce5cd','#fff2cc','#d9ead3','#d0e0e3','#cfe2f3','#d9d2e9','#ead1dc'], ['#ea9999','#f9cb9c','#ffe599','#b6d7a8','#a2c4c9','#9fc5e8','#b4a7d6','#d5a6bd'], ['#e06666','#f6b26b','#ffd966','#93c47d','#76a5af','#6fa8dc','#8e7cc3','#c27ba0'], ['#c00','#e69138','#f1c232','#6aa84f','#45818e','#3d85c6','#674ea7','#a64d79'], ['#900','#b45f06','#bf9000','#38761d','#134f5c','#0b5394','#351c75','#741b47'], ['#600','#783f04','#7f6000','#274e13','#0c343d','#073763','#20124d','#4c1130']]}"></spectrum-colorpicker>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title text-center">
                                        Toggle Palette
                                    </div>
                                </div>
                                <div class="panel-body text-center" ng-init="myColor11 = '#73a189'">
                                    <p class="margin-bottom-30">
                                        Selected Color: <strong>{{myColor11}}</strong>
                                    </p>
                                    <spectrum-colorpicker ng-model="myColor11"
                                                          options="{showPaletteOnly: true, togglePaletteOnly: true, togglePaletteMoreText: 'more', togglePaletteLessText: 'less', palette: [['#000','#444','#666','#999','#ccc','#eee','#f3f3f3','#fff'], ['#f00','#f90','#ff0','#0f0','#0ff','#00f','#90f','#f0f'], ['#f4cccc','#fce5cd','#fff2cc','#d9ead3','#d0e0e3','#cfe2f3','#d9d2e9','#ead1dc'], ['#ea9999','#f9cb9c','#ffe599','#b6d7a8','#a2c4c9','#9fc5e8','#b4a7d6','#d5a6bd'], ['#e06666','#f6b26b','#ffd966','#93c47d','#76a5af','#6fa8dc','#8e7cc3','#c27ba0'], ['#c00','#e69138','#f1c232','#6aa84f','#45818e','#3d85c6','#674ea7','#a64d79'], ['#900','#b45f06','#bf9000','#38761d','#134f5c','#0b5394','#351c75','#741b47'], ['#600','#783f04','#7f6000','#274e13','#0c343d','#073763','#20124d','#4c1130']]}"></spectrum-colorpicker>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title text-center">
                                        Show Selection Palette
                                    </div>
                                </div>
                                <div class="panel-body text-center" ng-init="myColor12 = '#73a189'">
                                    <p class="margin-bottom-30">
                                        Selected Color: <strong>{{myColor12}}</strong>
                                    </p>
                                    <spectrum-colorpicker ng-model="myColor12"
                                                          options="{showPalette: true, showSelectionPalette: true, palette: [ ]}"></spectrum-colorpicker>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title text-center">
                                        Show Initial
                                    </div>
                                </div>
                                <div class="panel-body text-center" ng-init="myColor13 = '#73a189'">
                                    <p class="margin-bottom-30">
                                        Selected Color: <strong>{{myColor13}}</strong>
                                    </p>
                                    <spectrum-colorpicker ng-model="myColor13"
                                                          options="{showInitial: true}"></spectrum-colorpicker>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title text-center">
                                        Show Input and Initial
                                    </div>
                                </div>
                                <div class="panel-body text-center" ng-init="myColor14 = '#73a189'">
                                    <p class="margin-bottom-30">
                                        Selected Color: <strong>{{myColor14}}</strong>
                                    </p>
                                    <spectrum-colorpicker ng-model="myColor14"
                                                          options="{showInitial: true, showInput: true}"></spectrum-colorpicker>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title text-center">
                                        Button Text
                                    </div>
                                </div>
                                <div class="panel-body text-center" ng-init="myColor15 = '#73a189'">
                                    <p class="margin-bottom-30">
                                        Selected Color: <strong>{{myColor15}}</strong>
                                    </p>
                                    <spectrum-colorpicker ng-model="myColor15"
                                                          options="{allowEmpty:true, chooseText: 'Alright', cancelText: 'No way'}"></spectrum-colorpicker>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: COLOR PICKER -->
<!-- start: RATING -->
<div class="container-fluid container-fullw">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-body">
                    <h5 class="over-title margin-bottom-15">Rate <span class="text-bold">Picker</span></h5>

                    <p>
                        Rating directive that will take care of visualising a star rating bar.
                    </p>
                    <!-- /// controller:  'RatingDemoCtrl' -  localtion: assets/js/controllers/bootstrapCtrl.js /// -->
                    <div ng-controller="RatingDemoCtrl">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="panel panel-transparent">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            Default
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <p class="text-small">
                                            Four options are available: top, right, bottom, and left aligned.
                                        </p>

                                        <div class="margin-bottom-15 text-extra-large">
                                            <uib-rating ng-model="rate" max="max" readonly="isReadonly"
                                                        on-hover="hoveringOver(value)"
                                                        on-leave="overStar = null"></uib-rating>
                                            <span class="label"
                                                  ng-class="{'label-warning': percent<30, 'label-info': percent>=30 && percent<70, 'label-success': percent>=70}"
                                                  ng-show="overStar && !isReadonly">{{percent}}%</span>
                                        </div>
                                        <div class="well">
                                            Rate: <b>{{rate}}</b> - Readonly is: <i>{{isReadonly}}</i> - Hovering over:
                                            <b>{{overStar || "none"}}</b>
                                        </div>
                                        <button class="btn btn-primary" ng-click="rate = 0" ng-disabled="isReadonly">
                                            Clear
                                        </button>
                                        <button class="btn btn-default" ng-click="isReadonly = ! isReadonly">
                                            Toggle Readonly
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="panel panel-transparent">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            Custom icons
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <p class="text-small">
                                            Four options are available: top, right, bottom, and left aligned.
                                        </p>

                                        <div ng-init="x = 3" class="margin-bottom-30">
                                            <uib-rating ng-model="x" max="5"
                                                        state-on="'fa fa-star text-yellow text-extra-large margin-right-5'"
                                                        state-off="'fa fa-star-o text-large margin-right-5'"></uib-rating>
                                            <b>(<i>Rate:</i> {{x}})</b>
                                        </div>
                                        <div ng-init="h = 7">
                                            <uib-rating ng-model="h" max="10"
                                                        state-on="'fa fa-heart text-red text-extra-large margin-right-5'"
                                                        state-off="'fa fa-heart-o text-large margin-right-5'"></uib-rating>
                                            <b>(<i>Love:</i> {{h}})</b>
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
</div>
<!-- end: RATING -->
