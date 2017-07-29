'use strict';
app.directive('resizeto', function () {
    return {
        restrict: 'E',
        template: ' <div class="pull-left captcha-input capthcha-input-font" ng-model="operator"> <input class="form-control" type="text" name="width" ng-click="test2()" ng-model="myModel.width" required="required" ng-required="currentStep == 1"></div>',
        scope: {

            field1: "@", //variables de alcance($scope) o por valor
            field2: "@", //variables de alcance($scope) o por valor
            operator: "@" //variables de alcance($scope) o por valor
        },

        text: function (scope, elem, attrs) {


            elem.bind('click', function () {

            });
        }


    }
});


