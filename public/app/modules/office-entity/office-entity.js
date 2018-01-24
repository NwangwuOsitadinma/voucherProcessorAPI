app.controller('OfficeEntityController', ['$rootScope', '$scope', '$state', 'OfficeEntityService', function ($rootScope, $scope, $state, OfficeEntityService) {

    $scope.officeEntity = {};
    $scope.officeEntities = [];
    $scope.page = 'view-office-entities';

    $scope.initialize = function () {
        $scope.getAllUsers();
        $scope.getAllBranches();
        $scope.getAllOfficeEntityTypes();
    };

    $scope.createOfficeEntity = function () {
        console.log($('#multiselect').chosen().val());
        $scope.officeEntity.employees = $('#multiselect').chosen().val();
        Pace.restart();
        if ($rootScope.role == 'ADMIN' || $rootScope.role == 'MODERATOR') {
            OfficeEntityService.createOfficeEntity($scope.officeEntity, function (response) {
                console.log("office entity was successfully created");
                $state.go('view-office-entities');
            }, function (response) {
                console.log("an error occured while trying to create the office entity");
            });
        } else {
            return;
        }
    };

    $scope.getOfficeEntities = function () {
        OfficeEntityService.getOfficeEntities(function (response) {
            $scope.officeEntities = response.data;
        }, function (response) {
            console.log("an error occured while fetching list of office entities");
        });
    };

    $scope.getOfficeEntityDetails = function (officeEntityId) {
        OfficeEntityService.getOfficeEntityById(officeEntityId, function (response) {
            $scope.officeEntity = response.data;
            $scope.page = 'office-entity-details';
        }, function (response) {
            console.log("error occurred while fetching the office entity details");
        });
    };

    $scope.deleteOfficeEntity = function (officeEntityId) {
        Pace.restart();
        if ($rootScope.role == 'ADMIN' || $rootScope.role == 'MODERATOR') {
            OfficeEntityService.deleteOfficeEntity(officeEntityId, function (response) {
                console.log("office entity was succesfully deleted");
                $scope.getOfficeEntities();
            }, function (response) {
                console.log("an error occurred while trying to delete office entity");
            });
        } else {
            return;
        }
    };

    $scope.updateOfficeEntity = function () {
        Pace.restart();
        if ($rootScope.role == 'ADMIN' || $rootScope.role == 'MODERATOR') {
            OfficeEntityService.updateOfficeEntity($scope.officeEntity.id, $scope.officeEntity, function (response) {
                console.log("office entity was successfully updated");
                $scope.getOfficeEntities();
                $scope.page = 'view-office-entities';
            }, function (response) {
                console.log("an error occured while trying to update office entity");
            });
        } else {
            return;
        }
    };

    $scope.getUpdatePage = function () {
        Pace.restart();
        $scope.officeEntity.office_entity_type = $scope.officeEntity.office_entity_type_id;
        $scope.officeEntity.lead = $scope.officeEntity.lead_id;
        $scope.officeEntity.branch = $scope.officeEntity.branch_id;
        $scope.page = 'update-office-entity';
    };

    $scope.getAllUsers = function () {
        OfficeEntityService.getAllUsers(['full_name', 'id'], function (response) {
            $scope.users = response.data;
            setTimeout(function () {
                $('#multiselect').chosen();
            }, 5);
        }, function (response) {
            console.log("error occurred while trying to get the list of users");
        });
    };

    $scope.getAllBranches = function () {
        OfficeEntityService.getAllBranches(function (response) {
            $scope.branches = response.data;
        }, function (response) {
            console.log("error occurred while trying to fetch the list of branches");
        });
    };

    $scope.getAllOfficeEntityTypes = function () {
        OfficeEntityService.getAllOfficeEntityTypes(function (response) {
            $scope.officeEntityTypes = response.data;
        }, function (response) {
            console.log("error occurred while trying to get the office entity types");
        });
    };
}]);

app.service('OfficeEntityService', ['APIService', function (APIService) {

    this.createOfficeEntity = function (officeEntityDetails, successHandler, errorHandler) {
        APIService.post('/api/office_entity/create', officeEntityDetails, successHandler, errorHandler);
    };

    this.getOfficeEntities = function (successHandler, errorHandler) {
        APIService.get('/api/office_entities', successHandler, errorHandler);
    };

    this.getOfficeEntityById = function (officeEntityId, successHandler, errorHandler) {
        APIService.get('/api/office_entity/' + officeEntityId, successHandler, errorHandler);
    };

    this.deleteOfficeEntity = function (officeEntityId, successHandler, errorHandler) {
        APIService.delete('/api/office_entity/delete/' + officeEntityId, successHandler, errorHandler);
    };

    this.updateOfficeEntity = function (officeEntityId, officeEntityDetails, successHandler, errorHandler) {
        APIService.put('/api/office_entity/update/' + officeEntityId, officeEntityDetails, successHandler, errorHandler);
    };

    this.getAllUsers = function (fields, successHandler, errorHandler) {
        APIService.get('/api/users?fields=' + fields.toString(), successHandler, errorHandler);
    };

    this.getAllBranches = function (successHandler, errorHandler) {
        APIService.get('/api/branches', successHandler, errorHandler);
    };

    this.getAllOfficeEntityTypes = function (successHandler, errorHandler) {
        APIService.get('/api/office_entity_types', successHandler, errorHandler);
    };
}]);