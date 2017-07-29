'use strict';
/** 
  * controller for User Profile Example
*/



app.controller('userSettingCtrl', ["$rootScope","$scope","$location", "$state", "$timeout", "SweetAlert", "ajaxData","authFact" , function ( $rootScope, $scope, $location, $state, $timeout, SweetAlert, ajaxData, authFact) {

    $scope.myModel = {};
    $scope.master = $scope.myModel;
  


    var userData = authFact.getAccessToken('userData');
    var cureentUser =JSON.parse(userData);
    console.log(cureentUser);

    $scope.myModel = {
        ID:cureentUser.ID,
        name: cureentUser.contact_name,
        website: cureentUser.website_url,
        email: cureentUser.email,
        emailCC: cureentUser.email_cc ? [] : cureentUser.email_cc.split(","),
        phone: cureentUser.telephone,
        workphone: cureentUser.work_telephone,
        companyname: cureentUser.company_name,
        vat_num: cureentUser.vat_number,
        address1: cureentUser.address_1,
        address2:cureentUser.address_2,
        postcode: cureentUser.postcode,
        city: cureentUser.town,
        county: cureentUser.state,
        country: cureentUser.country,
        passForFtp:cureentUser.pass_for_ftp,
        passForFtpMasked:cureentUser.pass_for_ftp_masked,
        ftpStatus:cureentUser.ftp_status,
        ftpSamePassword:cureentUser.ftp_same_pass
    };


    console.log($scope.myModel);

    // add another email portion
    $scope.emails = [];
    if($scope.myModel.emailCC.length >= 1 && $scope.myModel.emailCC[0].length > 0)
        angular.forEach($scope.myModel.emailCC, function(extra_email, k){
            $scope.emails.push({'email':extra_email});
        });

    $scope.addNewEmail = function() {
        $scope.emails.push({'email':''});
    };

    $scope.removeEmail = function(index) {
        $scope.emails.splice(index, 1);
    };
    // add another email portion end



    if( angular.isUndefined(userData)){
        //console.log(verifiedData);
        $scope.errorMsgSeetings = "Somethings is going wrong try again.";
        $scope.settingsError = true;
        $scope.settingsSuccess = false;
    }else {
        var userEmail = cureentUser.user_email;
        var userID = cureentUser.ID;
        if ( userID <= 0) {

            $scope.errorMsgSettings = "Somethings is going with your authentication try again.";
            $scope.settingsError = true;
            $scope.settingsSuccess = false;
        } else {
             $scope.form = {
                submit: function (form) {
                    //console.log(form.$name)
                    var firstError = null;
                    if (form.$invalid) {

                        var field = null, firstError = null, email_form = false;
                        for (field in form) {
                            if (field[0] != '$') {
                                if (firstError === null && !form[field].$valid) {
                                    firstError = form[field].$name;

                                    if(field == 'emailForm')
                                        email_form = true;
                                }

                                if (form[field].$pristine) {
                                    form[field].$dirty = true;
                                }
                            }
                        }

                        if(email_form)
                            angular.element('.ng-invalid[name=' + firstError + '] .ng-invalid[type=email]:first').focus();
                        else
                            angular.element('.ng-invalid[name=' + firstError + ']').focus();
                        // SweetAlert.swal("The form cannot be submitted because it contains validation errors!", "Errors are marked with a red, dashed border!", "error");
                        return;

                    } else {
                        //SweetAlert.swal("Good joob!", "Your form is ready to be submitted!", "success");
                        //your code for submit
                        //console.log($scope.myModel);
                        $scope.myModel.user_id = cureentUser.ID;
                        $scope.myModel.user_email = cureentUser.email;


                        if(form.$name== 'Form') {
                            $scope.myModel.type = "personal_info";

                            $scope.myModel.emailCC = [];
                            angular.forEach($scope.emails, function(extra_email, k){
                                $scope.myModel.emailCC.push(extra_email.email);
                            });
                            $scope.myModel.more_emails = $scope.myModel.emailCC.join(',');

                            ajaxData.editPersonalInfo("oel_user_edit_parsonal", $scope.myModel).then(function (data) {
                                var ajaxData = data.data;

                                // if login true set cookies and redirect dash board
                                if (ajaxData.type) {

                                    $scope.settingsError = false;
                                    $scope.settingsSuccess = true;
                                    $scope.successMsgSettings = ajaxData.message;
                                    authFact.setAccessToken('userData', ajaxData.userData, 'obj');
                                } else {
                                    console.log(ajaxData);
                                    $scope.errorMsgSettings = ajaxData.message;
                                    $scope.settingsError = true;
                                    $scope.settingsSuccess = false;
                                }
                            })
                        }else if(form.$name== 'Form2'){
                            $scope.myModel.type = "company_info";
                            ajaxData.editCompanyInfo("oel_user_edit_parsonal", $scope.myModel).then(function (data) {
                                var ajaxData = data.data;
                                console.log(ajaxData);

                                // if login true set cookies and redirect dash board
                                if (ajaxData.type) {

                                    $scope.companySettingError = false;
                                    $scope.companySettingSuccess = true;
                                    $scope.successMsgcompanySetting = ajaxData.message;
                                    authFact.setAccessToken('userData', ajaxData.userData, 'obj');
                                } else {
                                    console.log(ajaxData);
                                    $scope.errorMsgcompanySetting = ajaxData.message;
                                    $scope.companySettingError = true;
                                    $scope.companySettingSuccess = false;
                                }
                            })



                        }else if(form.$name== 'Form3'){


                            $scope.myModel.type = "billing_info";
                            ajaxData.editBillingInfo("oel_user_edit_parsonal", $scope.myModel).then(function (data) {
                                var ajaxData = data.data;
                                console.log(ajaxData);

                                // if login true set cookies and redirect dash board
                                if (ajaxData.type) {

                                    $scope.companyBillingSettingError = false;
                                    $scope.companyBillingSettingSuccess = true;
                                    $scope.successMsgCompanyBillingSetting = ajaxData.message;
                                    authFact.setAccessToken('userData', ajaxData.userData, 'obj');
                                } else {
                                    console.log(ajaxData);
                                    $scope.errorMsgCompanyBillingSetting = ajaxData.message;
                                    $scope.companyBillingSettingError = true;
                                    $scope.companyBillingSettingSuccess = false;
                                }
                            })

                        }else if(form.$name== 'Form4'){

                            $scope.myModel.type = "change_pass";
                            ajaxData.changePass("oel_user_edit_parsonal", $scope.myModel).then(function (data) {
                                var ajaxData = data.data;


                                // if login true set cookies and redirect dash board
                                if (ajaxData.type) {

                                    $scope.changePassError = false;
                                    $scope.changePassSuccess = true;
                                    $scope.successMsgChangePass = ajaxData.message;
                                    authFact.setAccessToken('userData', ajaxData.userData, 'obj');
                                } else {
                                    console.log(ajaxData);
                                    $scope.errorMsgChangePass = ajaxData.message;
                                    $scope.changePassError = true;
                                    $scope.changePassSuccess = false;
                                }
                            })

                        }else if(form.$name== 'Form6'){

                            $scope.myModel.type = "enable_ftp";
                            $scope.myModel.passForFtpMasked = ($scope.myModel.passForFtp).replace(/./g,'*');

                            ajaxData.enableFTP("oel_user_edit_parsonal", $scope.myModel).then(function (data) {
                                var ajaxData = data.data;


                                // if login true set cookies and redirect dash board
                                if (ajaxData.type) {

                                    $scope.enableFTPError = false;
                                    $scope.enableFTPSuccess = true;
                                    $scope.successMsgEnableFTP = ajaxData.message;
                                    authFact.setAccessToken('userData', ajaxData.userData, 'obj');
                                } else {
                                    console.log(ajaxData);
                                    $scope.errorMsgEnableFTP = ajaxData.message;
                                    $scope.enableFTPError = true;
                                    $scope.enableFTPSuccess = false;
                                }
                            })

                        }else if(form.$name== 'Form7'){

                            $scope.myModel.type = "change_ftp_pass";

                            ajaxData.changeFTPPass("oel_user_edit_parsonal", $scope.myModel).then(function (data) {
                                var ajaxData = data.data;


                                // if login true set cookies and redirect dash board
                                if (ajaxData.type) {

                                    $scope.changePassError2 = false;
                                    $scope.changePassSuccess2 = true;
                                    $scope.successMsgChangePass2 = ajaxData.message;
                                    authFact.setAccessToken('userData', ajaxData.userData, 'obj');
                                } else {
                                    console.log(ajaxData);
                                    $scope.errorMsgChangePass2 = ajaxData.message;
                                    $scope.changePassError2 = true;
                                    $scope.changePassSuccess2 = false;
                                }
                            })

                        }

                    }
                },






        };






        }
    }

}]);

