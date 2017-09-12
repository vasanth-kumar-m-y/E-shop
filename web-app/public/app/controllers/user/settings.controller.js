'use strict';

angular.module('app')
.controller('UserSettingsController', function(layout, auth, $resource, API_PATH, Flash, $http) 
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
            section : {title : 'Your settings'},
            breadcrumb : {title: 'your settings'},
            page : {className :'page-user-setting'},
        });

        User = $resource(API_PATH + '/user/:uid', {uid : auth.getUser().user.id });

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
        $http.post( API_PATH + '/destroy/' + auth.getUser().user.id, vm.security)
        .then(function success(){
            vm.api.errors.security = {};
            Flash.create('success', '<strong>Successfully Saved!</strong>');
        }, function error(response){
            vm.api.errors.security = response.data;
            Flash.create('danger', '<strong>Errors</strong>: Check the form')
        });
    }
});
