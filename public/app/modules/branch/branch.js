app.controller('BranchController', ['$rootScope', '$scope', '$state', 'BranchService', function ($rootScope, $scope, $state, BranchService) {

    $scope.branch = {};
    $scope.branches = [];
    $scope.page = 'view-branches';

    $scope.createBranch = function () {
        Pace.restart();
        if ($rootScope.role == 'ADMIN') {
            BranchService.createBranch($scope.branch, function (response) {
                console.log("branch was successfully created");
                $state.go('view-branches');
            }, function (response) {
                console.log("branch could not be created");
            });
        } else {
            return;
        }
    };

    $scope.getBranchDetails = function (branchId) {
        Pace.restart();
        BranchService.getBranchById(branchId, function (response) {
            $scope.branch = response.data;
            $scope.page = 'branch-details';
        }, function (response) {
            console.log("error occured while trying to get the branch");
        });
    };

    $scope.getBranches = function () {
        BranchService.getBranches(function (response) {
            $scope.branches = response.data;
        }, function (response) {
            console.log("error occured while fetching branches");
        });
    };

    $scope.deleteBranch = function (branchId) {
        Pace.restart();
        if ($rootScope.role == 'ADMIN') {
            BranchService.deleteBranch(branchId, function (response) {
                console.log("branch has been deleted");
                $scope.getBranches();
            }, function (response) {
                console.log("an error occured while trying to delete the branch");
            });
        } else {
            return;
        }
    };

    $scope.updateBranch = function () {
        Pace.restart();
        if ($rootScope.role == 'ADMIN') {
            BranchService.updateBranch($scope.branch.id, $scope.branch, function (response) {
                console.log("branch was successfully updated");
                $scope.getBranches();
                $scope.page = 'view-branches';
            }, function (response) {
                console.log("error occured while trying to update the branch");
            });
        } else {
            return;
        }
    };

    $scope.getUpdatePage = function () {
        Pace.restart();
        $scope.branch.finance_head = $scope.branch.finance_head_id;
        $scope.branch.payer = $scope.branch.payer_id;
        $scope.page = 'update-branch';
    };

    $scope.getAllUsers = function () {
        BranchService.getAllUsers(['full_name', 'id'], function (response) {
            $scope.users = response.data;
        }, function (response) {
            console.log("error occurred while trying to get the list of users");
        });
    };
}]);

app.service('BranchService', ['APIService', function (APIService) {

    this.createBranch = function (branchDetails, successHandler, errorHandler) {
        APIService.post('/api/branch/create', branchDetails, successHandler, errorHandler);
    };

    this.getBranches = function (successHandler, errorHandler) {
        APIService.get('/api/branches', successHandler, errorHandler);
    };

    this.getBranchById = function (branchId, successHandler, errorHandler) {
        APIService.get('/api/branch/' + branchId, successHandler, errorHandler);
    };

    this.deleteBranch = function (branchId, successHandler, errorHandler) {
        APIService.delete('/api/branch/delete/' + branchId, successHandler, errorHandler);
    };

    this.updateBranch = function (branchId, branchDetails, successHandler, errorHandler) {
        APIService.put('/api/branch/update/' + branchId, branchDetails, successHandler, errorHandler);
    };

    this.getAllUsers = function (fields, successHandler, errorHandler) {
        APIService.get('/api/users?fields=' + fields.toString(), successHandler, errorHandler);
    };
}]);