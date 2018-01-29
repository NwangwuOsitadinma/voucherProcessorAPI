app.controller('MainController', ['$scope', '$cookies', '$state', 'MainService', function ($scope, $cookies, $state, MainService) {

    var state = $cookies.get('state');
    if(state) {
        $state.go(state);
        $cookies.remove('state');
    }
}]);

app.service('MainService', ['APIService', function (APIService) {

}]);