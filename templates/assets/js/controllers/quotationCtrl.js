'use strict';


app.controller('quotationCtrl', ["$httpProvider", "fileUploadProvider", "$scope", "$location", "ajaxData", "$rootScope", "authFact",
    function ($httpProvider, fileUploadProvider, $scope, $location, ajaxData, $rootScope, authFact) {
        $scope.master = $scope.qtModel;
        $scope.loginUser = function () {

            ajaxData.getCurrentUser("get_user", user, password).then(function (data) {
                $scope.data = data;
            })
        }


    }]);

app.controller('quotationCtrl2', ["$scope", "$location", "ajaxData", "$rootScope", "authFact", "$state","$log",
    function ($scope, $location, ajaxData, $rootScope, authFact, $state,$log) {

        $scope.qtModel = {};
        $scope.qtModel.type = "quote_request";
        $scope.quotationErrorMsg = "";
        $scope.quotationSuccessMsg = "";
        $scope.submit = false;
        $scope.userLoggedin = false;
        $scope.qtModel.quoteImgfolder = userUploadDir;
      //  $scope.qtModel.userFolder = userDir;



        $scope.qtModel.orginalMarginType = "px";
        $scope.qtModel.resizeMarginType = "px";
        $scope.qtModel.ReturnFileFormat = "JPG, leave original background";
        $scope.qtModel.WebCompression = "mq";
        $scope.qtModel.hideLogin = true;

        $scope.keepOrginal = function () {
                $scope.qtModel.resizeMarginType = 'px';
                $scope.qtModel.sizing_margin_opt = false;
                $scope.qtModel.sizing_margin = '';
                $scope.qtModel.height ="";
                $scope.qtModel.width = "";
                $scope.qtModel.resize_to = "o";
        }

        $scope.resizeTo = function () {
            $scope.qtModel.original_margin = '';
            $scope.qtModel.original_margin_type = "px";
        }



        $scope.form = {


            submit: function (form) {
                var firstError = null;
                $scope.quotationError = $scope.quotationError = false;
                if (form.$invalid) {

                    var field = null, firstError = null;
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
                    // SweetAlert.swal("The form cannot be submitted because it contains validation errors!", "Errors are marked with a red, dashed border!", "error");
                    return;

                } else {
                    //SweetAlert.swal("Good joob!", "Your form is ready to be submitted!", "success");
                    //your code for submit
                    ajaxData.post("post_request", $scope.qtModel).then(function (data) {
                        var ajaxData = data.data;
                        // if login true set cookies and redirect dash board
                        if (ajaxData.type) {

                            $scope.quotationSuccessMsg = ajaxData.message;
                            $scope.quotationSuccess = true;
                            $scope.quotationError = false;
                            authFact.setAccessToken('message', 1);
                            $state.go('thankyou');
                        } else {

                            $scope.quotationErrorMsg = ajaxData.message;
                            $scope.quotationError = true;
                            $scope.quotationSuccess = false;
                        }
                    })

                }

            },
            reset: function (form) {

                $scope.myModel = angular.copy($scope.master);
                form.$setPristine(true);

            }
        };

    }]);


