app.controller('RolesAndClaimsController', ['$rootScope', '$scope', 'RolesAndClaimsService', function ($rootScope, $scope, RolesAndClaimsService) {

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