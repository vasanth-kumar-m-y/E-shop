'use strict';

angular.module('app')
.controller('AuthLoginController', function($location, auth, layout, Flash) 
{
    var vm = Object.assign(this, 
    {
        loginId : '',
        password : '',
        login : login,    
        api : {
            errors : {form: false}
        }
    });
    
    (function run()
    {
        layout.init({
            section : {title : 'Login'},
            breadcrumb : {title: 'login'},
            page : {className :'page-auth-login'}
        });
    })();

    function login()
    {
        layout.loading = true;

        var promise = auth.attempt(vm.loginId, vm.password);

        promise.then(function(response) 
        {   console.log(response);
            layout.loading = false;
            Flash.create('info', '<strong>Welcome!</strong> you are logged in');  
            $location.url('/');
        }, 
        function(response) 
        {
            layout.loading = false;
            Flash.create('danger', '<strong>Login Errors</strong>');
            vm.api.errors.form = true;
        });
    }

});