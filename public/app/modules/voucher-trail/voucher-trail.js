app.controller('VoucherTrailController', ['$rootScope', '$scope', '$state', 'VoucherTrailService',
        function($rootScope, $scope, $state, VoucherTrailService) {

    $scope.voucherTrails = [];

    $scope.getVoucherTrails = function () {
        if ($rootScope.role == 'ADMIN') {
            VoucherTrailService.getVoucherTrails(function (response) {
                $scope.voucherTrails = response.data;
            }, function (response) {
                console.error("error occurred while trying to fetch the voucher trails");
            });
        } else {
            return;
        }
    };
}]);

app.service('VoucherTrailService', ['APIService', function (APIService) {

    this.getVoucherTrails = function (successHandler, errorHandler) {
        APIService.get('/api/voucher-trails', successHandler, errorHandler);
    };
}]);