app.controller('FreeTrialQuoteQtrl', ['$scope', '$document', 'ngNotify', 'ajaxData', 'resizeTo', 'authFact', '$uibModal', '$log', 'captcha',

    function ($scope, $document, ngNotify, ajaxData, resizeTo, authFact, $uibModal, $log, captcha) {

        $scope.myModel = {};
        $scope.currentStep = 1;
        captcha.getOperation();
        $scope.userLoggedin = false;

        $scope.myModel.orginalMarginType = "px";
        $scope.myModel.resizeMarginType = "px";
        $scope.myModel.ReturnFileFormat = "JPG, leave original background";
        $scope.myModel.WebCompression = "mq";
        $scope.myModel.hideLogin = true;
        $scope.compressions = {'nc':'Web compression', 'mq':'Maximum quality (100%)', 'vh':'Very high quality (80%)','hq':'High quality (60%)'};


        $scope.keepOrginal = function () {
            $scope.myModel.resizeMarginType = 'px';
            $scope.myModel.sizing_margin_opt = false;
            $scope.myModel.sizing_margin = '';
            $scope.myModel.height ="";
            $scope.myModel.width = "";
            $scope.myModel.resize_to = "o";
        }

        $scope.resizeTo = function () {
            $scope.myModel.original_margin = '';
            $scope.myModel.original_margin_type = "px";
        }






        var userData = authFact.getUserData();
        if (userData == undefined) {
            $scope.userLoggedin = false;

        } else {
            $scope.userLoggedin = true;

        }


        $scope.captchaRefresh = function () {
            resizeTo.getOperation();
            $scope.captchaResult = "";
        }

        $scope.master = $scope.myModel;
        $scope.$watch('myModel.ReturnFileFormat', function (newVal) {
            var pattJpg = new RegExp("JPG");
            var pattPng = new RegExp("PNG");
            if (pattJpg.test(newVal)) {
                $scope.compressions = {
                    'nc': 'Web compression',
                    'mq': 'Maximum quality (100%)',
                    'vh': 'Very high quality (80%)',
                    'hq': 'High quality (60%)'
                };
                $scope.myModel.WebCompression = "mq";
                $scope.myModel.WebCompressionDisabled = false;
            }else if (pattPng.test(newVal)) {
                $scope.compressions = {'nc': 'No compression', 'mq': 'Maximum quality (100%)'};
                $scope.myModel.WebCompression = "mq";
                $scope.myModel.WebCompressionDisabled = false;
            }else{
                $scope.compressions = {'nc':'No compression'};
                $scope.myModel.WebCompression = "nc";
                $scope.myModel.WebCompressionDisabled = true;
            }
        });




        // Initial Value
        $scope.myModel.email = $scope.client_email;
        $scope.items = {};
        $scope.myModel.client_check = "not-tested";

        $scope.captchaRefresh = function (form) {
            captcha.getOperation();
            $scope.captchaResult = "";
        }

        $scope.maxVal = function (elem) {
            //console.log(elem);
            elem.$modelValue = "99";
            elem.$$rawModelValue = "99";
            elem.$viewValue = "99";
            //console.log(elem);

        }


        $scope.form = {

            openFogetPass: function (form) {

                $scope.items.email = $scope.myModel.client_email;
                $scope.myModel.email = $scope.items.email;

                var modalInstance = $uibModal.open({
                    templateUrl: 'forgetPassTemplate.html',
                    controller: 'ModalInstanceCtrl',
                    size: 395,
                    class: 'free-trial',
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
                    // $scope.selected = selectedItem;
                    console.log('modal instance then');
                    $scope.captchaRefresh = function () {
                        console.log('modal instance then');
                        resizeTo.getOperation();
                        $scope.captchaResult = "";
                    }
                }, function () {
                    $scope.items = {};
                    $log.info('Modal dd change dismissed at: ' + new Date());
                });

            },

            usercheck: function (form) {

                if ((form.client_email.$valid) && (form.password.$modelValue != "") && (form.password.$modelValue != undefined) && (form.password.$valid )) {
                    console.log(form.client_email.$modelValue + ' == ' + form.password.$modelValue);
                    $scope.myModel.type = "users_check_user";
                    ajaxData.post("post_data", $scope.myModel).then(function (data) {
                        var returnData = data.data;
                        if (!returnData.data.is_user_exists) {
                            $scope.myModel.client_check = "new";
                            form.client_check.$dirty = false;
                            form.client_check.$invalid = false;
                            form.client_check.$valid = true;

                        } else {
                            if (returnData.data.success) {
                                authFact.setAccessToken('user-obj', 'test_token');
                                authFact.setAccessToken('cookies', returnData.data.cookies);
                                authFact.setAccessToken('userData', returnData.data.userData, 'obj');
                                console.log(returnData.data.userData.ID);
                                $scope.myModel.client_check = returnData.data.userData.ID;

                                form.client_check.$dirty = false;
                                form.loggedin = true;
                            } else {

                                $scope.myModel.email = form.client_email.$modelValue;

                                $scope.myModel.client_check = "";
                                form.client_check.$dirty = false;
                                form.client_check.$invalid = true;
                                form.client_check.$valid = false;
                                form.loggedin = false;
                            }

                        }

                    });
                }

            },


            next: function (form) {

                $scope.toTheTop();

                console.log(form.width);


                if (form.$valid) {

                    form.$setPristine();

                    $scope.myModel.type = "quotation_free_trial_add";

                    if ($scope.myModel.client_name != undefined) {
                        ajaxData.post("post_request", $scope.myModel).then(function (data) {
                            var ajaxData = data.data;
                            // if login true set cookies and redirect dash board
                            if (ajaxData.type) {

                                $scope.quotationSuccessMsg = ajaxData.message;
                                $scope.quotationSuccess = true;
                                $scope.quotationError = false;
                                //$state.go('app.thankyou');
                            } else {

                                $scope.quotationErrorMsg = ajaxData.message;
                                $scope.quotationError = true;
                                $scope.quotationSuccess = false;
                            }
                        })
                    }


                    nextStep();


                } else {

                    var field = null, firstError = null;


                    for (field in form) {

                        if (field[0] != '$') {


                            if (firstError === null && !form[field].$valid) {

                                firstError = form[field].$name;

                            }
                            //console.log(form[field]);

                            if (form[field].$pristine) {

                                form[field].$dirty = true;

                            }


                            console.log(firstError);
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

                if (form.$invalid) {

                    var field = null, firstError = null;
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
                    // SweetAlert.swal("The form cannot be submitted because it contains validation errors!", "Errors are marked with a red, dashed border!", "error");
                    return;

                } else {


                }


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

    }]);


// Please note that $uibModalInstance represents a modal window (instance) dependency.
// It is not the same as the $uibModal service used above.
app.controller('ModalInstanceCtrl', ["$state", "$scope", "$uibModal", "$log", "$uibModalInstance", "items", "editId", "captcha", "ajaxData", "authFact", function ($state, $scope, $uibModal, $log, $uibModalInstance, items, editId, captcha, ajaxData, authFact) {

    $scope.myModel = {};
    $scope.editId = editId;
    $scope.items = items;
    $scope.myModel.email = $scope.items.email;

    if ($scope.items.forgetCaptchaSuccess != undefined || $scope.items.forgetCaptchaError != undefined) {
        $scope.errorMsgVerify = $scope.items.message;
        $scope.successMsgCaptcha = $scope.items.successMsgCaptcha;
        $scope.forgetCaptchaSuccess = $scope.items.forgetCaptchaSuccess;
        $scope.forgetCaptchaError = $scope.items.forgetCaptchaError;
    }

    $scope.message = $scope.items.message;

    $scope.captchaRefresh = function (form) {
        captcha.getOperation();
        $scope.captchaResult = "";
    }


    $scope.form = {
        resetPassClick: function (form) {

            if (captcha.checkResult($scope.captchaResult) == true) {
                $scope.successMsgCaptcha = "";
                $scope.forgetCaptchaSuccess = false;
                $scope.forgetCaptchaError = false;

                ajaxData.forgetPass("oeluser_forgetpass", $scope.myModel).then(function (data) {
                    var ajaxData = data.data;
                    if (!ajaxData.type) {
                        $scope.successMsgCaptcha = $scope.items.successMsgCaptcha = ajaxData.message;
                        $scope.forgetCaptchaSuccess = $scope.items.forgetCaptchaSuccess = true;
                        $scope.forgetCaptchaError = $scope.items.forgetCaptchaError = false;

                        $uibModalInstance.dismiss('cancel');
                        $scope.editId = editId;
                        var size = "395";
                        var modalInstance = $uibModal.open({
                            templateUrl: 'varifyCodeTemplate.html',
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
                            console.log('fgfdg');
                            $scope.selected = selectedItem;

                        }, function () {
                            $scope.items = {};
                            $log.info('Modal verify dismissed at: ' + new Date());
                        });

                    } else {
                        $scope.errorMsgCaptcha = ajaxData.message;
                        $scope.forgetCaptchaError = true;
                        $scope.forgetCaptchaSuccess = false;
                    }
                })

            }
            else {
                $scope.errorMsgCaptcha = "Inavlid captcha result";
                $scope.forgetCaptchaError = true;
                captcha.getOperation();
                $scope.captchaResult = "";
            }

        },

        verifyClick: function (form) {
            $scope.forgetCaptchaSuccess = false;
            //
            var size = "395";


            if (form.$invalid) {

                var field = null, firstError = null;
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
                // SweetAlert.swal("The form cannot be submitted because it contains validation errors!", "Errors are marked with a red, dashed border!", "error");
                return;

            } else {


                ajaxData.verifyPass("oeluser_verifyreq", $scope.myModel).then(function (data) {
                    var ajaxData = data.data;
                    if (ajaxData.type) {
                        // console.log(ajaxData.verifiedToken);
                        $scope.successMsgVerify = ajaxData.message;
                        $scope.forgetVerifySuccess = true;
                        $scope.forgetVerifyError = false;
                        authFact.setAccessToken('verifiedData', ajaxData.verifiedToken, 'obj');
                        $uibModalInstance.dismiss('cancel');

                        var modalInstance = $uibModal.open({
                            templateUrl: 'resetPassTemplate.html',
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

                        modalInstance.result.then(function () {
                            $scope.changePass = function (form) {

                                console.log('test');

                            }
                        }, function () {
                            // $scope.items = {};
                            $log.info('Modal change pass dismissed at: ' + new Date());
                        });

                    } else {
                        //console.log('error');
                        $scope.errorMsgVerify = ajaxData.message;
                        $scope.forgetVerifyError = true;
                        $scope.forgetVerifySuccess = false;
                    }
                })

            }

        },
        changePass: function (form) {
            console.log('form form change passtest');
            $scope.master = $scope.myModel;
            $scope.siteUrl = siteUrl;
            var verifiedData = authFact.getAccessToken('verifiedData');
            //console.log(verifiedData);
            var vData = JSON.parse(verifiedData);
            if (angular.isUndefined(verifiedData)) {
                //console.log(verifiedData);
                $scope.errorMsgChangePass = "Somethings is going wrong verify your code again.";
                $scope.forgetChangePassError = true;
                $scope.forgetChangePassSuccess = false;
            } else {
                var verifiedEmail = vData.email;
                var verifiedCode = vData.code;
                var verifiedStatus = vData.status;
                if (verifiedStatus == false) {
                    // console.log('veriefied status false');
                    $scope.errorMsgChangePass = "Somethings is going wrong verify your code again.ghjg";
                    $scope.forgetChangePassError = true;
                    $scope.forgetChangePassSuccess = false;
                } else {
                    //console.log('fgfg');

                    if (form.$invalid) {

                        var field = null, firstError = null;
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
                        // SweetAlert.swal("The form cannot be submitted because it contains validation errors!", "Errors are marked with a red, dashed border!", "error");
                        return;

                    } else {

                        $scope.myModel.email = verifiedEmail;
                        $scope.myModel.code = verifiedCode;
                        $scope.myModel.request_from = 'free_quote';
                        console.log($scope.myModel);
                        ajaxData.changePassword("oeluser_change_pass", $scope.myModel).then(function (data) {
                            var ajaxData = data.data;
                            if (ajaxData.loggedin) {
                                $scope.successMsgChangePass = ajaxData.message;
                                $scope.forgetChangePassError = false;
                                $scope.forgetChangePassSuccess = true;
                                var accessToken = data.accessToken;
                                authFact.setAccessToken();
                                authFact.setAccessToken('user-obj', 'test_token');
                                authFact.setAccessToken('cookies', ajaxData.cookies);
                                authFact.setAccessToken('userData', ajaxData.userData, 'obj');

                                $uibModalInstance.dismiss('cancel');
                            } else {
                                //console.log('error');
                                $scope.errorMsgChangePass = ajaxData.message;
                                $scope.forgetChangePassError = true;
                                $scope.forgetChangePassSuccess = false;
                            }
                        });

                    }

                }

            }

        }


    };


    $scope.ok = function () {
        $scope.message = "ok";
        //$uibModalInstance.close($scope.selected.item);
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

}]);



