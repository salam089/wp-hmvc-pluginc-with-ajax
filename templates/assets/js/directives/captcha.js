'use strict';
app.directive('captcha', function()
{
    return{
        restrict: 'E',
        template: ' <div id="digit1" class="pull-left capthcha-input-font" ng-model="field1">{{field1}}</div>' +
        ' <div class="pull-left captcha-input capthcha-input-font" ng-model="operator">{{operator}}</div>' +
        ' <div id="digit2 " class="pull-left captcha-input capthcha-input-font" ng-model="field2">{{field2}}</div>' +
        '<div class="pull-left captcha-input capthcha-input-font"> = </div>',
        scope:
        {
            field1: "@", //variables de alcance($scope) o por valor
            field2: "@", //variables de alcance($scope) o por valor
            operator: "@" //variables de alcance($scope) o por valor
        },
    }
});



