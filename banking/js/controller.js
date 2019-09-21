angular.module('cbApp', [])
.controller('CCFormController', function($scope, httpService) {
	
	$scope.citylist = ["600088 Adambakkam","600020 Adyar","600053 Ambattur","600029 Aminjikarai","600070 Anakaputur","600040 Annanagar","600106 Arumbakkam","600023 Ayanavaram","600108 Broadway","600001 Chennai","600031 Chetput","600064 Chitlapakkam","600112 Choolai","600094. Choolaimedu","600044. Chrompet","600008 Egmore","600086 Gopalapuram","600038 ICF","600036 IIT","600082 Jawaharnagar","600078 K.K.Nagar","600071 Kamarajnagar","600010 Kilpauk","600024 Kodambakkam","600118 Kodungaiyur","600099 Kolathur","600080 Korattur","600085 Kottur","600107 Koyambedu","600069 Kunnathur","600060 Madhavaram","600091 Madipakkam","600095 Maduravoyal","600068 Manali","600100 Medavakkam","600027 Meenakbakkam","600037 Mogappair","600004 Mylapore","600089 Nandambakkam","600035 Nandanam","600061 Nanganallur","600034. Nungambakkam","600050 Padi","600043 Pallavaram","600075 Pammal","600072 Pattabiram","600114 Pazhavanthangal","600011 Perambur","600096 Perungudi","600116 Porur","600066 Pozhal","600074 Pozhichalur","600014 Royapettai","600013 Royapuram","600062 S.M.Nagar","600015 Saidapet","600093 Saligrammam","600073 Selaiyur","600067 Sholavaram","600119 Sholinganallur","600017 T.Nagar","600045 Tambaram","600018 Teynampet","600005 Tiruvallikeni","600041 Tiruvanmiyur","600077 Tiruverkadu","600019 Tiruvottiyur","600081 Tondiarpet","600026 Vadapalani","600048 Vandalur","600042 Velachery","600007 Vepery","600049 Villivakkam","600092 Virgambakkam","600039 Vyasarpadi","600021 Washermanpet","632503 Arcot","606701 Chengam","603302 Cheyur","604202 Gingee","601201 Gummidipundi","603103 Kelambakkam","603306 Madurantakam","603104 Mamallapuram","603319 Melmaruvathur","631207 Pallipattu","606803 Polur","601204 Ponneri","600056 Poonamallee","602105 Sriperumbudur","603109 Tirukalikundram","631209 Tiruttani","602001 Tiruvallur","604407 Tiruvettipuram","603406 Uttiramerur","602026 Uttukottai","604408 Vandavasi","605109 Vanur","631605 Walajabad","632513 Walajapet"];


	$scope.newEnquiry = {occupation: '',  language: '', salary_by: '', etype: 'Credit Card', mobile_verified: 0, dob: [], tnc:true};
	$scope.submitForm = function(){
		console.log($scope.newEnquiry, $scope.pageInfo.enquiryform);
		$scope.pageInfo.formSubmitted = true;

		if($scope.pageInfo.enquiryform.$valid){
			httpService.post(ajaxurl+'cb_new_enquiry', $scope.newEnquiry).then(function(res1){
				if(res1.status == 'Success'){
					httpService.post(ajaxurl+'cb_verify_otp', {mobile: $scope.newEnquiry.mobile}).then(function(res){
						if(res.status == 'Success'){
							$scope.pageInfo.otp = atob(res.res);
							$scope.pageInfo.mobileVerified = 2;
							$scope.logid = res1.id;
							$('#onload').modal('show');
						} else {
							$scope.pageInfo.mobileVerified = 3;
						}
					});
				}
			});
		}
	};

	$scope.send_otp = function(){
		httpService.post(ajaxurl+'cb_verify_otp', {mobile: $scope.newEnquiry.mobile}).then(function(res){
			if(res.status == 'Success'){
				$scope.pageInfo.otp = atob(res.res);
				$scope.pageInfo.mobileVerified = 2;
				$scope.pageInfo.changemobilenumber = false;
			} else {
				$scope.pageInfo.mobileVerified = 3;
			}
		});
	};

	$scope.setCity = function(city){
		$scope.newEnquiry.zip = city;
	};

	$scope.verify_otp = function(){
		if($scope.pageInfo.otp == $scope.pageInfo.verifyotp){
			$scope.newEnquiry.mobile_verified = 0;
			$scope.pageInfo.mobileVerified = 1;
			httpService.post(ajaxurl+'cb_update_verified', {id: $scope.logid}).then(function(res){

			});
		} else if($scope.pageInfo.verifyotp.length > 5){
			$scope.pageInfo.mobileVerified = 4;
		}
	};

	$scope.pageInfo = {formSubmitted : false, showcity: false};
	$scope.pageInfo.mobileVerified =0;
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