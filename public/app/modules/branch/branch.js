app.controller('BranchController', ['$scope', 'BranchService', function ($scope, BranchService) {

    $scope.branch = {};
    $scope.branches = [];
    $scope.page = 'view-branches';

    $scope.createBranch = function () {
        BranchService.createBranch($scope.branch, function (response) {
            console.log("branch was successfully created");
        }, function (response) {
            console.log("branch could not be created");
        });
    };

    $scope.getBranchDetails = function (branchId) {
        Pace.restart();
        BranchService.getBranchById(branchId, function (response) {
            $scope.branch = response.data;
            $scope.page = 'branch-details';
            // var html = '<span>' + response.data.finance_head.last_name + '</span> <span>' + response.data.finance_head.last_name + '</span>';
            // $('#branchAppend' +index).append(html);
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
        BranchService.deleteBranch(branchId, function (response) {
            console.log("branch has been deleted");
            $scope.getBranches();
        }, function (response) {
            console.log("an error occured while trying to delete the branch");
        });
    };

    $scope.updateBranch = function () {
        BranchService.updateBranch($scope.branchUpdate.id, $scope.branchUpdate, function (response) {
            console.log("branch was successfully updated");
            $scope.getBranches();
        }, function (response) {
            console.log("error occured while trying to update the branch");
        });
    };

    $scope.getAllUsers = function () {
        BranchService.getAllUsers(['last_name', 'first_name', 'id'], function (response) {
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