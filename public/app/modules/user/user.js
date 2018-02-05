app.controller('UserController', ['$rootScope', '$scope', '$state', 'UserService', function ($rootScope, $scope, $state, UserService) {

    $scope.user = {};
    $scope.object = {};
    $scope.users = [];
    $scope.page = 'view-users';
    $scope.roles = [];
    $scope.userChecks = [];
    $scope.pagination = {};
    $scope.pagination.index = 1;

    $scope.login = function () {
        UserService.login($scope.user, function (response) {
            if (response.data) {
                if (typeof (Storage) !== "undefined") {
                    window.sessionStorage.setItem('Authorization', 'Bearer ' + response.data);
                    // document.cookie = 'access_token=Bearer ' +response.data + '; path=/; secure=false;';
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

    $scope.getAllUsers = function () {
        UserService.getAllUsers(function (response) {
            $scope.users = response.data;
        }, function (response) {
            console.log("error occured while trying to fetch the users");
        });
    };

    $scope.getUserDetails = function (id) {
        Pace.restart();
        UserService.getUserById(id, function (response) {
            $scope.object.user = response.data;
            $scope.object.role = $scope.object.previousRole = response.data.roles[0].name;
            // $scope.page = 'user-details';
            $('#usersModal').modal('show');
            console.log($scope.object);
        }, function (response) {
            console.log("error occurred while trying to fetch the user details");
        });
    };

    $scope.assignRoleToUser = function () {
        Pace.restart();
        UserService.assignRole($scope.object, function (response) {
            console.log("role was successfully assigned to the user");
            $scope.page = 'view-users';
        }, function (response) {
            console.error("an error occurred while trying to assign the role");
        });
    };

    $scope.updateUserDetails = function (id) {
        Pace.restart();
        UserService.updateUserDetails(id, $scope.user, function (response) {
            console.log("update was successful");
            $scope.getAllUsers();
            $scope.page = 'view-users';
        }, function (response) {
            console.error("error occurred while trying to update the user");
        });
    };

    $scope.deleteUser = function (id) {
        Pace.restart();
        UserService.deleteUser(id, function (response) {
            console.log("user was successfully deleted");
            $scope.getAllUsers();
        }, function (response) {
            console.error("error occurred while trying to delete the user");
        });
    };

    $scope.registerNewUserEmail = function () {
        Pace.restart();
        if(!(/^\w+[a-z]+[0-9]*.*[_-]*@tenece.com$/gi.test($scope.user.email))) {
            $scope.errorMessage = "please register a valid tenece mail";
            return;
        }
        UserService.registerNewUserEmail($scope.user, function (response) {
            console.log("the user email was successfully registered");
            $state.go('view-tenece-mails');
        }, function (response) {
            console.log("error occurred while trying to create the user");
            $scope.errorMessage = "email already exists";
        });
    };

    $scope.getUserCheckEmails = function () {
        Pace.restart();
        UserService.getUserCheckEmails(function (response) {
            $scope.userChecks = response.data;
            // $scope.pagination.urls = [];
            // for (var i = 0; i < $scope.userChecks.last_page; i++) {
            //     $scope.pagination.urls.push($scope.userChecks.path + "&page=" + (i + 1));
            // }
        }, function (response) {
            console.log("an error occurred while trying to fetch the user checks emails");
        });
    };

    $scope.deleteUserCheckEmail = function (id) {
        UserService.deleteUserCheckEmail(id, function (response) {
            console.log("the user check email was successfully deleted");
            $scope.getUserCheckEmails();
        }, function (response) {
            console.log("an error occurred while trying to delete the user check email");
        });
    };

    $scope.getAllRoles = function () {
        UserService.getAllRoles(function (response) {
            $scope.roles = response.data;
        }, function (response) {
            console.error("an error occurred while trying to fetch all the registered roles");
        });
    };


}]);

app.service('UserService', ['APIService', function (APIService) {

    this.login = function (userDetails, successHandler, errorHandler) {
        APIService.post('/login', userDetails, successHandler, errorHandler);
    };

    this.getAllUsers = function (successHandler, errorHandler) {
        APIService.get('/api/users', successHandler, errorHandler);
    };

    this.getUserById = function (id, successHandler, errorHandler) {
        APIService.get('/api/user/' + id, successHandler, errorHandler);
    };

    this.deleteUser = function (id, successHandler, errorHandler) {
        APIService.delete('/api/user/delete/' + id, successHandler, errorHandler);
    };

    this.getAllRoles = function (successHandler, errorHandler) {
        APIService.get('/api/roles', successHandler, errorHandler);
    };

    this.updateUserDetails = function (id, userDetails, successHandler, errorHandler) {
        APIService.put('/api/user/update/' + id, userDetails, successHandler, errorHandler);
    };

    this.registerNewUserEmail = function (user, successHandler, errorHandler) {
        APIService.post('/api/user-check/create', user, successHandler, errorHandler);
    };

    this.getUserCheckEmails = function (successHandler, errorHandler) {
        APIService.get('/api/user-checks', successHandler, errorHandler);
    };

    this.deleteUserCheckEmail = function (id, successHandler, errorHandler) {
        APIService.delete('/api/user-check/delete/' + id, successHandler, errorHandler);
    };

    this.assignRole = function (details, successHandler, errorHandler) {
        APIService.put('/api/role-with-claims/assign', details, successHandler, errorHandler);
    };
}]);