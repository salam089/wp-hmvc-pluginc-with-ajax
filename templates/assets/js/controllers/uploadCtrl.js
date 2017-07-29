'use strict';
/** 
  * controllers for Angular File Upload
*/


var prevUploadedFilesStack;
var canceled = 0;
var deleted = 0;
var queued = 0;
var uploadedOld = 0;
var numberOfFiles = 0; // or sessionStorage.getItem('number_of_files')
var queuedFiles = new Array();

var isOnGitHub = window.location.hostname === 'localhostf',
    url = isOnGitHub ? 'server/php/' : 'wp-content/plugins/oel-cmp/templates/assets/js/uploader/server/php/';//ajaxUrl+'?action=upload_handaler';




app.controller('DemoFileUploadController', [
    '$scope', '$http', '$filter', '$window','$element',
    function ($scope, $http, $element) {

        $scope.master = $scope.myModel;



        $scope.options = {
            url: url,
            prependFiles:'unshift',
            uniqueNames: true,
            singleFileUploads:true,
            maxChunkSize: 2000000, // 2 MB uploaded
            //maxNumberOfFiles: 1,
            autoUpload:true,



        };





        if (!isOnGitHub) {
            $scope.loadingFiles = true;
            $http.get(url)
                .then(
                function (response) {
                    $scope.loadingFiles = false;
                    $scope.queue = response.data.files || [];
                },
                function () {
                    $scope.loadingFiles = false;
                }
            );

        }


    }
])

app.controller('FileDestroyController', [
    '$scope', '$http',
    function ($scope, $http) {
        var file = $scope.file,
            state;
        if (file.url) {
            file.$state = function () {
                return state;
            };
            file.$destroy = function () {
                state = 'pending';
                $scope.$parent.numberOfFiles = ($scope.$parent.numberOfFiles-1);

                return $http({
                    url: file.deleteUrl,
                    method: file.deleteType
                }).then(
                    function () {
                        state = 'resolved';
                        $scope.clear(file);
                    },
                    function () {
                        state = 'rejected';
                    }
                );
            };
        } else if (!file.$cancel && !file._index) {
            file.$cancel = function () {
                $scope.clear(file);
            };
        }
    }
]);


