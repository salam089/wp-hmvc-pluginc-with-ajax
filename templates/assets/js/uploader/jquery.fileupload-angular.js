/*
 * jQuery File Upload AngularJS Plugin
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2013, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* jshint nomen:false */
/* global define, angular */

;(function (factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        // Register as an anonymous AMD module:
        define([
            'jquery',
            'angular',
            './jquery.fileupload-image',
            './jquery.fileupload-audio',
            './jquery.fileupload-video',
            './jquery.fileupload-validate'
        ], factory);
    } else {
        factory();
    }
}(function () {
    'use strict';
    var prevUploadedFilesStack;
    var canceled = 0;
    var deleted = 0;
    var queued = 0;
    var uploadedOld = 0;
    var numberOfFiles = 0; // or sessionStorage.getItem('number_of_files')
    var queuedFiles = new Array();
    var number_of_files = 0;
    angular.module('blueimp.fileupload', [])

        // The fileUpload service provides configuration options
        // for the fileUpload directive and default handlers for
        // File Upload events:
        .provider('fileUpload', function () {

            var scopeEvalAsync = function (expression) {
                    var scope = angular.element(this).fileupload('option', 'scope');
                    // Schedule a new $digest cycle if not already inside of one
                    // and evaluate the given expression:
                    scope.$evalAsync(expression);
                },
                addFileMethods = function (scope, data) {
                    var files = data.files,
                        file = files[0];
                    angular.forEach(files, function (file, index) {
                        file._index = index;
                        file.$state = function () {
                            return data.state();
                        };
                        file.$processing = function () {
                            return data.processing();
                        };
                        file.$progress = function () {
                            return data.progress();
                        };
                        file.$response = function () {
                            return data.response();
                        };
                    });
                    file.$submit = function () {
                        if (!file.error) {
                            return data.submit();
                        }
                    };
                    file.$cancel = function () {
                        return data.abort();
                    };
                },$config;
            $config = this.defaults = {
                handleResponse: function (e, data) {
                    var files = data.result && data.result.files;
                    if (files) {
                        data.scope.replace(data.files, files);
                    } else if (data.errorThrown ||
                            data.textStatus === 'error') {
                        data.files[0].error = data.errorThrown ||
                            data.textStatus;
                    }
                },
                add: function (e, data) {
                    //console.log(queuedFiles);
                    

                    if (e.isDefaultPrevented()) {
                        return false;
                    }
                    var scope = data.scope,
                        filesCopy = [];

                    if(data.files.length>0 && data.doSubmit){
                        angular.forEach(data.files, function (file) {
                            filesCopy.push(file);
                        });
                    }

                    scope.$parent.$applyAsync(function () {
                        console.log("2nd"+data.doSubmit );
                        if(data.files.length>0 && data.doSubmit){
                            addFileMethods(scope, data);
                            var method = scope.option('prependFiles') ?
                                'unshift' : 'push';
                            Array.prototype[method].apply(scope.queue, data.files);
                        }

                    });
                    data.process(function () {
                        return scope.process(data);
                    }).always(function () {

                        if( data.files.length>0 && data.doSubmit){
                            scope.$parent.$applyAsync(function () {
                                addFileMethods(scope, data);
                                scope.replace(filesCopy, data.files);
                            });
                        }

                    }).then(function () {

                        if ((scope.option('autoUpload') ||
                                data.autoUpload) &&
                                data.autoUpload !== false) {
                            if(data.files.length>0 &&  data.doSubmit) {
                                data.submit();
                            }

                        }
                    });
                },
                done: function (e, data) {
                    if (e.isDefaultPrevented()) {
                        return false;
                    }
                    var that = this;
                    data.scope.$apply(function () {
                        data.handleResponse.call(that, e, data);
                    });
                },
                fail: function (e, data) {
                    if (e.isDefaultPrevented()) {
                        return false;
                    }
                    var that = this,
                        scope = data.scope;
                    if (data.errorThrown === 'abort') {
                        scope.clear(data.files);
                        return;
                    }
                    scope.$apply(function () {
                        data.handleResponse.call(that, e, data);
                    });
                },
                stop: scopeEvalAsync,
                processstart: scopeEvalAsync,
                processstop: scopeEvalAsync,
                getNumberOfFiles: function () {
                    var scope = this.scope;
                    return scope.queue.length - scope.processing();
                },
                dataType: 'json',
                autoUpload: false
            };
            this.$get = [
                function () {
                    return {
                        defaults: $config
                    };
                }
            ];
        })

        // Format byte numbers to readable presentations:
        .provider('formatFileSizeFilter', function () {
            var $config = {
                // Byte units following the IEC format
                // http://en.wikipedia.org/wiki/Kilobyte
                units: [
                    {size: 1000000000, suffix: ' GB'},
                    {size: 1000000, suffix: ' MB'},
                    {size: 1000, suffix: ' KB'}
                ]
            };
            this.defaults = $config;
            this.$get = function () {
                return function (bytes) {
                    if (!angular.isNumber(bytes)) {
                        return '';
                    }
                    var unit = true,
                        i = 0,
                        prefix,
                        suffix;
                    while (unit) {
                        unit = $config.units[i];
                        prefix = unit.prefix || '';
                        suffix = unit.suffix || '';
                        if (i === $config.units.length - 1 || bytes >= unit.size) {
                            return prefix + (bytes / unit.size).toFixed(2) + suffix;
                        }
                        i += 1;
                    }
                };
            };
        })

        // The FileUploadController initializes the fileupload widget and
        // provides scope methods to control the File Upload functionality:
        .controller('FileUploadController', [
            '$scope', '$element', '$attrs', '$window', 'fileUpload','$http',
            function ($scope, $element, $attrs, $window, fileUpload, $http) {
                var prevUploadedFilesStack;
                var canceled = 0;
                var deleted = 0;
                var queued = 0;
                var uploadedOld = 0;
                var numberOfFiles = 0; // or sessionStorage.getItem('number_of_files')
                var queuedFiles = new Array();
                var doSubmit = true;
                $scope.showTotalUploadedCount=true;
                $scope.showUploadingCount = false;
                $scope.srcUrl = "http://www.clippingpath.dev/wp-content/plugins/oel-cmp/templates/assets/js/uploader/server/php/index.php";

                $http({
                    method: 'GET',
                    url: $scope.srcUrl,
                    dataType: 'json'
                }).success(function(data){

                    prevUploadedFilesStack = data.files;
                    var newArr = [];
                    angular.forEach(prevUploadedFilesStack, function (val, key) {
                        uploadedOld = uploadedOld + 1;
                    }, newArr);
                    $scope.showTotalUploadedCount = true;
                    $scope.numberOfFiles=uploadedOld ;
                    sessionStorage.setItem('uploaded', uploadedOld);
                });

                var uploadMethods = {
                    progress: function () {
                        return $element.fileupload('progress');
                    },
                    active: function () {
                        return $element.fileupload('active');
                    },
                    option: function (option, data) {
                        if (arguments.length === 1) {
                            return $element.fileupload('option', option);
                        }
                        $element.fileupload('option', option, data);
                    },
                    add: function (data) {
                        return $element.fileupload('add', data);
                    },
                    send: function (data) {

                        return $element.fileupload('send', data);
                    },
                    process: function (data) {
                        return $element.fileupload('process', data);
                    },
                    processing: function (data) {
                        return false;//$element.fileupload('processing', data);
                    }
                };
                $scope.disabled = !$window.jQuery.support.fileInput;
                $scope.queue = $scope.queue || [];



                $scope.clear = function (files) {
                    var queue = this.queue,
                        i = queue.length,
                        file = files,
                        length = 1;
                    if (angular.isArray(files)) {
                        file = files[0];
                        length = files.length;
                    }
                    while (i) {
                        i -= 1;
                        if (queue[i] === file) {
                            return queue.splice(i, length);
                        }
                    }
                };
                $scope.replace = function (oldFiles, newFiles) {
                    var queue = this.queue,
                        file = oldFiles[0],
                        i,
                        j;
                    for (i = 0; i < queue.length; i += 1) {
                        if (queue[i] === file) {
                            for (j = 0; j < newFiles.length; j += 1) {
                                queue[i + j] = newFiles[j];
                            }
                            return;
                        }
                    }
                };
                $scope.applyOnQueue = function (method) {

                    var quedFiles=[];

                    var list = this.queue.slice(0), i, file;

                    for (i = 0; i < list.length; i += 1) {
                        file = list[i];
                        if (file[method]&& 1) {
                            quedFiles.push(list[i].name);
                            file[method]();
                        }
                    }

                };
                $scope.submit = function () {
                    doSubmit = false;
                    this.applyOnQueue('$submit');
                };
                $scope.cancel = function () {
                    this.applyOnQueue('$cancel');
                };

                $scope.closeWarning=function(){
                    queuedFiles = new Array();
                    $scope.alreadyAddedFile = queuedFiles;
                }


                // Add upload methods to the scope:
                angular.extend($scope, uploadMethods);
                // The fileupload widget will initialize with
                // the options provided via "data-"-parameters,
                // as well as those given via options object:
                $element.fileupload(angular.extend(
                    {scope: $scope},
                    fileUpload.defaults
                )).bind('fileuploadadd', function (e, data) {
                    data.scope = $scope;
                    $scope.showUploadingCount = true;
                    $scope.showTotalUploadedCount=true;
                    var requestedFileName = data.files[0].name;


                    if(queuedFiles.indexOf(requestedFileName) != -1)
                    {
                        // element found
                        doSubmit = false;
                    }else{
                        // element not found
                        doSubmit = true;
                    }


                    var currentfiles = [];
                    angular.forEach(data.scope.queue, function(File, key) {
                       this.push(File.name);
                    }, currentfiles);
                    data.files = $.map(data.files, function(file,i){
                            data.doSubmit = true;
                        if ($.inArray(file.name,currentfiles) >= 0) {

                            if(queuedFiles.indexOf(requestedFileName) != -1)
                            {

                            }else{
                                queuedFiles.push(file.name);
                                $scope.alreadyAddedFile = queuedFiles;
                            }
                            //queuedFiles.push(file.name);
                          //alert("The "+file.name+" file is already exits. You have to delete the file before send it to the queue.");
                            file.error=true;
                            data.doSubmit = false;
                            return null;
                        }
                        return file;
                    });





                }).bind('fileuploadsend',function(e, data){

                    //$http({
                    //    method: 'DELETE',
                    //    url: $scope.srcUrl+"?file="+data.files[0].name,
                    //    dataType: 'json'
                    //}).success(function(data){
                    //    return false;
                    //});
                }).on('fileuploadfail', function (e, data) {
                    if (data.errorThrown === 'abort') {
                        return;
                    }
                    if (data.dataType &&
                            data.dataType.indexOf('json') === data.dataType.length - 4) {
                        try {
                            data.result = angular.fromJson(data.jqXHR.responseText);
                        } catch (ignore) {}
                    }
                }).bind('fileuploadprocess',function(e, data){


                }).on('fileuploadprocessdone', function (e, data) {

                }).on('fileuploaddone', function (e, data) {

                    queuedFiles.splice($.inArray(data.files[0].name, queuedFiles), 1);
                    var uploaded = sessionStorage.getItem('uploaded');
                    var errorUploaded = 1;
                    if (isNaN(uploaded) == true) {
                        sessionStorage.setItem('uploaded', 0);
                        uploaded = 1;
                    }
                    $.each(data.files, function (index, file) {
                        var response = JSON.parse(data.jqXHR.responseText);
                        if (response.files != 'undefined') {
                            for (var n in response.files) {
                                errorUploaded = response.files[n]['error'];
                            }
                        }
                        if (typeof errorUploaded != 'undefined') {
                            uploaded = parseInt(uploaded);
                        } else {
                            uploaded = parseInt(uploaded) + 1;
                        }

                    });

                    $scope.numberOfFiles = ($scope.numberOfFiles+1)
                    sessionStorage.setItem('uploaded', uploaded);
                    $scope.showUploadingCount = true;
                    $scope.showTotalUploadedCount=true;
                }).on('fileuploadfail', function(e, data){
                    var uploaded = sessionStorage.getItem('uploaded');
                    $scope.numberOfFiles = ($scope.numberOfFiles+uploaded)
                    sessionStorage.setItem('uploaded', uploaded);
                    $scope.showUploadingCount = false;
                    $scope.showTotalUploadedCount=true;

                    $http({
                        method: 'DELETE',
                        url: $scope.srcUrl+"?file="+data.files[0].name,
                        dataType: 'json'
                    }).success(function(data){
                        return true;
                    });
                }).on([
                    'fileuploadadd',
                    'fileuploadsubmit',
                    'fileuploadsend',
                    'fileuploaddone',
                    'fileuploadfail',
                    'fileuploadalways',
                    'fileuploadprogress',
                    'fileuploadprogressall',
                    'fileuploadstart',
                    'fileuploadstop',
                    'fileuploadchange',
                    'fileuploadpaste',
                    'fileuploaddrop',
                    'fileuploaddragover',
                    'fileuploadchunksend',
                    'fileuploadchunkdone',
                    'fileuploadchunkfail',
                    'fileuploadchunkalways',
                    'fileuploadprocessstart',
                    'fileuploadprocess',
                    'fileuploadprocessdone',
                    'fileuploadprocessfail',
                    'fileuploadprocessalways',
                    'fileuploadprocessstop'
                ].join(' '), function (e, data) {
                    $scope.$parent.$applyAsync(function () {
                        if ($scope.$emit(e.type, data).defaultPrevented) {
                            e.preventDefault();
                        }
                    });
                }).on('remove', function () {
                    // Remove upload methods from the scope,
                    // when the widget is removed:

                    $scope.numberOfFiles=($scope.numberOfFiles -1);

                    var method;
                    for (method in uploadMethods) {
                        if (uploadMethods.hasOwnProperty(method)) {
                            delete $scope[method];
                        }
                    }
                });
                // Observe option changes:
                $scope.$watch(
                    $attrs.fileUpload,
                    function (newOptions) {
                        if (newOptions) {
                            $element.fileupload('option', newOptions);
                        }
                    }
                );
            }
        ])

        // Provide File Upload progress feedback:
        .controller('FileUploadProgressController', [
            '$scope', '$attrs', '$parse',
            function ($scope, $attrs, $parse) {
                var fn = $parse($attrs.fileUploadProgress),
                    update = function () {
                        var progress = fn($scope);
                        if (!progress || !progress.total) {
                            return;
                        }
                        $scope.num = Math.floor(
                            progress.loaded / progress.total * 100
                        );
                    };
                update();
                $scope.$watch(
                    $attrs.fileUploadProgress + '.loaded',
                    function (newValue, oldValue) {
                        if (newValue !== oldValue) {
                            update();
                        }
                    }
                );
            }
        ])

        // Display File Upload previews:
        .controller('FileUploadPreviewController', [
            '$scope', '$element', '$attrs',
            function ($scope, $element, $attrs) {
                $scope.$watch(
                    $attrs.fileUploadPreview + '.preview',
                    function (preview) {
                        $element.empty();
                        if (preview) {
                            $element.append(preview);
                        }
                    }
                );
            }
        ])

        .directive('fileUpload', function () {
            return {
                controller: 'FileUploadController',
                scope: true
            };
        })

        .directive('fileUploadProgress', function () {
            return {
                controller: 'FileUploadProgressController',
                scope: true
            };
        })

        .directive('fileUploadPreview', function () {
            return {
                controller: 'FileUploadPreviewController'
            };
        })

        // Enhance the HTML5 download attribute to
        // allow drag&drop of files to the desktop:
        .directive('download', function () {
            return function (scope, elm) {
                elm.on('dragstart', function (e) {
                    try {
                        e.originalEvent.dataTransfer.setData(
                            'DownloadURL',
                            [
                                'application/octet-stream',
                                elm.prop('download'),
                                elm.prop('href')
                            ].join(':')
                        );
                    } catch (ignore) {}
                });
            };
        });

}));
