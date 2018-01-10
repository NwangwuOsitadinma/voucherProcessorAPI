var app = angular.module('tenece', ['ui.router']);

app.config(['$httpProvider', '$interpolateProvider', '$locationProvider', '$stateProvider', '$urlRouterProvider',
    function ($httpProvider, $interpolateProvider, $locationProvider, $stateProvider, $urlRouterProvider) {

        $interpolateProvider.startSymbol('<%').endSymbol('%>');

        $httpProvider.defaults.headers.common['Accept'] = "application/json";
        $httpProvider.defaults.headers.common['Content-Type'] = "application/json";
        $httpProvider.defaults.useXDomain = true;

        $locationProvider.html5Mode(true);

        $urlRouterProvider.otherwise('/');

        $stateProvider
            .state('dashboard', {
                url: '/',
                templateUrl: '/app/dashboard.html',
                controller: 'MainController'
            })
            .state('new-voucher', {
                url: '/new-voucher',
                templateUrl: '/app/modules/voucher/new-voucher.html',
                controller: 'VoucherController'
            })
            .state('view-vouchers', {
                url: '/view-vouchers',
                templateUrl: '/app/modules/voucher/view-vouchers.html',
                controller: 'VoucherController'
            })
            .state('new-item', {
                url: '/new-item',
                templateUrl: '/app/modules/item/new-item.html',
                controller: 'ItemController'
            })
            .state('view-items', {
                url: '/view-items',
                templateUrl: '/app/modules/item/view-items.html',
                controller: 'ItemController'
            })
            .state('new-branch', {
                url: '/new-branch',
                templateUrl: '/app/modules/branch/new-branch.html',
                controller: 'BranchController'
            })
            .state('view-branches', {
                url: '/view-branches',
                templateUrl: '/app/modules/branch/view-branches.html',
                controller: 'BranchController'
            })
            .state('new-office-entity', {
                url: '/new-office-entity',
                templateUrl: '/app/modules/office-entity/new-office-entity.html',
                controller: 'OfficeEntityController'
            })
            .state('view-office-entities', {
                url: '/view-office-entities',
                templateUrl: '/app/modules/office-entity/view-office-entities.html',
                controller: 'OfficeEntityController'
            })
            .state('new-office-entity-type', {
                url: '/new-office-entity-type',
                templateUrl: '/app/modules/office-entity-type/new-office-entity-type.html',
                controller: 'OfficeEntityTypeController'
            })
            .state('view-office-entity-types', {
                url: '/view-office-entity-types',
                templateUrl: '/app/modules/office-entity-type/view-office-entity-types.html',
                controller: 'OfficeEntityTypeController'
            });

    }]);