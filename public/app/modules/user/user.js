app.controller('UserController', ['$scope', 'UserService', function ($scope, UserService) {

    $scope.user = {};
    $scope.users = [];

    $scope.login = function () {
        UserService.login($scope.user, function (response) {
            if(response.data) {
                if (typeof(Storage) !== "undefined") {
                    window.sessionStorage.setItem('Authorization', 'Bearer ' +response.data);
                    window.location.href = '/';
                } else {
                    console.log('Sorry! No Web Storage support..');
                }
            } else {
                $scope.loginError = 'Invalid login details';
            }
        }, function (response) {
            console.log("error occurred while trying to authenticate the user");
        });
    };
}]);

app.service('UserService', ['APIService', function (APIService) {

    this.login = function (userDetails, successHandler, errorHandler) {
        APIService.post('/login', userDetails, successHandler, errorHandler);
    };

    this.register = function (userDetails, successHandler, errorHandler) {
        APIService.post('/register', userDetails, successHandler, errorHandler);
    };
}]);