'use strict';
/**
 * controllers for ng-table
 * Simple table with sorting and filtering on AngularJS
 */




app.controller('QuotationListCtrl', ["$scope", "$filter", "ngTableParams", "ajaxData",  function ($scope, $filter, ngTableParams, ajaxData) {

	/*var quotationStatusNew = 1;
	var quotationStatusReady= 2;
	var quotationStatusComplete = 3;
	var data = [{
		id: 1,
		date: "20 May 2016",
		quotationno : "CPI-Q-12345",
		services:"Clipping path ,drop shadow",
		amount:"$20.25",
		status: quotationStatusNew,
	},{
		id: 2,
		date: "20 May 2016",
		quotationno : "CPI-Q-12345",
		services:"Clipping path ,drop shadow",
		amount:"$20.25",
		status: quotationStatusReady,
	},{
		id: 3,
		date: "20 May 2016",
		quotationno : "CPI-Q-12345",
		services:"Clipping path ,drop shadow",
		amount:"$20.25",
		status : quotationStatusComplete,
	},{
		id: 2,
		date: "20 May 2016",
		quotationno : "CPI-Q-12345",
		services:"Clipping path ,drop shadow",
		amount:"$20.25",
		status: quotationStatusReady,
	},{
		id: 2,
		date: "20 May 2016",
		quotationno : "CPI-Q-12345",
		services:"Clipping path ,drop shadow",
		amount:"$20.25",
		status: quotationStatusReady,
	},

	];

	// $scope.data = {};

	var status = [
		{title:"new",  },
		{title:"Ready" },
		{title:"Completed" }
	]*/

	$scope.activeFButtonAll=true;
	$scope.activeFButton1= $scope.activeFButton2 = $scope.activeFButton3 = false;

	$scope.cols = [
				{ field: "status", title: "Status", filter: { status: "select" }, filterData: status, show: true }
	];

	$scope.status = {
		'New' : 1,
		'Ready' : 2,
		'Completed' : 3
	}

	var data = [];
    var tempReq = {};
    tempReq.type = 'quotation_getAllQuotations';
    ajaxData.post('post_data', tempReq).then(function(response){            
        data = response.data.data.data;

		$scope.tableParams = new ngTableParams({
			page: 1, // show first page
			count: 10 // count per page
		},{
			total: data.length, // length of data
			getData: function ($defer, params) {
				$defer.resolve(data.slice((params.page() - 1) * params.count(), params.page() * params.count()));
			}
		});
    });


	$scope.filterBY= function(type){
		if(type>=1){
			if(type==1){
				$scope.activeFButton1=true;
				$scope.activeFButton2= $scope.activeFButton3 = $scope.activeFButtonAll = false;
			}
			// else if(type==2){
			// 	$scope.activeFButton2=true;
			// 	$scope.activeFButton1= $scope.activeFButton3 = $scope.activeFButtonAll = false;
			// }
			else if(type==3){
				$scope.activeFButton3=true;
				$scope.activeFButton1= $scope.activeFButton2 = $scope.activeFButtonAll = false;
			}

			$scope.tableParams = new ngTableParams({
				page: 1, // show first page
				count: 10, // count per page
				filter: { status_num: String(type) }
			},{
				total: data.length, // length of data
				getData: function ($defer, params) {
					//$defer.resolve(data.slice((params.page() - 1) * params.count(), params.page() * params.count()));

					var orData = params.filter() ? $filter('filter')(data, params.filter()) : data;
					$scope.orderdata = orData.slice((params.page() - 1) * params.count(), params.page() * params.count());
					params.total(orData.length);
					// set total for recalc pagination
					$defer.resolve($scope.orderdata);

				}
			});

		}else{
			$scope.activeFButtonAll=true;
			$scope.activeFButton1= $scope.activeFButton2 = $scope.activeFButton3 = false;

			$scope.tableParams = new ngTableParams({
				page: 1, // show first page
				count: 10 // count per page
			},{
				total: data.length, // length of data
				getData: function ($defer, params) {
					$defer.resolve(data.slice((params.page() - 1) * params.count(), params.page() * params.count()));


				}
			});

		}

	}


}]);

//
// app.controller('ngTableCtrl3', ["$scope", "$filter", "ngTableParams", function ($scope, $filter, ngTableParams) {
// 	$scope.tableParams = new ngTableParams({
// 		page: 1, // show first page
// 		count: 5, // count per page
// 		filter: {
// 			name: 'M' // initial filter
// 		}
// 	}, {
// 		total: data.length, // length of data
// 		getData: function ($defer, params) {
// 			// use build-in angular filter
// 			var orderedData = params.filter() ? $filter('filter')(data, params.filter()) : data;
// 			$scope.users = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());
// 			params.total(orderedData.length);
// 			// set total for recalc pagination
// 			$defer.resolve($scope.users);
// 		}
// 	});
// }]);





app.controller('QuotationListCtrl2', ["$scope","$location", "ajaxData","$rootScope","authFact",
	function($scope, $location,  ajaxData, $rootScope, authFact) {
		$scope.qtModel = {};
		$scope.qtModel.type = "quote_request";
		$scope.quotationErrorMsg="";
		$scope.quotationSuccessMsg="";
		$scope.submit =false;

		$scope.keepOrginal=function(){
			$scope.qtModel.resizeMarginType="";
			$scope.qtModel.resize_to_margin=false;
			$scope.qtModel.height="";
			$scope.qtModel.width="";
			$scope.qtModel.resize_to="o";
		}

		$scope.resizeTo = function(){
			$scope.qtModel.original_margin="";
			$scope.qtModel.original_margin_type='';
		}


		$scope.master = $scope.qtModel;
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
					ajaxData.post("post_request", $scope.qtModel ).then(function(data){
						var ajaxData = data.data;
						// if login true set cookies and redirect dash board
						if(ajaxData.type){

							$scope.quotationSuccessMsg = ajaxData.message;
							$scope.quotationSuccess = true;
							$scope.quotationError = false;
							//$state.go('app.thankyou');
						}else{

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
