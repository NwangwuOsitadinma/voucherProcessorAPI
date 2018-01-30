app.controller('RolesAndClaimsController', ['$rootScope', '$scope', '$state', 'RolesAndClaimsService', function ($rootScope, $scope, $state, RolesAndClaimsService) {

    var j = 1;

    $scope.new_role = {};

    $scope.createRoleWithClaims = function () {
        Pace.restart();
        $scope.new_role.claims = [];
        for (var i = 0; i < j; i++) {
            if ($('#itemName' + i).val()) {
                $scope.new_role.claims.push($('#itemName' + i).val());
            }
        }
        if($scope.new_role.claims.length < 1) {
            $scope.errorMessage = 'Please add a claim';
            return;
        }
        RolesAndClaimsService.createRoleWithClaims($scope.new_role, function(response) {
            console.log("role was successfully created");
            $state.go('view-users');
        }, function (response) {
            console.log("error occurred while trying to create the new role");
        });
    };

    $scope.addItem = function () {
        $('#item_' + j)
            .html('<div class="col-sm-6">\n' +
            '<div class="form-group">\n' +
            '<input class="form-control" id="itemName' + j + '" name="claim[]" type="text" placeholder="Claim Name" required>\n' +
            '</div>\n' +
            '</div>\n' +
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
        console.log('sup i just got to remove item');
        $('#item_' + n).html('');
    };
}]);

app.service('RolesAndClaimsService', ['APIService', function(APIService)  {

    this.createRoleWithClaims = function (roleWithClaims, successHandler, errorHandler) {
        APIService.post('/api/role-with-claims/create', roleWithClaims, successHandler, errorHandler);
    };

    this.assignRole = function (details, successHandler, errorHandler) {
        APIService.put('/api/role-with-claims/assign', details, successHandler, errorHandler);
    };

    this.retractUserRole = function (userId, roleId, successHandler, errorHandler) {
        APIService.delete('/api/role-with-claims/retract-user-role?user=' +userId + '&role=' +roleId, successHandler, errorHandler);
    };

    this.retractUserClaims = function (userId, claims, successHandler, errorHandler) {
        APIService.delete('/api/role-with-claims/retract-user-claims?user=' +userId + '&claims=' +claims, successHandler, errorHandler);
    };

    this.retractRoleClaims = function (roleId, claims, successHandler, errorHandler) {
        APIService.delete('/api/role-with-claims/retract-role-claims?role=' + roleId + '&claims=' + claims, successHandler, errorHandler);
    };
}]);