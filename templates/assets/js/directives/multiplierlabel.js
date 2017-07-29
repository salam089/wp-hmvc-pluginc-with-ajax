'use strict';
app.directive('multiplierlabel', function()
{
    var labelTemplate;
    labelTemplate='<div class="hourbar" ng-repeat="m in multipliers">' +
        '<span style="width:{{step}}%;" id="range-2" class="lebel">&nbsp;{{m.technicalTimeFrame}}</span>' +
        '<span style="width:{{step}}%;" id="range-3" class="lebel">&nbsp;</span>' +
        '<span style="width:{{step}}%;" id="range-4" class="lebel">&nbsp;</span>' +
        '<span style="width:{{step}}%;" id="range-5" class="lebel">&nbsp;</span>' +
        '<span style="width:{{step}}%;" id="range-6" class="lebel">&nbsp;</span>' +
        '</div>'


    return{
        restrict: 'E',
        template:labelTemplate,
        scope:
        {
            field1: "@",
            field2: "@",
            operator: "@",
            multipliers: "@",
            step:"@"
        },
    }
});