angular.module('cbApp', [])
.controller('CCFormController', function($scope, httpService) {
	$scope.newEnquiry = {gender: 'Male', occupation: '', cc: 'No', language: '', salary_by: '', etype: 'Credit Card'};
	$scope.submitForm = function(){
		console.log($scope.newEnquiry, $scope.pageInfo.enquiryform);
		$scope.pageInfo.formSubmitted = true;

		if($scope.pageInfo.enquiryform.$valid && $scope.pageInfo.mobileVerified){
			httpService.post(ajaxurl+'cb_new_enquiry', $scope.newEnquiry).then(function(res){
				if(res.status == 'Success'){
					localStorage.setItem('cbenquiryform-'+mypage, 1);
					$scope.pageInfo.enquirydone = true;
				}
			});
		}
	};

	$scope.send_otp = function(){
		httpService.post(ajaxurl+'cb_verify_otp', {mobile: $scope.newEnquiry.mobile}).then(function(res){
			if(res.status == 'Success'){
				$scope.pageInfo.otp = atob(res.res);
				$scope.pageInfo.mobileVerified = 2;
			} else {
				$scope.pageInfo.mobileVerified = 3;
			}
		});
	};

	$scope.verify_otp = function(){
		if($scope.pageInfo.otp == $scope.pageInfo.verifyotp){
			$scope.pageInfo.mobileVerified = 1;
		} else if($scope.pageInfo.verifyotp.length > 5){
			$scope.pageInfo.mobileVerified = 4;
		}
	};

	$scope.pageInfo = {formSubmitted : false};
	$scope.pageInfo.mobileVerified = 0;
	$scope.pageInfo.otp = false;
	$scope.pageInfo.enquirydone = false;
})
.controller('ReferController', function($scope, httpService) {
	$scope.newEnquiry = {};
	$scope.submitForm = function(){
		$scope.pageInfo.formSubmitted = true;

		if($scope.pageInfo.referform.$valid){
			httpService.post(ajaxurl+'cb_new_referral', $scope.newEnquiry).then(function(res){
				if(res.status == 'Success'){
					$scope.pageInfo.enquirydone = true;
				}
			});
		}
	};

	$scope.pageInfo = {formSubmitted : false};
	$scope.pageInfo.enquirydone = false;
})
.factory('httpService', httpRestService);

httpRestService.$inject = ['$http', '$q'];

function httpRestService($http, $q) {

    return {
        get: get,
        post: post
    }

    function get(url) {
        return $http.get(url);
    }

    function post(url, req) {
        var deferred = $q.defer(),
            apiPromise;

        apiPromise = $http.post(url, req, {headers: { 'Content-Type': 'application/x-www-form-urlencoded' }});

        apiPromise.then(function(response){
            deferred.resolve(response.data);
        }, function(response){
            deferred.reject(response);
        });

        return deferred.promise;

    }

}