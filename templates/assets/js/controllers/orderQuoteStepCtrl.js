'use strict';

/**

 * controller for Wizard Form example

 */

app.controller('orderQuoteStepCtrl', ['sharedScope', '$scope', '$document', '$uibModal', '$log', 'ngNotify', 'ajaxData', 'resizeTo', 'authFact',
    function(sharedScope, $scope, $document, $uibModal, $log, ngNotify, ajaxData, resizeTo, authFact) {

        $scope.currentStep = 1;
        $scope.loading = false;
        $scope.sharedData = sharedScope.scope;
        $scope.sharedData.template = {};

        $scope.sharedData.fixMarginValue = function(){
            $scope.sharedData.template.sizing_margin = $scope.sharedData.template.sizing_margin_opt == true ? $scope.sharedData.template.sizing_margin : null;
            $scope.sharedData.template.sizing_margin2 = $scope.sharedData.template.sizing_margin_opt2 == true ? $scope.sharedData.template.sizing_margin2 : null;
        }

        $scope.setMargin = function(opt){
            if(opt === 'o')
                $scope.sharedData.template.sizing_margin2 = $scope.sharedData.template.sizing_margin_opt2 == true ? $scope.sharedData.template.sizing_margin2 : null;
            else
                $scope.sharedData.template.sizing_margin = $scope.sharedData.template.sizing_margin_opt == true ? $scope.sharedData.template.sizing_margin : null;
        }

        $scope.resetResizeOptions = function(){
            if(!sharedScope.scope.template) sharedScope.scope.template = {};
            console.log(sharedScope.scope.template.sizing);
            sharedScope.scope.template.width = null;
            sharedScope.scope.template.height = null;
            sharedScope.scope.template.sizing_margin_opt = null;
            sharedScope.scope.template.sizing_margin = null;
            sharedScope.scope.template.sizing_margin_unit = 'px';
            sharedScope.scope.template.sizing_margin_opt2 = null;
            sharedScope.scope.template.sizing_margin2 = null;
            sharedScope.scope.template.sizing_margin2_unit = 'px';
        }

        sharedScope.scope.fileFormatOutput = $scope.fileFormatOutput = [
            {
                'id' : 0,
                'type' : 'JPEG',
                'options' : [
                    { id: 1, label: 'Leave original background' },
                    { id: 2, label: 'Turn to white background' }
                ]
            },
            {
                'id' : 1,
                'type' : 'PNG',
                'options' : [
                    { id: 3, label: 'Turn to transparent background' },
                    { id: 4, label: 'Turn to white background' }
                ]
            },
            {
                'id' : 2,
                'type' : 'PSD',
                'options' : [
                    { id: 5, label: 'White background single layer' },
                    { id: 6, label: 'White background Multiple layer' },
                    { id: 7, label: 'Transparent background Single layer' },
                    { id: 8, label: 'Transparent background Multiple layer' },
                    { id: 9, label: 'Leave original background Single layer' },
                    { id: 0, label: 'Layer mask Single layer' },
                    { id: 11, label: 'Layer mask Multiple layer' }
                ]
            },
            {
                'id' : 3,
                'type' : 'TIFF',
                'options' : [
                    { id: 12, label: 'White background Single layer' },
                    { id: 13, label: 'White background Multiple layer' },
                    { id: 14, label: 'Transparent background Single layer' },
                    { id: 15, label: 'Transparent background Multiple layer' },
                    { id: 16, label: 'Leave original background Single layer' },
                    { id: 17, label: 'Layer mask Single layer' },
                    { id: 18, label: 'Layer mask Multiple layer' }
                ]
            },
            {
                'id' : 4,
                'type' : 'EPS',
                'options' : [ {'no-option' : true} ]
            },
            {
                'id' : 5,
                'type' : 'AI (Illustrator)',
                'options' : [ {'no-option' : true} ]
            },
            {
                'id' : 6,
                'type' : 'EPS (Illustrator)',
                'options' : [ {'no-option' : true} ]
            },
            {
                'id' : 7,
                'type' : 'PDF',
                'options' : [ {'no-option' : true} ]
            },
        ]

        sharedScope.scope.template.showFileOutputOptions = true;
        $scope.getFileOutputOptions = function(fileFormat){
            // sharedScope.scope.template.format_option = $scope.fileFormatOutput[fileFormat.id - 1].options[0];
            $scope.sharedData.template.showFileOutputOptions = !Boolean($scope.fileFormatOutput[fileFormat.id].options[0]['no-option']);
            $scope.sharedData.template.format_option = '';
        }

        /*$scope.$watch('myModel.ReturnFileFormat', function (newVal) {
            var pattJpg = new RegExp("JPG");
            var pattPng = new RegExp("PNG");
            var pattPsd = new RegExp("PSD");
            var pattTiff = new RegExp("TIFF");
            var pattEpsPs = new RegExp("EPS-PS");
            var pattEpsAi = new RegExp("EPS-AI");
            var pattAi = new RegExp("AI");
            var pattPdf = new RegExp("PDF");
            

            if (pattJpg.test(newVal)) {
                $scope.compressions = {
                    'jpg1': 'Leave original background',
                    'jpg2': 'Turn to white background',
                };
                 $scope.myModel.fileFormatOptions = "jpg1";
                $scope.myModel.fileFormatOptionsDisabled = false;

            }else if (pattPng.test(newVal)) {
                $scope.compressions = {
                    'png1': 'Turn to transparent background',
                    'png2': 'Turn to white background',
                };
                $scope.myModel.fileFormatOptions = "png1";
                $scope.myModel.fileFormatOptionsDisabled = false;

                
            }else if (pattPsd.test(newVal)) {
                $scope.compressions = {
                    'psd1': ' White background single layer',
                    'psd2': 'White background Multiple layer',
                    'psd3': 'Transparent background Single layer',
                    'psd4': 'Transparent background Multiple layer',
                    'psd5': 'Leave original background Single layer',
                    'psd6': 'Layer mask Single layer',
                    'psd7': 'Layer mask Multiple layer'
                };
                $scope.myModel.fileFormatOptions = "psd1";
                $scope.myModel.fileFormatOptionsDisabled = false;

                
            }else if (pattTiff.test(newVal)) {
                $scope.compressions = {
                    'tiff1': 'White background Single layer',
                    'tiff2': 'White background Multiple layer',
                    'tiff3': 'Transparent background Single layer',
                    'tiff4': 'Transparent background Multiple layer',
                    'tiff5': 'Leave original background Single layer',
                    'tiff6': 'Layer mask Single layer',
                    'tiff7': 'Layer mask Multiple layer'

                };
                $scope.myModel.fileFormatOptions = "tiff1";
                $scope.myModel.fileFormatOptionsDisabled = false;

                
            }else if (pattEpsPs.test(newVal)) {
                $scope.compressions = {
                    'nc': 'no option',
                };
                $scope.myModel.fileFormatOptionsDisabled = true;

                
            }else if (pattEpsAi.test(newVal)) {
                $scope.compressions = {
                    'nc': 'no options',
                };
                $scope.myModel.fileFormatOptionsDisabled = true;

                
            }else if (pattAi.test(newVal)) {
                $scope.compressions = {
                    'nc': 'no options',
                };
                $scope.myModel.fileFormatOptionsDisabled = true;

                
            }else if (pattPdf.test(newVal)) {
                $scope.compressions = {
                    'nc': 'no options',
                  
                };
                $scope.myModel.fileFormatOptionsDisabled = true;

                
            }else{
                $scope.compressions = {'nc':'No options'};
                $scope.myModel.fileFormatOptions = "nc";
                $scope.myModel.fileFormatOptionsDisabled = true;
            }
        });*/




        // resizeTo.getOperation();

        $scope.test = function(obj, value) {

            console.log(obj);

        }

        $scope.captchaRefresh = function() {
            resizeTo.getOperation();
            $scope.captchaResult = "";
        }

        // Initial Value

        $scope.form = {

            next: function(form) {

                $scope.toTheTop();

                if (form.$valid) {

                    form.$setPristine();

                    nextStep();
                    console.log('Form step 2');

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

            prev: function(form) {

                $scope.toTheTop();

                prevStep();

            },

            goTo: function(form, i) {


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

            submit: function() {

            },

            reset: function() {

            }

        };

        var nextStep = function() {

            $scope.currentStep++;

        };

        var prevStep = function() {

            $scope.currentStep--;

        };

        var goToStep = function(i) {

            $scope.currentStep = i;

        };

        var errorMessage = function(i) {

            ngNotify.set('please complete the form in this step before proceeding', {

                theme: 'pure',

                position: 'top',

                type: 'error',

                button: 'true',

                sticky: 'false',

            });

        };

        $scope.oddevenclass = ['odd', 'even'];
        // $scope.templateId = '';
        // $scope.items = ['temp1', 'temp2', 'temp3', 'temp4'];
        // $scope.timesused = ['22', '11', '3', '2'];
        // var userTemplates = authFact.getAccessToken('userTemplates');
        // $scope.templates = typeof(userTemplates) === 'string' ? JSON.parse(userTemplates) : userTemplates;


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



        $scope.open = function(size) {

            var modalInstance = $uibModal.open({
                templateUrl: 'myModalContent.html',
                controller: 'ModalInstanceCtrl',
                size: size,
                resolve: {
                    items: function() {
                        // return $scope.items;
                        return $scope.templates;
                    },
                    editId: function() {
                        return $scope.editId
                    }

                }
            });

            modalInstance.result.then(function(selectedItem) {
                $scope.selected = selectedItem;
            }, function() {
                $log.info('Modal dismissed at: ' + new Date());
            });
        };

        $scope.getUserTemplates = function(size){

            if(typeof($scope.templates) === 'undefined' || $scope.templates.length === 0){
                $scope.loading = true;

                var tempReq = {};
                tempReq.type = 'quotation_getTemplateList';
                tempReq.userid = -1;

                ajaxData.post('post_data', tempReq).then(function(response){
                    $scope.templates = response.data.data.templateList;
                    // console.log($scope.templates);
                    $scope.open();
                    $scope.loading = false;
                });
            }
            else
                $scope.open();
        }

        sharedScope.scope.getTemplateList = $scope.open;


    }
])




// Please note that $uibModalInstance represents a modal window (instance) dependency.
// It is not the same as the $uibModal service used above.
app.controller('ModalInstanceCtrl', ["sharedScope", "$state","$scope", "$uibModal", "ajaxData", "$log", "$uibModalInstance", "items", "editId", function(sharedScope, $state, $scope, $uibModal, ajaxData, $log, $uibModalInstance, items, editId) {

    $scope.editId = editId;
    $scope.items = items;
    $scope.loading = false;
    
    $scope.getTemplateList = function(){

        $uibModalInstance.dismiss('cancel');
        sharedScope.scope.getTemplateList();

    }

    $scope.renameTemplate = function(tempID){
        var tempReq = {};
        tempReq.type = 'quotation_renameTemplate';
        tempReq.id = tempID;
        ajaxData.post('post_data', tempReq).then(function(response){            
            console.log(response.data.data);
        });
    }

    $scope.deleteTemplate = function(tempID){
        var tempReq = {};
        tempReq.type = 'quotation_removeTemplate';
        tempReq.id = tempID;
        ajaxData.post('post_data', tempReq).then(function(response){            
            console.log(response.data.data);
        });
    }

    var returnFormats = ['', 'JPG', 'PNG', 'TIFF', 'PSD'];
    var webCompressions = ['', 'No compression (0%)', 'Lesser compression (90%)', 'Less compression (80%)', 'High compression (70%)', 'Higher compression (60%)'];
    $scope.fixTemplateDetails = function(){
        sharedScope.scope.templateDetails.formatName = returnFormats[Number(sharedScope.scope.templateDetails.format)];
        sharedScope.scope.templateDetails.compressionName = webCompressions[Number(sharedScope.scope.templateDetails.format)];
        sharedScope.scope.templateDetails.sizingOption = sharedScope.scope.templateDetails.sizing == 'r' ? 'Resize to: ' + (sharedScope.scope.templateDetails.width !== 0 ? sharedScope.scope.templateDetails.width + 'px' : 'Width') + ' X ' + (sharedScope.scope.templateDetails.height !== 0 ? sharedScope.scope.templateDetails.height + 'px' : 'Height') : 'Original size';
    }

    $scope.selectedTemplate = function(editId) {

        $uibModalInstance.dismiss('cancel');
        $scope.editId = editId;
        var size = "100";
        var modalInstance = $uibModal.open({
            templateUrl: 'selectTemplate.html',
            controller: 'ModalInstanceCtrl',
            size: size,
            resolve: {
                items: function() {
                    return $scope.items;
                },
                editId: function() {
                    return editId;
                }
            }
        });

        modalInstance.result.then(function(selectedItem) {
            $scope.selected = selectedItem;
        }, function() {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };




    // 3rd modal code

    $scope.getTemplateDetails = function(editId) {
        var tempReq = {};
        tempReq.type = 'quotation_getTemplate';
        tempReq.id = editId;
        ajaxData.post('post_data', tempReq).then(function(response){            
            sharedScope.scope.templateDetails = response.data.data.template;
            $scope.fixTemplateDetails();
            $scope.tempdetail(editId);
        });
    }

    $scope.tempdetail = function(editId) {
        $uibModalInstance.dismiss('cancel');
        // $scope.editId = editId;
        var size = "200";

        var modalInstance = $uibModal.open({
            templateUrl: 'templatedtail.html',
            controller: 'ModalInstanceCtrl2',
            size: size,
            resolve: {
                items: function() {
                    return $scope.items;
                },
                editId: function() {
                    return editId;
                }
            }
        });

        modalInstance.opened.then(function() {
            // console.log('Template details modal');
        }, function() {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };


    $scope.goNewQuote = function(){
        $uibModalInstance.dismiss('cancel');
        $state.go('app.customer-quote');
    }

    //3rd modal code end





    $scope.selected = {
        item: $scope.items[0]
        // item: 1
    };

    $scope.ok = function() {
        // $scope.message = "ok";
        if(typeof($scope.tempComplex) !== 'undefined'){

            if($scope.tempComplex == 0){
                $scope.loading = true;
                var tempReq = {};
                tempReq.type = 'quotation_getTemplate';
                tempReq.id = $scope.editId;

                ajaxData.post('post_data', tempReq).then(function(response){
                    sharedScope.scope.template = response.data.data.template;
                    sharedScope.scope.template.showFileOutputOptions = !Boolean(response.data.data.template.format.options['no-option']);
                    sharedScope.scope.fixMarginValue();

                    /*** select in drop down menu based on data ***/
                    var file_format = response.data.data.template.format;
                    var file_format_num = 0;
                    angular.forEach(sharedScope.scope.fileFormatOutput, function(format, index){
                        if(format.type == file_format.type)
                            file_format_num = index;
                    });
                    angular.forEach(sharedScope.scope.fileFormatOutput[file_format_num].options, function(format_opt, index){
                        if(format_opt['id'] == response.data.data.template.format_option)
                            sharedScope.scope.template.format_option = format_opt;
                    });
                    sharedScope.scope.template.format = sharedScope.scope.fileFormatOutput[file_format_num];
                    /*** select end ***/

                    // console.log(response.data.data.template);
                    $uibModalInstance.close($scope.selected.item);
                    $scope.loading = false;
                    console.log(sharedScope.scope.template);
                });
            }
        }
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };

}]);

app.controller('ModalInstanceCtrl2', ["sharedScope", "$state","$scope", "$uibModal", "ajaxData", "$log", "$uibModalInstance", "items", "editId", function(sharedScope, $state, $scope, $uibModal, ajaxData, $log, $uibModalInstance, items, editId) {

    $scope.templateDetails = sharedScope.scope.templateDetails;

    $scope.getTemplateList = function(){

        $uibModalInstance.dismiss('cancel');
        sharedScope.scope.getTemplateList();

    }
}]);


