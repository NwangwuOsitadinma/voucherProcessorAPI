app.controller('OfficeEntityController', ['$scope', '$state', 'OfficeEntityService', function($scope, $state, OfficeEntityService) {

    $scope.officeEntity = {};
    $scope.officeEntities = [];

    $scope.createOfficeEntity = function () {
        Pace.restart();
        OfficeEntityService.createOfficeEntity($scope.officeEntity, function (response) {
            console.log("office entity was successfully created");
            $state.go('view-office-entities');
        }, function (response) {
            console.log("an error occured while trying to create the office entity");
        });
    };

    $scope.getOfficeEntities = function () {
        OfficeEntityService.getOfficeEntities(function(response) {
            $scope.officeEntities = response.data;
        }, function (response) {
            console.log("an error occured while fetching list of office entities");
        });
    };

    $scope.deleteOfficeEntity = function (officeEntityId) {
        OfficeEntityService.deleteOfficeEntity(officeEntityId, function (response) {
            console.log("office entity was succesfully deleted");
            $scope.getOfficeEntities();
        }, function (response) {
            console.log("an error occurred while trying to delete office entity");
        });
    };

    $scope.updateOfficeEntity = function () {
        OfficeEntityService.updateOfficeEntity($scope.officeEntityUpdate.id, $scope.officeEntityUpdate, function (response) {
            console.log("office entity was successfully updated");
            $scope.getOfficeEntities();
        }, function (response) {
            console.log("an error occured while trying to update office entity");
        });
    };
}]);

app.service('OfficeEntityService', ['APIService', function(APIService) {

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
}]);