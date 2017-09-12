'use strict';

angular.module('app')
.controller('UserEditController', function(layout, auth, $routeParams, $resource, API_PATH, Flash, $http) 
{
    var User;

    var vm = Object.assign(this, 
    {
        user: {},
        save : save,
        changePassword : changePassword,
        security : {
            password : '',
            password_confirmation : ''
        },
        api : {
            errors : {
                basic : {},
                security : {}
            }
        }            
    });
    (function run()
    {
        layout.init({
            section : {title : 'Edit user'},
            breadcrumb : {title: 'Edit user'},
            page : {className :'page-user-edit'},
        });

        User = $resource(API_PATH + '/user/:uid', {uid : $routeParams.id });

        vm.user = loadUser();
    })();

    function loadUser()
    {
        return User.get(
            function success(data){ layout.loading = false; },
            function error() {Flash.create('danger', '<strong>Not Found</strong>');}
        );
    }

    function save()
    {
        vm.user.$save(function success(){
            vm.api.errors.basic = {};
            Flash.create('success', '<strong>Successfully Saved!</strong>');
        }, function error(response){
            vm.api.errors.basic = response.data;
            Flash.create('danger', '<strong>Errors</strong>: Check the form')
        });
    }    

    function changePassword()
    {
        $http.post( API_PATH + '/destroy/' + $routeParams.pid, vm.security)
        .then(function success(){
            vm.api.errors.security = {};
            Flash.create('success', '<strong>Successfully Saved!</strong>');
        }, function error(response){
            vm.api.errors.security = response.data;
            Flash.create('danger', '<strong>Errors</strong>: Check the form')
        });
    }
});
