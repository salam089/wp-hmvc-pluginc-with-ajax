<!-- start: BREADCRUMB -->
<div class="breadcrumb-wrapper">
    <h4 class="mainTitle no-margin" translate="sidebar.nav.forms.XEDITABLE">X-EDITABLE ELEMENTS</h4>

    <div ncy-breadcrumb class="pull-right"></div>
</div>
<!-- end: BREADCRUMB -->
<!-- start: XEDITABLE -->
<div class="container-fluid container-fullw">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-body">
                    <h5 class="over-title margin-bottom-15"><span class="text-bold">Angular-xeditable</span></h5>

                    <p>
                        It is based on ideas of x-editable but was written from scratch to use power of angular and
                        support complex forms / editable grids.
                    </p>

                    <div class="row margin-top-30">
                        <div class="col-lg-6 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Edit Text</h5>
                                </div>
                                <div class="panel-body">
                                    <p>
                                        To make element editable via textbox just add
                                        <code>
                                            editable-text="model.field"
                                        </code>
                                        attribute.
                                    </p>

                                    <div class="well">
                                        <!-- /// controller:  'TextSimpleCtrl' -  localtion: assets/js/controllers/xeditableCtrl.js /// -->
                                        <div ng-controller="TextSimpleCtrl" class="ng-scope">
                                            <a href="#" editable-text="example.name"> {{ example.name || 'empty' }} </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Select Local</h5>
                                </div>
                                <div class="panel-body">
                                    <p>
                                        To create editable select (dropdown) just set
                                        <code>
                                            editable-select
                                        </code>
                                        attribute pointing to model.
                                        To pass dropdown options you should define
                                        <code>
                                            e-ng-options
                                        </code>
                                        attribute
                                        that works like normal angular
                                        <code>
                                            ng-options
                                        </code>
                                        but is transfered to underlying
                                        <code>
                                            &lt;select&gt;
                                        </code>
                                        from original element.
                                    </p>

                                    <div class="well">
                                        <!-- /// controller:  'SelectLocalCtrl' -  localtion: assets/js/controllers/xeditableCtrl.js /// -->
                                        <div ng-controller="SelectLocalCtrl">
                                            <a href="#" editable-select="example.status"
                                               e-ng-options="s.value as s.text for s in statuses"> {{ showStatus()
                                                }} </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Select Remote</h5>
                                </div>
                                <div class="panel-body">
                                    <p>
                                        To load select options from remote url you should define
                                        <code>
                                            onshow
                                        </code> attribute pointing to scope function.
                                        The result of function should be a $http promise, it allows to disable element
                                        while loading.
                                    </p>

                                    <div class="well">
                                        <!-- /// controller:  'SelectRemoteCtrl' -  localtion: assets/js/controllers/xeditableCtrl.js /// -->
                                        <div ng-controller="SelectRemoteCtrl">
                                            <a href="#" editable-select="example.group" onshow="loadGroups()"
                                               e-ng-options="g.id as g.text for g in groups"> {{ example.groupName ||
                                                'not set' }} </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Textarea</h5>
                                </div>
                                <div class="panel-body">
                                    <p>
                                        To make element editable via textarea just add
                                        <code>
                                            editable-textarea
                                        </code>
                                        attribute
                                        pointing to model in scope. You can also wrap content into
                                        <code>
                                            &lt;pre&gt;
                                        </code>
                                        tags to keep linebreaks.
                                        Data can be submitted by <em>Ctrl + Enter</em>.
                                    </p>

                                    <div class="well">
                                        <!-- /// controller:  'TextareaCtrl' -  localtion: assets/js/controllers/xeditableCtrl.js /// -->
                                        <div ng-controller="TextareaCtrl">
                                            <a href="#" editable-textarea="example.desc" e-rows="7" e-cols="40">
                                                <pre>{{ example.desc || 'no description' }}</pre>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Checkbox</h5>
                                </div>
                                <div class="panel-body">
                                    <p>
                                        To make element editable via checkbox just add
                                        <code>
                                            editable-checkbox
                                        </code>
                                        attribute
                                        pointing to model in scope. Set
                                        <code>
                                            e-title
                                        </code>
                                        attribute to define text shown with checkbox.
                                    </p>

                                    <div class="well">
                                        <!-- /// controller:  'CheckboxCtrl' -  localtion: assets/js/controllers/xeditableCtrl.js /// -->
                                        <div ng-controller="CheckboxCtrl">
                                            <a href="#" editable-checkbox="example.remember" e-title="Remember?"> {{
                                                example.remember && "Remember me!" || "Don't remember" }} </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Checklist</h5>
                                </div>
                                <div class="panel-body">
                                    <p>
                                        To create list of checkboxes use
                                        <code>
                                            editable-checklist
                                        </code>
                                        attribute pointing to model.
                                        Also you should define
                                        <code>
                                            e-ng-options
                                        </code>
                                        attribute to set value and display items.
                                    </p>

                                    <div class="well">
                                        <!-- /// controller:  'ChecklistCtrl' -  localtion: assets/js/controllers/xeditableCtrl.js /// -->
                                        <div ng-controller="ChecklistCtrl">
                                            <a href="#" editable-checklist="example.status"
                                               e-ng-options="s.value as s.text for s in statuses"> {{ showStatus()
                                                }} </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Radiolist</h5>
                                </div>
                                <div class="panel-body">
                                    <p>
                                        To create list of radios use
                                        <code>
                                            editable-radiolist
                                        </code>
                                        attribute pointing to model.
                                        Also you should define
                                        <code>
                                            e-ng-options
                                        </code>
                                        attribute to set value and display items.
                                        By default, radioboxes aligned <em>horizontally</em>.
                                    </p>

                                    <div class="well">
                                        <!-- /// controller:  'RadiolistCtrl' -  localtion: assets/js/controllers/xeditableCtrl.js /// -->
                                        <div ng-controller="RadiolistCtrl">
                                            <a href="#" editable-radiolist="example.status"
                                               e-ng-options="s.value as s.text for s in statuses"> {{ showStatus()
                                                }} </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Validate</h5>
                                </div>
                                <div class="panel-body">
                                    <p>
                                        Validation is performed via <code>
                                            onbeforesave</code>
                                        attribute pointing to validation method.
                                        Value is available as <code>
                                            $data</code>
                                        parameter. If method returns <strong>string</strong> - validation failed
                                        and string shown as error message.
                                    </p>

                                    <div class="well">
                                        <!-- /// controller:  'ValidateLocalCtrl' -  localtion: assets/js/controllers/xeditableCtrl.js /// -->
                                        <div ng-controller="ValidateLocalCtrl">
                                            <a href="#" editable-text="user.name" onbeforesave="checkName($data)"> {{
                                                user.name || 'empty' }} </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Hide buttons</h5>
                                </div>
                                <div class="panel-body">
                                    <p>
                                        To hide <em>Ok</em> and <em>Cancel</em> buttons you may set
                                        <code>
                                            buttons="no"
                                        </code> attribute.
                                        New value will be saved automatically after change.
                                    </p>
                                    <!-- /// controller:  'SelectNobuttonsCtrl' -  localtion: assets/js/controllers/xeditableCtrl.js /// -->
                                    <div class="well">
                                        <div ng-controller="SelectNobuttonsCtrl">
                                            <a href="#" editable-select="user.status" buttons="no"
                                               e-ng-options="s.value as s.text for s in statuses"> {{ showStatus()
                                                }} </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Select multiple</h5>
                                </div>
                                <div class="panel-body">
                                    <p>
                                        Just define
                                        <code>
                                            e-multiple
                                        </code>
                                        attribute that will be transfered to select as
                                        <code>
                                            multiple
                                        </code>
                                        .
                                    </p>

                                    <div class="well">
                                        <!-- /// controller:  'SelectMultipleCtrl' -  localtion: assets/js/controllers/xeditableCtrl.js /// -->
                                        <div ng-controller="SelectMultipleCtrl">
                                            <a href="#" editable-select="user.status" e-multiple
                                               e-ng-options="s.value as s.text for s in statuses"> {{ showStatus()
                                                }} </a>
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
<!-- end: XEDITABLE -->
