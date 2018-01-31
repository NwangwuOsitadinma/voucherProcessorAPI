app.controller('VoucherController', ['$rootScope', '$scope', '$state', 'VoucherService', function ($rootScope, $scope, $state, VoucherService) {

    var j = 1;

    $scope.voucher = {};
    $scope.vouchers = [];
    $scope.page = 'view-vouchers';
    $scope.voucher.items = [];
    $scope.voucherUpdate = {};
    $scope.pagination = {};
    $scope.pagination.index = 1;

    $scope.getVouchers = function () {
        if ($rootScope.role == 'ADMIN' || $rootScope.role == 'MODERATOR') {
            VoucherService.getVouchers(function (response) {
                $scope.vouchers = response.data;
                $scope.pagination.urls = [];
                for (var i = 0; i < $scope.vouchers.last_page; i++) {
                    $scope.pagination.urls.push($scope.vouchers.path + "&page=" + (i + 1));
                }
            }, function (response) {
                console.log("error occurred while trying to fetch list of vouchers");
            });
        } else {
            $scope.getUserVouchers();
        }
    };

    $scope.getPayableVouchers = function () {
        VoucherService.getPayableVouchers(function (response) {
            $scope.vouchers = response.data;
        }, function (response) {
            console.error("an error occurred while trying to fetch payable vouchers");
        });
    };

    $scope.getUserVouchers = function () {
        VoucherService.getUserVouchers(function (response) {
            $scope.vouchers = response.data;
        }, function (response) {
            console.log("error occurred while trying to fetch the user's vouchers");
        });
    };

    $scope.createVoucher = function () {
        Pace.restart();
        for (var i = 0; i < j; i++) {
            if ($('#itemName' + i).val() && $('#itemPrice' + i).val()) {
                if (parseInt($('#itemPrice' + i).val()) < 1) {
                    $scope.voucher.items = [];
                    return;
                }
                var item = {
                    'name': $('#itemName' + i).val(),
                    'price': $('#itemPrice' + i).val()
                };
                $scope.voucher.items.push(item);
            }
        }
        if ($scope.voucher.items.length < 1) {
            $scope.errorMessage = 'Please add an item and fill in the item values';
            return;
        }
        VoucherService.createVoucher($scope.voucher, function (response) {
            console.log("voucher was successfully created");
            $state.go('my-vouchers');
        }, function (response) {
            console.log("error occurred while trying to create voucher");
        });
    };

    $scope.getVoucherDetails = function (voucherId) {
        Pace.restart();
        VoucherService.getVoucherById(voucherId, function (response) {
            $scope.voucher = response.data;
            $scope.voucher.totalPrice = 0;
            for (var i = 0; i < $scope.voucher.items.length; i++) {
                $scope.voucher.totalPrice += $scope.voucher.items[i].price;
            }
            $scope.page = 'voucher-details';
        }, function (response) {
            console.log("error occured while getting voucher details");
        });
    };

    $scope.deleteVoucher = function (voucherId) {
        Pace.restart();
        VoucherService.deleteVoucher(voucherId, function (response) {
            console.log("voucher was successfully updated");
            $scope.getUserVouchers();
        }, function (response) {
            console.log("error occurred while trying to delete the voucher");
        });
    };

    $scope.updateVoucher = function () {
        Pace.restart();
        VoucherService.updateVoucher($scope.voucher.id, $scope.voucher, function (response) {
            console.log("voucher was successfully updated");
            $scope.getUserVouchers();
            $scope.page = 'view-vouchers';
        }, function (response) {
            console.log("error occurred while trying to update the voucher");
        });
    };

    $scope.approveVoucher = function (voucherId, status, view) {
        console.log(status);
        if ($rootScope.role == 'ADMIN' || $rootScope.role == 'MODERATOR') {
            Pace.restart();
            VoucherService.approveVoucher(voucherId, { 'status': status }, function (response) {
                console.log(response.data);
                if (view === 'Payable Vouchers') {
                    $scope.getPayableVouchers();
                } else {
                    $scope.getVouchers();
                }
                $scope.page = 'view-vouchers';
                console.log("voucher was approved successfully");
            }, function (response) {
                console.log("error occurred while trying to approve the voucher");
            });
        } else {
            return;
        }
    };

    $scope.searchText = function () {
        VoucherService.searchText($scope.searchParam, function (response) {
            $scope.vouchers = response.data;
            $scope.pagination.urls = [];
            for (var i = 0; i < $scope.vouchers.last_page; i++) {
                $scope.pagination.urls.push($scope.vouchers.path + "&page=" + (i + 1));
            }
        }, function (response) {
            console.log("error occurred while trying to fetch the searched text");
        });
    };

    $scope.getPage = function (url, index) {
        console.log(index);
        VoucherService.getPage(url, function (response) {
            if (index === 0) {
                $scope.pagination.index++;
            } else if (index === -1) {
                $scope.pagination.index--;
            } else {
                $scope.pagination.index = index;
            }
            $scope.vouchers = response.data;
        }, function (response) {
            console.log("error occurred while trying to get the vouchers");
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
            .html('<div class="col-sm-6">\n' +
            '<div class="form-group">\n' +
            '<input class="form-control" id="itemName' + j + '" name="name[]" type="text" placeholder="Item Name" required>\n' +
            '</div>\n' +
            '</div>\n' +
            '<div class="col-sm-5">\n' +
            '<div class="form-group">\n' +
            '<input class="form-control" id="itemPrice' + j + '" name="price[]" type="number" min="1" placeholder="Item Price" required>\n' +
            '</div>' +
            '</div>' +
            '<div class="col-sm-1">\n' +
            '<a href="javascript:void(0)" class="btn btn-danger pull-right" onclick="removeItem(' + j + ')">\n' +
            '<i class="fa fa-times"></i> </a>' +
            '</div>\n');

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
        $('#item_' + n).html('');
    };

}]);

app.service('VoucherService', ['APIService', function (APIService) {

    this.createVoucher = function (voucherDetails, successHandler, errorHandler) {
        APIService.post('/api/voucher/create', voucherDetails, successHandler, errorHandler);
    };

    this.getVouchers = function (successHandler, errorHandler) {
        APIService.get('/api/vouchers?n=10', successHandler, errorHandler);
    };

    this.getPayableVouchers = function (successHandler, errorHandler) {
        APIService.get('/api/vouchers/payable', successHandler, errorHandler);
    };

    this.getVoucherById = function (voucherId, successHandler, errorHandler) {
        APIService.get('/api/voucher/' + voucherId, successHandler, errorHandler);
    };

    this.searchText = function (text, successHandler, errorHandler) {
        APIService.get('/api/vouchers/find?q=' + text + '&n=10', successHandler, errorHandler);
    };

    this.getUserVouchers = function (successHandler, errorHandler) {
        APIService.get('/api/vouchers/user', successHandler, errorHandler);
    };

    this.deleteVoucher = function (voucherId, successHandler, errorHandler) {
        APIService.delete('/api/voucher/delete/' + voucherId, successHandler, errorHandler);
    };

    this.updateVoucher = function (voucherId, voucherDetails, successHandler, errorHandler) {
        APIService.put('/api/voucher/update/' + voucherId, voucherDetails, successHandler, errorHandler);
    };

    this.approveVoucher = function (voucherId, details, successHandler, errorHandler) {
        APIService.put('/api/voucher/approve/' + voucherId, details, successHandler, errorHandler);
    };

    this.getOfficeEntities = function (successHandler, errorHandler) {
        APIService.get('/api/office_entities', successHandler, errorHandler);
    };

    this.getPage = function (url, successHandler, errorHandler) {
        APIService.get(url, successHandler, errorHandler);
    };
}]);