/**
 * Created by user on 6/21/2016.
 */

function WPService($http) {

    var WPService = {
        categories: [],
        posts: [],
        pageTitle: 'Latest Posts:',
        currentPage: 1,
        totalPages: 1,
        currentUser: {},
        selectedTemplate: {},
    };

    //...

    WPService.getCurrentUser = function(a, u, p) {
       return $http({
            method: 'POST',
            url: ajaxUrl,
            dataType: 'json',
            params: {
                action: a,
                user_email: u,
                password: p,
            },
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded',

            }
        }).success(function(data){

           WPService.currentUser = data;
        });

    };


    WPService.signUpUser=function(a, data){

        return $http({
            method: 'POST',
            url: ajaxUrl,
            dataType: 'json',
            data:data,
            params: {
                action: a,
                user_name: data.uname,
                user_email:data.email,
                password: data.password ,
                findus:data.findus,
                terms:data.terms
            },
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded',

            }
        }).success(function(data){
            console.log(data);
            WPService.currentUser = data;
        });
    }


    WPService.forgetPass=function(a, data){
        console.log(data);

        return $http({
            method: 'POST',
            url: ajaxUrl,
            dataType: 'json',
            data:data,
            params: {
                action: a,
                user_email:data.email
            },
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded',

            }
        }).success(function(data){
            console.log(data);
            WPService.currentUser = data;
        });
    }

    WPService.verifyPass=function(a, data){


        return $http({
            method: 'POST',
            url: ajaxUrl,
            dataType: 'json',
            data:data,
            params: {
                action: a,
                user_email:data.email,
                verify_code:data.number
            },
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded',

            }
        }).success(function(data){
            //console.log(data);
            WPService.currentUser = data;
        });
    }

    WPService.changePassword=function(a, data){
        return $http({
            method: 'POST',
            url: ajaxUrl,
            dataType: 'json',
            data:data,
            params: {
                action: a,
                user_email:data.email,
                verify_code:data.code,
                password:data.password,
                request_from:data.request_from,
            },
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded',

            }
        }).success(function(data){
            console.log(data);
            WPService.currentUser = data;
        });
    }


    WPService.editPersonalInfo=function(a, data){

        return $http({
            method: 'POST',
            url: ajaxUrl,
            dataType: 'json',
            params: {
                action: a,
                email:data.email,
                more_emails:data.more_emails,
                user_name:data.name,
                user_email:data.user_email,
                user_id:data.user_id,
                user_phone:data.phone,
                type:data.type,
            },
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded',

            }
        }).success(function(data){
            //console.log(data);
            WPService.currentUser = data;
        });
    }

    WPService.editCompanyInfo=function(a, data){

        return $http({
            method: 'POST',
            url: ajaxUrl,
            dataType: 'json',
            params: {
                action: a,

                user_email:data.user_email,
                user_id:data.user_id,
                user_name:data.name,
                type:data.type,
                companyname:data.companyname,
                website:data.website,
                workphone:data.workphone,
                vat_num:data.vat_num

            },
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded',

            }
        }).success(function(data){
           // console.log(data);
            WPService.currentUser = data;
        });
    }

    WPService.editBillingInfo=function(a, data){

        return $http({
            method: 'POST',
            url: ajaxUrl,
            dataType: 'json',
            params: {
                action: a,

                user_email:data.user_email,
                user_id:data.user_id,
                user_name:data.name,
                type:data.type,
                address1:data.address1,
                address2:data.address2,
                city:data.city,
                county:data.county,
                postcode:data.postcode,
                country:data.country,

            },
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded',

            }
        }).success(function(data){
            // console.log(data);
            WPService.currentUser = data;
        });
    }

    WPService.changePass=function(a, data){
        return $http({
            method: 'POST',
            url: ajaxUrl,
            dataType: 'json',
            data:data,
            params: {
                action: a,

                user_email:data.user_email,
                user_id:data.user_id,
                type:data.type,
                password:data.password,
                ftpStatus:data.ftpStatus,
                ftpSamePassword:data.ftpSamePassword,
                passforftp:Number(data.ftpStatus) == 1 ? data.password : data.passForFtp
            },
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded',

            }
        }).success(function(data){
            console.log(data);
            WPService.currentUser = data;
        });
    }

    WPService.enableFTP=function(a, data){
        return $http({
            method: 'POST',
            url: ajaxUrl,
            dataType: 'json',
            data:data,
            params: {
                action: a,
                user_email:data.user_email,
                user_id:data.user_id,
                type:data.type,
                passforftp:data.passForFtp
            },
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded',

            }
        }).success(function(data){
            console.log(data);
            WPService.currentUser = data;
        });
    }

    WPService.changeFTPPass=function(a, data){
        return $http({
            method: 'POST',
            url: ajaxUrl,
            dataType: 'json',
            data:data,
            params: {
                action: a,
                user_email:data.user_email,
                user_id:data.user_id,
                type:data.type,
                passforftp:data.passForFtp
            },
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded',

            }
        }).success(function(data){
            console.log(data);
            WPService.currentUser = data;
        });
    }



    WPService.getClientData = function(a,d) {
        return $http({
            method: 'POST',
            url: ajaxUrl,
            dataType: 'json',
            params: {
                action: a,
                user_email: d.email,
            },
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded',

            }
        }).success(function(data){

            WPService.currentUser = data;
        });

    };





    WPService.post = function(a,d) {
        return $http({
            method: 'POST',
            url: ajaxUrl,
            dataType: 'json',
            data:{operation:d},
            params: {
                action: a

            },
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded',

            }
        }).success(function(data){
            console.log(data);
            // WPService.currentUser = data;
        });

    };



    return WPService;
}

app.factory('ajaxData', ['$http', WPService]);

app.factory("sharedScope", function($rootScope) {
    var rootScope = $rootScope.$new(true);
    rootScope.scope =  {};
    return rootScope;
});