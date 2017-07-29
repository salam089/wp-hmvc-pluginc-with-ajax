'use strict';
/**
 * controller for Wizard Form example
 */
app.controller('PlaceorderCtrl', ['$scope', '$document', '$uibModal', '$log', 'ngNotify', 'ajaxData', 'resizeTo',
    function ($scope, $document, $uibModal, $log, ngNotify, ajaxData, resizeTo) {
        $scope.currentStep = 1;
        // resizeTo.getOperation();
        $scope.test = function (obj, value) {
            console.log(obj);
        }
        $scope.captchaRefresh = function () {
            resizeTo.getOperation();
            $scope.captchaResult = "";
        }
        // Initial Value
        $scope.form = {
            next: function (form) {
                $scope.toTheTop();
                if (form.$valid) {
                    form.$setPristine();
                    nextStep();
                    console.log('ghjghjgh');
                } else {
                    var field = null,
                        firstError = null;
                    for (field in form) {
                        if (field[0] != '$') {
                            if (firstError === null && !form[field].$valid) {
                                firstError = form[field].$name;
                            }
                            if (form[field].$pristine) {
                                form[field].$dirty = true;
                            }
                        }
                    }
                    angular.element('.ng-invalid[name=' + firstError + ']').focus();
                    errorMessage();
                }
            },
            prev: function (form) {
                $scope.toTheTop();
                prevStep();
            },
            goTo: function (form, i) {
                if (parseInt($scope.currentStep) > parseInt(i)) {
                    $scope.toTheTop();
                    goToStep(i);
                } else {
                    if (form.$valid) {
                        $scope.toTheTop();
                        goToStep(i);
                    } else
                        errorMessage();
                }
            },
            submit: function () {
            },
            reset: function () {
            }
        };
        var nextStep = function () {
            $scope.currentStep++;
        };
        var prevStep = function () {
            $scope.currentStep--;
        };
        var goToStep = function (i) {
            $scope.currentStep = i;
        };
        var errorMessage = function (i) {
            ngNotify.set('please complete the form in this step before proceeding', {
                theme: 'pure',
                position: 'top',
                type: 'error',
                button: 'true',
                sticky: 'false',
            });
        };
        $scope.oddevenclass = ['odd', 'even'];
        $scope.templateId = '';
        $scope.items = ['temp1', 'temp2', 'temp3', 'temp4'];
        $scope.timesused = ['22', '11', '3', '2'];
        //     var data = [{
        //     id: 1,
        //     tempname: "Shows print 2016 milan",
        //     lastused : "30 May 2016",
        //     timesused:"20",
        // },{
        //     id: 2,
        //     tempname: "Shows print 2016 milan2",
        //     lastused : "20 May 2016",
        //     timesused:"26",
        // },
        // ];
        $scope.editId = "";
        $scope.open = function (size) {
            var modalInstance = $uibModal.open({
                templateUrl: 'myModalContent.html',
                controller: 'ModalInstanceCtrl',
                size: size,
                resolve: {
                    items: function () {
                        return $scope.items;
                    },
                    editId: function () {
                        return $scope.editId
                    }
                }
            });
            modalInstance.result.then(function (selectedItem) {
                $scope.selected = selectedItem;
            }, function () {
                $log.info('Modal dismissed at: ' + new Date());
            });
        };
// 3rd modal code
        // $scope.tempdetail = function() {
        //     //alert('kafjkasfklsk');
        //     $uibModalInstance.dismiss('cancel');
        //     var size = "200";
        //     var modalInstance = $uibModal.open({
        //         templateUrl: 'templatedtail.html',
        //         //controller: 'ModalInstanceCtrl',
        //         size: size,
        //         resolve: {
        //         }
        //     });
        //     modalInstance.result.then(function() {
        //     }, function() {
        //         $log.info('Modal dismissed at: ' + new Date());
        //     });
        // };
        //3rd modal code end
        // $scope.selected = {
        //     item: $scope.items[0]
        // };
        // $scope.ok = function() {
        //     $scope.message = "ok";
        //     //$uibModalInstance.close($scope.selected.item);
        // };
        // $scope.cancel = function() {
        //     $uibModalInstance.dismiss('cancel');
        // };

    }
])
// Please note that $uibModalInstance represents a modal window (instance) dependency.
// It is not the same as the $uibModal service used above.
app.controller('ModalInstanceCtrl', ["$scope", "$uibModal", "$log", "$uibModalInstance", "items", "editId", function ($scope, $uibModal, $log, $uibModalInstance, items, editId) {
    $scope.editId = editId;
    $scope.items = items;
    $scope.selectedTemplate = function (editId) {
        $uibModalInstance.dismiss('cancel');
        $scope.editId = editId;
        var size = "100";
        var modalInstance = $uibModal.open({
            templateUrl: 'selectTemplate.html',
            controller: 'ModalInstanceCtrl',
            size: size,
            resolve: {
                items: function () {
                    return $scope.items;
                },
                editId: function () {
                    return editId;
                }
            }
        });
        modalInstance.result.then(function (selectedItem) {
            $scope.selected = selectedItem;
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };
    // 3rd modal code
    $scope.tempdetail = function () {
        //alert('kafjkasfklsk');
        $uibModalInstance.dismiss('cancel');
        var size = "200";
        var modalInstance = $uibModal.open({
            templateUrl: 'templatedtail.html',
            //controller: 'ModalInstanceCtrl',
            size: size,
            resolve: {}
        });
        modalInstance.result.then(function () {
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };
    //3rd modal code end
    $scope.selected = {
        item: $scope.items[0]
    };
    $scope.ok = function () {
        $scope.message = "ok";
        //$uibModalInstance.close($scope.selected.item);
    };
    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
}]);
//range slider code here
app.controller('SliderCtrl', ['$scope', '$http', '$filter',
    function ($scope, $http, $filter) {
        $scope.myModel = {};
        $scope.totalPrice =0;
        $scope.myModel.totalScale = 100;
        $scope.myModel.scaleBy = 3;
        $scope.myModel.multiplier =1;
        $scope.myModel.stepTo = 20;
        $scope.myModel.howManyImgQ = 1;
        $scope.myModel.turnAroundMultiplier =1;

        var data = {
            "multipliers": [{
                "id": 1,
                "timeFrame": "3",
                "technicalTimeFrame": "3h",
                "quantity": "20",
                "multiplier": 5.00
            },
                {
                    "id": 2,
                    "timeFrame": "6",
                    "technicalTimeFrame": "6h",
                    "quantity": "50",
                    "multiplier": 3.00
                },
                {
                    "id": 3,
                    "timeFrame": "12",
                    "technicalTimeFrame": "12h",
                    "quantity": "100",
                    "multiplier": 2.00
                },
                {
                    "id": 4,
                    "timeFrame": "24",
                    "technicalTimeFrame": "24h",
                    "quantity": "200",
                    "multiplier": 1.00
                },
                {
                    "id": 5,
                    "timeFrame": "48",
                    "technicalTimeFrame": "48h",
                    "quantity": "1000",
                    "multiplier": 0.85
                },
                {
                    "id": 6,
                    "timeFrame": "96",
                    "technicalTimeFrame": "96h",
                    "quantity": "5000",
                    "multiplier": 0.70
                }]
        }



        var quotation= {
                "services" :[
                    {
                        "id":1,
                        "service":"Clipping path",
                        "price":1.99
                    },
                    {
                        "id":2,
                        "service":"Manipulation",
                        "price":2

                    },
                    {
                        "id":3,
                        "service":"Retouching",
                        "price":1

                    }
                ],
                "unit_price":12,
                "courrency":"usd",
                "courrency_symbole":"$",
                "discount":12,
                "discountActual":0,
                "vatActual":0,
                "discount_type":"%",
                "vat":20,
                "vat_type":"%",
                "volume_discount":[{"20":5},{"50":10}],
                "volume_discount_type":"fixed",
                "coupon_discount":1,
                "coupon_discount_type":"fixed",
                "file_format":"jpg",
                "compression":"hq",
                "compression_label":"High Quality 80%",
                "sizing":[{
                    "type":"r",
                    "margin":20,
                    "margin_type":"fixed",
                    "width":200,
                    "height":200,
                }]

            }
        $scope.quotation=quotation;
        $scope.data = data;
        $scope.sliderOPt = function (myModel) {

            //$scope.multipliers = $filter('filter')(data.multipliers, {quantity: '!'+$scope.myModel.howManyImgQ });
            var filteredMultiplier = [];
            for (var i = 0; i < data.multipliers.length; i++) {
                if (data.multipliers[i].quantity >= $scope.myModel.howManyImgQ) {
                    filteredMultiplier.push(data.multipliers[i]);
                    //filterMultiplier.push();
                    //console.log(i+1);
                }
            }
            var multipliers = $scope.multipliers = filteredMultiplier;
           // multiPlierLabel.getOperation(multipliers);



            var totalScale = $scope.myModel.totalScale;
            var scaleBy = $scope.myModel.scaleBy;
            var multiplier = $scope.myModel.multiplier;
            var stepTo =(100 / (multipliers.length - 1));//$scope.myModel.stepTo ;
            $scope.myModel.stepTo = stepTo;
            $scope.value =(totalScale / scaleBy) * multiplier;
            $scope.options = {
                from: 1,
                to: totalScale,
                step: stepTo,
                dimension: "%",
                className: "clip-slider",
                css: {
                    background: {
                        "background-color": "silver"
                    },
                    before: {
                        "background-color": "#58748B"
                    }, // zone before default value
                    after: {
                        "background-color": "#58748B"
                    } // zone after default value
                }
            };
        }

        $scope.selctedQuantity =100;

        $scope.$watch('myModel.howManyImgQ',function(v){
            $scope.selctedQuantity =v;
            $scope.quotation.services[0].service="test";
           //$scope.calcTotal();
        });

        $scope.$watch('value', function(v){
            /**
             * sTA = slected Turn Around
             * sMPIL = Used Mutiplier Item Length
             * tSI = Turn around Starting Index
             */
           var  sTA,mPIL,sI,tsI;
            sTA = Math.round(v);
            mPIL = $scope.multipliers.length;
            if(sTA == 0){
                tsI=0;
            }else{
                tsI=Math.round(sTA/$scope.myModel.stepTo);
            }

            var index = 100/Math.round(v);
            $scope.myModel.turnAroundMultiplier = $scope.multipliers[tsI].multiplier;
           // $scope.calcTotal();

        });

        $scope.calcTotal = function(){
            var total = 0;

             for (var i = 0; i < $scope.quotation.services.length; i++) {

                total =total + ($scope.quotation.services[i].price * $scope.myModel.howManyImgQ*$scope.myModel.turnAroundMultiplier);

            }
            console.log("total price"+total);

            $scope.quotation.discountActual = (total <= $scope.quotation.discount)? 0 : $scope.quotation.discount ;//20;
            console.log( "total discount"+$scope.quotation.discountActual);
            $scope.quotation.vatActual = (total* $scope.quotation.vat)/100;

            return total;
        }


//$scope.slider();
    }]);
//range slider code end
// app.controller('modal3ctrl', ["$scope", "$uibModal", "$log", "$uibModalInstance", function($scope, $uibModal, $log, $uibModalInstance) {
//     $scope.ok = function() {
//         $scope.message = "ok";
//         //$uibModalInstance.close($scope.selected.item);
//     };
//     $scope.cancel = function() {
//         $uibModalInstance.dismiss('cancel');
//     };
// }]);
