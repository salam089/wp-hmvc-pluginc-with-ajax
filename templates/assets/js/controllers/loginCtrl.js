'use strict';
/**
 * controllers used for the dashboard
 */

app.controller('loginCtrl', ["$scope","$location", "ajaxData","$rootScope","authFact",
    function($scope, $location,  ajaxData, $rootScope, authFact) {
        $scope.master = $scope.myModel;
        $scope.loginUser=function(){

            ajaxData.getCurrentUser("get_user", user , password ).then(function(data){
                $scope.data = data;
                //console.log(data);
            })
            }



    }]);



app.controller('loginValidationCtrl', ["$scope","$location", "$state", "$timeout", "SweetAlert", "ajaxData","authFact" , function ($scope, $location, $state, $timeout, SweetAlert, ajaxData, authFact) {

    $scope.master = $scope.myModel;
    $scope.form = {

        submit: function (form) {
            var firstError = null;
            $scope.loginSuccess = $scope.loginError = false;
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

               ajaxData.getCurrentUser("user_login", $scope.myModel.clientEmail , $scope.myModel.clientPassword ).then(function(data){
                    var ajaxData = data.data;
                    console.log(ajaxData);
                    // if login true set cookies and redirect dash board
                    if(ajaxData.type){

                        var accessToken = data.accessToken;
                        authFact.setAccessToken();
                        $scope.successMsg = ajaxData.message;
                        $scope.loginSuccess = true;
                        authFact.setAccessToken('user-obj','test_token');
                        authFact.setAccessToken('cookies',ajaxData.cookies);
                        authFact.setAccessToken('userData',ajaxData.userData,'obj');
                        $state.go('app.dashboard');
                    }else{

                        $scope.errorMsg = ajaxData.message;
                        $scope.loginError = true;
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


app.controller('signUpValidationCtrl', ["$scope", "$state", "$timeout", "SweetAlert","ajaxData","authFact" , function ($scope, $state, $timeout, SweetAlert,ajaxData, authFact) {

    $scope.master = $scope.myModel;


    $scope.form = {

        submit: function (form) {
            var firstError = null;
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
               //SweetAlert.swal("Good jobn!", "Your form is ready to be submitted!", "success");
                //your code for submit
                ajaxData.signUpUser("oeluser_signup",$scope.myModel ).then(function(data){
                    var ajaxData = data.data;
                     // console.log(ajaxData);
                    if(ajaxData.type){
                        var accessToken = data.accessToken;
                        authFact.setAccessToken();
                        $scope.successMsg = ajaxData.message;
                        $scope.loginSuccess = true;
                        authFact.setAccessToken('user-obj','test_token');
                        authFact.setAccessToken('userData',ajaxData.userData.data,'obj');
                        $state.go('app.dashboard');
                    }else{
                       //console.log('error');
                        $scope.errorMsg = ajaxData.message;
                        $scope.signUpError = true;
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

app.controller('logOutCtrl', ["$scope","$location", "$state", "$timeout", "SweetAlert", "ajaxData","authFact" , function ($scope, $location, $state, $timeout, SweetAlert, ajaxData, authFact) {

    $scope.master = $scope.myModel;

    $scope.logout = function () {
       // localStorage.clearAll();
        var userData = authFact.getAccessToken('userData');
        var cureentUser =JSON.parse(userData);


        ajaxData.getCurrentUser("user_logout",cureentUser.email, 'password' ).then(function(data){
            var ajaxData = data.data;

            if(ajaxData.type){
                $state.go('signin');
            }else{
                console.log('error');
            }
        })

        $state.go('signin');
    };

}]);


app.controller('forGotCtrl', ["$scope","$location", "$state", "$timeout", "SweetAlert", "ajaxData","authFact", "captcha" , function ($scope, $location, $state, $timeout, SweetAlert, ajaxData, authFact, captcha) {
    //mientras corra nuestro modulo lanzamos la funcion getOperation
    captcha.getOperation();
    $scope.master = $scope.myModel;
    $scope.siteUrl=siteUrl;

    var vm = this;

    $scope.captchaRefresh = function () {
        captcha.getOperation();
        $scope.captchaResult ="";
    }
    $scope.form = {
        submit: function (form) {
            //si pasa la validacion correctamente
            if(captcha.checkResult($scope.captchaResult) == true)
            {
                $scope.successMsgCaptcha = "";
                $scope.forgetCaptchaSuccess = false;
                $scope.forgetCaptchaError = false;

                ajaxData.forgetPass("oeluser_forgetpass",$scope.myModel ).then(function(data){
                    var ajaxData = data.data;
                    if(!ajaxData.type){
                        $scope.successMsgCaptcha = ajaxData.message;
                        $scope.forgetCaptchaSuccess = true;
                        $scope.forgetCaptchaError = false;
                        $state.go('login.verifypass');
                    }else{
                        console.log('error');
                        $scope.errorMsgCaptcha = ajaxData.message;
                        $scope.forgetCaptchaError = true;
                        $scope.forgetCaptchaSuccess = false;
                    }
                })

            }
            //si falla la validacion
            else
            {
                $scope.errorMsgCaptcha = "Inavlid captcha result";
                $scope.forgetCaptchaError = true;
                captcha.getOperation();
                $scope.captchaResult ="";
            }
        }

    };


    //console.log("forget");

    

}]);

app.controller('verifyCtrl', ["$rootScope","$scope","$location", "$state", "$timeout", "SweetAlert", "ajaxData","authFact" , function ($rootScope,$scope, $location, $state, $timeout, SweetAlert, ajaxData, authFact) {
    //mientras corra nuestro modulo lanzamos la funcion getOperation
    $scope.master = $scope.myModel;
    $scope.siteUrl=siteUrl;
    $scope.form = {

        submit:function(form){
            var firstError = null;
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
                ajaxData.verifyPass("oeluser_verifyreq",$scope.myModel ).then(function(data){
                    var ajaxData = data.data;
                    if(ajaxData.type){
                       // console.log(ajaxData.verifiedToken);
                        $scope.successMsgVerify= ajaxData.message;
                        $scope.forgetVerifySuccess = true;
                        $scope.forgetVerifyError = false;
                        authFact.setAccessToken('verifiedData',ajaxData.verifiedToken,'obj');
                        $state.go('login.changepass');
                    }else{
                        //console.log('error');
                        $scope.errorMsgVerify = ajaxData.message;
                        $scope.forgetVerifyError = true;
                        $scope.forgetVerifySuccess = false;
                    }
                })

                //authFact.setAccessToken('user-obj','test_token');
               // $state.go('login.changepass');

            }

        }

    };


    //console.log("forget");



}]);
app.controller('changePassCtrl', ["$rootScope","$scope","$location", "$state", "$timeout", "SweetAlert", "ajaxData","authFact" , function ($rootScope, $scope, $location, $state, $timeout, SweetAlert, ajaxData, authFact) {
    //mientras corra nuestro modulo lanzamos la funcion getOperation
    $scope.master = $scope.myModel;
    $scope.siteUrl=siteUrl;
   var verifiedData = authFact.getAccessToken('verifiedData');
    //console.log(verifiedData);
    var vData =JSON.parse(verifiedData);
    if( angular.isUndefined(verifiedData)){
        //console.log(verifiedData);
        $scope.errorMsgChangePass = "Somethings is going wrong verify your code again.";
        $scope.forgetChangePassError = true;
        $scope.forgetChangePassSuccess = false;
    }else{
        var verifiedEmail = vData.email;
        var verifiedCode = vData.code;
        var verifiedStatus = vData.status;
        if( verifiedStatus == false){
           // console.log('veriefied status false');
            $scope.errorMsgChangePass = "Somethings is going wrong verify your code again.ghjg";
            $scope.forgetChangePassError = true;
            $scope.forgetChangePassSuccess = false;
        }else{
            //console.log('fgfg');
            $scope.form = {
                submit:function(form){
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
                        $scope.myModel.request_from = 'change_pass';
                        ajaxData.changePassword("oeluser_change_pass",$scope.myModel ).then(function(data){
                            console.log(data);
                            var ajaxData = data.data;
                            if(ajaxData.type){
                                // console.log(ajaxData.verifiedToken);
                                $scope.successMsgChangePass= ajaxData.message;
                                $scope.forgetChangePassError = false;
                                $scope.forgetVerifyError = false;
                                authFact.setAccessToken('verifiedData',NULL);
                                $state.go('login.changepass');
                            }else{
                                //console.log('error');
                                $scope.errorMsgChangePass = ajaxData.message;
                                $scope.forgetChangePassError = true;
                                $scope.forgetChangePassSuccess = false;
                            }
                        });

                    }
                }

            };

        }

    }



    //console.log("forget");



}]);














