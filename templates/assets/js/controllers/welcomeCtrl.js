'use strict';

/**

 * controller for Wizard Form example

 */

app.controller('welcomeCtrl', ['$scope' ,'$filter','$http','$document','$cookies','authFact',
    function ($scope,$filter, $http,$document, $cookies,authFact) {


      $scope.messages = [];

        var meassageId = authFact.getAccessToken('message');
        $scope.msgHide=true;
       if(meassageId>0){
            $scope.msgHide=false;
            var message =  $http.get(siteUrl+'/wp-content/plugins/oel-cmp/templates/assets/api/messages.js').success(function (data) {
               $scope.messages = $filter('filter')(data.messages, {
                   id: meassageId
               });

            });

          }

        $scope.closeAlert = function (index) {
            $cookies.remove('message');
            $scope.messages.splice(index, 1);

        };


    }])




