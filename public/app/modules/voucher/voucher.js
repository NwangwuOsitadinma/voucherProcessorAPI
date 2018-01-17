app.controller('VoucherController', ['$scope', '$state', 'VoucherService', function ($scope, $state, VoucherService) {

    var j = 0;

    $scope.voucher = {};
    $scope.vouchers = [];
    $scope.page = 'view-vouchers';
    $scope.voucher.items = [];

    $scope.getVouchers = function () {
        VoucherService.getVouchers(function (response) {
            $scope.vouchers = response.data;
        }, function (response) {
            console.log("error occurred while trying to fetch list of vouchers");
        });
    };

    $scope.createVoucher = function () {
        Pace.restart();
        for (var i = 0; i < j; i++) {
            $itemName = document.getElementById('#itemName' + i);
            $itemPrice = document.getElementById('#itemPrice' + i);
            if ($itemName && $itemName.value && $itemPrice && $itemPrice.value) {
                var item = {
                    'name': $('#itemName' + i).val(),
                    'price': $('#itemPrice' + i).val()
                }
                // console.log(item);
                $scope.voucher.items.push(item);
            }
        }
        VoucherService.createVoucher($scope.voucher, function (response) {
            console.log("voucher was successfully created");
            $state.go('view-vouchers');
        }, function (response) {
            console.log("error occurred while trying to create voucher");
        });
    };

    $scope.getVoucherDetails = function (voucherId) {
        Pace.restart();
        VoucherService.getVoucherById(voucherId, function (response) {
            $scope.voucher = response.data;
            $scope.page = 'voucher-details';
        }, function (response) {
            console.log("error occured while getting voucher details");
        });
    };

    $scope.deleteVoucher = function (voucherId) {
        Pace.restart();
        VoucherService.deleteVoucher(voucherId, function (response) {
            console.log("voucher was successfully updated");
            $scope.getVouchers();
        }, function (response) {
            console.log("error occurred while trying to delete the voucher");
        });
    };

    $scope.updateVoucher = function () {
        Pace.restart();
        VoucherService.updateVoucher($scope.voucher.id, $scope.voucher, function (response) {
            console.log("voucher was successfully updated");
            $scope.getVouchers();
            $scope.page = 'view-vouchers';
        }, function (response) {
            console.log("error occurred while trying to update the voucher");
        });
    };

    $scope.getUpdatePage = function () {
        Pace.restart();
        $scope.voucher.office_entity = $scope.voucher.office_entity_id;
        $scope.page = 'update-voucher';
    };

    $scope.getOfficeEntities = function () {
        VoucherService.getOfficeEntities(function (response) {
            $scope.officeEntities = response.data;
        }, function (response) {
            console.log("error occurred while trying to get the list of office entities");
        });
    };

    $scope.addItem = function () {

        $('#item_' + j)
            .html('<div class="col-sm-1">\n' +
            '<a href="javascript:void(0)" class="btn btn-danger pull-left" onclick="removeItem(' + j + ')">\n' +
            '<i class="fa fa-times"></i> </a>' +
            '</div>\n' +
            '<div class="col-sm-5">\n' +
            '<div class="form-group">\n' +
            '<input class="form-control" id="itemName' + j + '" data-ng-model="itemName' + j + '" name="name[]" type="text" placeholder="Item Name" required>\n' +
            '</div>\n' +
            '</div>\n' +
            '<div class="col-sm-6">\n' +
            '<div class="form-group">\n' +
            '<input class="form-control" id="itemPrice' + j + '" data-ng-model="itemPrice' + j + '" name="price[]" type="number" placeholder="Item Price" required>\n' +
            '</div>' +
            '</div>');

        $('#items').append('<div class="row" id="item_' + (j + 1) + '"></div>');

        j++;
    };

    $scope.deleteLastItem = function () {
        if (j >= 1) {
            $('#item_' + (j - 1)).html('');
            j--;
        }
    };

    $scope.removeItem = function (n) {
        console.log('sup i just got to remove item');
        $('#item_' + n).html('');
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
        APIService.get('/api/office_entities', successHandler, errorHandler);
    };
}]);