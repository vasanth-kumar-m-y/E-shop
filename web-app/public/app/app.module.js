'use strict';

angular.module('app', [
    'ui.bootstrap', 
    'ui.bootstrap.tpls',
    'ngRoute',
    'ngAnimate', 
    'ngCookies', 
    'ngResource', 
    'duScroll', 
    "flash"
//  'shopAnimations',
//  'shopControllers',
//  'shopFilters',
//  'shopServices'
]);

angular.module('app').constant('API_PATH', '/v1.0');

angular.module('app').config(function($routeProvider) {

    $routeProvider.

    //auth
    when('/auth/login', {
        templateUrl: 'tpl/pages/auth-login.tpl.html',
        controller: 'AuthLoginController',
        controllerAs: 'page',
        options : { }        
    }).
    when('/auth/signup', {
        templateUrl: 'tpl/pages/auth-signup.tpl.html',
        controller: 'AuthSignupController',
        controllerAs: 'page',
        options : { }  
    }).

    //admin user
     when('/admin/users/all', {
        templateUrl: 'tpl/pages/all-users.tpl.html',
        controller: 'UserAllController',
        controllerAs: 'page', 
        middleware : { auth: true },
        options : { }              
    }). 
    when('/admin/users/create', {
        templateUrl: 'tpl/pages/create-users.tpl.html',
        controller: 'UserCreateController',
        controllerAs: 'page', 
        middleware : { auth: true },
        options : { }              
    }).  
    when('/admin/users/:id/edit', {
        templateUrl: 'tpl/pages/edit-users.tpl.html',
        controller: 'UserEditController',
        controllerAs: 'page', 
        middleware : { auth: true },
        options : { }              
    }).

    //user settings 
    when('/user/settings', {
        templateUrl: 'tpl/pages/user-settings.tpl.html',
        controller: 'UserSettingsController',
        controllerAs: 'page',
        middleware : { auth: true },
        options : { }      
    }).

    //user cart
    when('/user/carts', {
        templateUrl: 'tpl/pages/user-cart.tpl.html',
        controller: 'UserCartController',
        controllerAs: 'page',
        middleware : { auth: true },
        options : {  }        
    }).    
 
    //product
    when('/', {
        templateUrl: 'tpl/pages/product-results.tpl.html',
        controller: 'ProductResultsController',
        controllerAs: 'page', 
        middleware : { auth: true },
        options : { }              
    }).    
    when('/product/search', {
        templateUrl: 'tpl/pages/product-results.tpl.html',
        controller: 'ProductResultsController',
        controllerAs: 'page',
        middleware : { auth: true },
        options : {  }
    }).
    when('/product/create', {
        templateUrl: 'tpl/pages/product-create.tpl.html',
        controller: 'ProductCreateController',
        controllerAs: 'page',
        middleware : { auth: true },
        options : {  }       
    }).
    when('/product/:pid', {
        templateUrl: 'tpl/pages/product-show.tpl.html',
        controller: 'ProductShowController',
        controllerAs: 'page',
        middleware : { auth: true },
        options : {  }   
    }).
    when('/product/:pid/edit', {
        templateUrl: 'tpl/pages/product-edit.tpl.html',
        controller: 'ProductEditController',
        controllerAs: 'page',
        middleware : { auth: true },
        options : {  }       
    }).
    
    otherwise({
        redirectTo: '/'
    });

});

angular.module('app').run(function($rootScope, $document, $location, auth, layout)
{
    $rootScope.layout = layout;
    $rootScope.auth = auth;
    $rootScope.isInvalid = isInvalid;

    $rootScope.$on('$routeChangeStart', function(event, next, current)
    {
        //check if user is logged using middleware auth
        if(getMiddleware('auth', next) && !auth.getUser()){
            event.preventDefault();
            $location.path('/auth/login');
        }

        //scroll animate to top on route change
        var someElement = angular.element(document.body);
        $document.scrollToElementAnimated(someElement);

        layout.setDefaults();
    });

    function getMiddleware(name, route)
    {
        if(typeof route.$$route.middleware === "undefined"
        || typeof route.$$route.middleware[name] === "undefined"){
            return null;
        }

        return route.$$route.middleware[name];
    }

    function isInvalid(element, apiErrors)
    {
        return (element.$$parentForm.$submitted || element.$touched) 
        && (element.$invalid || apiErrors[element.$name] );
    }
});

