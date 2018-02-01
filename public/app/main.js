app.controller('MainController', ['$rootScope', '$scope', '$cookies', '$state', 'MainService', function ($rootScope, $scope, $cookies, $state, MainService) {

    var state = $cookies.get('state');
    if(state) {
        $state.go(state);
        $cookies.remove('state');
    }

    $rootScope.formatDate = function (timeStamp) {
        var date = new Date(timeStamp);
        var day = date.getDay();
        switch(day) {
            case 0 :
                day = 'Sunday';
                break;
            case 1 :
                day = 'Monday';
                break;
            case 2 :
                day = 'Tuesday';
                break;
            case 3 : 
                day = 'Wednesday';
                break;
            case 4 :
                day = 'Thursday';
                break;
            case 5 :
                day = 'Friday';
                break;
            case 6 : 
                day = 'Saturday';
                break;
        }
        return day + ', ' + date.toLocaleString();
    };
    
}]);

app.service('MainService', ['APIService', function (APIService) {

}]);