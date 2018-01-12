app.controller('VoucherController', ['$scope',, '$state', 'VoucherService', function ($scope, $state, VoucherService) {

    $scope.voucher = {};
    $scope.vouchers = [];

    $scope.getVouchers = function () {
        VoucherService.getVouchers(function (response) {
            $scope.vouchers = response.data;
        }, function (response) {
            console.log("error occurred while trying to fet=ch list of vouchers");
        });
    };

    $scope.createVoucher = function () {
        VoucherService.createVoucher($scope.voucher, function(response) {
            console.log("voucher was successfully created");
        }, function (response) {
            console.log("error occurred while trying to create voucher");
        });
    };

    $scope.deleteVoucher = function (voucherId) {
        VoucherService.deleteVoucher(voucherId, function (response) {
            console.log("voucher was successfully updated");
            $scope.getVouchers();
        }, function (response) {
            console.log("error occurred while trying to delete the voucher");
        });
    };

    $scope.updateVoucher = function () {
        VoucherService.updateVoucher($scope.voucherUpdate.id, $scope.voucherUpdate, function (response) {
            console.log("voucher was successfully updated");
            $scope.getVouchers();
        }, function (response) {
            console.log("error occurred while trying to update the voucher");
        });
    };

    $scope.getOfficeEntities = function () {
        VoucherService.getOfficeEntities(function (response) {
            $scope.officeEntities = response.data;
        }, function (response) {
            console.log("error occurred while trying to get the list of office entities");
        });
    };
    
}]);

app.service('VoucherService', ['APIService', function (APIService) {

    this.createVoucher = function (voucherDetails, successHandler, errorHandler) {
        APIService.post('/api/voucher/create', voucherDetails, successHandler, errorHandler);
    };

    this.getVouchers = function (successHandler, errorHandler) {
        APIService.get('/api/vouchers', successHandler, errorHandler);
    };

    this.getVoucherById = function (voucherId, successHandler, errorHandler) {
        APIService.get('/api/voucher/' + voucherId, successHandler, errorHandler);
    };

    this.deleteVoucher = function (voucherId, successHandler, errorHandler) {
        APIService.delete('/api/voucher/delete/' + voucherId, successHandler, errorHandler);
    };

    this.updateVoucher = function (voucherId, voucherDetails, successHandler, errorHandler) {
        APIService.put('/api/voucher/update/' + voucherId, voucherDetails, successHandler, errorHandler);
    };

    this.getOfficeEntities = function (successHandler, errorHandler) {
        APIService.get('/api/office_entities',  successHandler, errorHandler);
    };
}]);