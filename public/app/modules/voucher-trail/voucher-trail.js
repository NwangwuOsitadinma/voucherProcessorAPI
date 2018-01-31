app.controller('VoucherTrailController', ['$rootScope', '$scope', '$state', 'VoucherTrailService',
        function($rootScope, $scope, $state, VoucherTrailService) {

    $scope.voucherTrails = [];
    $scope.pagination = {};
    $scope.pagination.index = 1;

    $scope.getVoucherTrails = function () {
        if ($rootScope.role == 'ADMIN') {
            VoucherTrailService.getVoucherTrails(function (response) {
                $scope.voucherTrails = response.data;
                $scope.pagination.urls = [];
                for (var i = 0; i < $scope.voucherTrails.last_page; i++) {
                    $scope.pagination.urls.push($scope.voucherTrails.path + "&page=" + (i + 1));
                }
            }, function (response) {
                console.error("error occurred while trying to fetch the voucher trails");
            });
        } else {
            return;
        }
    };

    $scope.searchText = function () {
        VoucherTrailService.searchText($scope.searchParam, function (response) {
            $scope.voucherTrails = response.data;
            $scope.pagination.urls = [];
            for (var i = 0; i < $scope.voucherTrails.last_page; i++) {
                $scope.pagination.urls.push($scope.voucherTrails.path + "&page=" + (i + 1));
            }
        }, function (response) {
            console.log("error occurred while trying to fetch the searched text");
        });
    };

    $scope.getPage = function (url, index) {
        console.log(index);
        VoucherTrailService.getPage(url, function (response) {
            if (index === 0) {
                $scope.pagination.index++;
            } else if (index === -1) {
                $scope.pagination.index--;
            } else {
                $scope.pagination.index = index;
            }
            $scope.voucherTrails = response.data;
        }, function (response) {
            console.log("error occurred while trying to get the vouchers");
        });
    };
}]);

app.service('VoucherTrailService', ['APIService', function (APIService) {

    this.getVoucherTrails = function (successHandler, errorHandler) {
        APIService.get('/api/voucher-trails?n=10', successHandler, errorHandler);
    };

    this.searchText = function (text, successHandler, errorHandler) {
        APIService.get('/api/voucher-trails/find?q=' + text + '&n=10', successHandler, errorHandler);
    };

    this.getPage = function (url, successHandler, errorHandler) {
        APIService.get(url, successHandler, errorHandler);
    };
}]);