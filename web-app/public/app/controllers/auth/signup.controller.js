'use strict';

angular.module('app')
.controller('AuthSignupController', function(layout, auth, $location, Flash)
{
    var vm = Object.assign(this, 
    {
        inputs : {
            username : '',
            email : '',
            first_name : '',
            last_name : '',
            password : '',
            password_confirmation : '',
        },
        signup : signup,    
        api : {
            errors : {}
        }
    });

    (function run()
    {
        layout.init({
            section : {title : 'SignUp'},
            breadcrumb : {title: 'signup'},
            page : {className :'page-auth-signup'}
        });
    })();

    function signup()
    {
        layout.loading = true;

        auth.signup(vm.inputs).then(
        function(user) 
        {
            layout.loading = false;            
            Flash.create('success', '<strong>Signup Success!</strong>');    
            Flash.create('info', '<strong>Welcome!</strong> you are logged in');           
            $location.url('/');
        }, 
        function(response) 
        {
            layout.loading = false;              
            Flash.create('danger', '<strong>Signup Errors</strong>');
            vm.api.errors = response.data;
        });
    }   
});
