app.controller('OfficeEntityTypeController', ['$scope', '$state', 'OfficeEntityTypeService', function($scope, $state, OfficeEntityTypeService) {

    $scope.officeEntityType = {};
    $scope.officeEntityTypes = [];
    $scope.page = 'view-office-entity-types';

    $scope.createOfficeEntityType = function () {
        Pace.restart();
        OfficeEntityTypeService.createOfficeEntityType($scope.officeEntityType, function (response) {
            console.log("office entity type was successfully created");
            $state.go('view-office-entity-types');
        }, function (response) {
            console.log("an error occured while trying to create the office entity type");
        });
    };

    $scope.getOfficeEntityTypes = function () {
        OfficeEntityTypeService.getOfficeEntityTypes(function(response) {
            $scope.officeEntityTypes = response.data;
        }, function (response) {
            console.log("an error occured while fetching list of office entity types");
        });
    };

    $scope.getOfficeEntityTypeDetails = function(officeEntityId) {
        Pace.restart();
        OfficeEntityTypeService.getOfficeEntityTypeById(officeEntityId, function (response) {
            $scope.officeEntityType = response.data;
            $scope.page = 'office-entity-type-details';
        }, function(response) {
            console.log("an error occurred while trying to fetch the office entity type details");
        });
    };

    $scope.deleteOfficeEntityType = function (officeEntityId) {
        Pace.restart();
        OfficeEntityTypeService.deleteOfficeEntityType(officeEntityId, function (response) {
            console.log("office entity type was succesfully deleted");
            $scope.getOfficeEntityTypes();
            $scope.page = 'view-office-entity-types';
        }, function (response) {
            console.log("an error occurred while trying to delete office entity type");
        });
    };

    $scope.updateOfficeEntityType = function () {
        Pace.restart();
        OfficeEntityTypeService.updateOfficeEntityType($scope.officeEntityType.id, $scope.officeEntityType, function (response) {
            console.log("office entity type was successfully updated");
            $scope.getOfficeEntityTypes();
        }, function (response) {
            console.log("an error occured while trying to update office entity types");
        });
    };

    $scope.getUpdatePage = function () {
        Pace.restart();
        $scope.page = 'update-office-entity-type';
    };
}]);

app.service('OfficeEntityTypeService', ['APIService', function(APIService) {

    this.createOfficeEntityType = function (officeEntityTypeDetails, successHandler, errorHandler) {
        APIService.post('/api/office_entity_type/create', officeEntityTypeDetails, successHandler, errorHandler);
    };

    this.getOfficeEntityTypes = function (successHandler, errorHandler) {
        APIService.get('/api/office_entity_types', successHandler, errorHandler);
    };

    this.getOfficeEntityTypeById = function (officeEntityTypeId, successHandler, errorHandler) {
        APIService.get('/api/office_entity_type/' + officeEntityTypeId, successHandler, errorHandler);
    };

    this.deleteOfficeEntityType = function (officeEntityTypeId, successHandler, errorHandler) {
        APIService.delete('/api/office_entity_type/delete/' + officeEntityTypeId, successHandler, errorHandler);
    };

    this.updateOfficeEntityType = function (officeEntityTypeId, officeEntityTypeDetails, successHandler, errorHandler) {
        APIService.put('/api/office_entity_type/update/' + officeEntityTypeId, officeEntityTypeDetails, successHandler, errorHandler);
    };
}]);