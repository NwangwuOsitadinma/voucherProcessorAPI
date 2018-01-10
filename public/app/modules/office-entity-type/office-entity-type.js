app.controller('OfficeEntityTypeTypeController', ['$scope', 'OfficeEntityTypeService', function($scope, OfficeEntityTypeService) {

    $scope.officeEntityType = {};
    $scope.officeEntityTypes = [];

    $scope.createOfficeEntity = function () {
        OfficeEntityTypeService.createOfficeEntity($scope.officeEntityType, function (response) {
            console.log("office entity type was successfully created");
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

    $scope.deleteOfficeEntityType = function (officeEntityId) {
        OfficeEntityTypeService.deleteOfficeEntityType(officeEntityId, function (response) {
            console.log("office entity type was succesfully deleted");
            $scope.getOfficeEntityTypes();
        }, function (response) {
            console.log("an error occurred while trying to delete office entity type");
        });
    };

    $scope.updateOfficeEntityType = function () {
        OfficeEntityTypeService.updateOfficeEntityType($scope.officeEntityTypeUpdate.id, $scope.officeEntityTypeUpdate, function (response) {
            console.log("office entity type was successfully updated");
            $scope.getOfficeEntityTypes();
        }, function (response) {
            console.log("an error occured while trying to update office entity types");
        });
    };
}]);

app.service('OfficeEntityTypeService', ['APIService', function(APIService) {

    this.createOfficeEntityType = function (officeEntityTypeDetails, successHandler, errorHandler) {
        APIService.post('/api/office-entity-type/create', officeEntityTypeDetails, successHandler, errorHandler);
    };

    this.getOfficeEntityTypes = function (successHandler, errorHandler) {
        APIService.get('/api/office-entities', successHandler, errorHandler);
    };

    this.getOfficeEntityTypeById = function (officeEntityTypeId, successHandler, errorHandler) {
        APIService.get('/api/office-entity-type/' + officeEntityTypeId, successHandler, errorHandler);
    };

    this.deleteOfficeEntityType = function (officeEntityTypeId, successHandler, errorHandler) {
        APIService.delete('/api/office-entity-type/delete/' + officeEntityTypeId, successHandler, errorHandler);
    };

    this.updateOfficeEntityType = function (officeEntityTypeId, officeEntityTypeDetails, successHandler, errorHandler) {
        APIService.put('/api/office-entity-type/update/' + officeEntityTypeId, officeEntityTypeDetails, successHandler, errorHandler);
    };
}]);