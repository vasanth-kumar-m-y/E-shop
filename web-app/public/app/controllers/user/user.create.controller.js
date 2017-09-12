'use strict';

angular.module('app')
.controller('UserCreateController', function(layout, $routeParams, $resource, API_PATH, Flash, $http) 
{

    var vm = Object.assign(this, 
    {
        inputs : {
            title : '',
            subtitle : '',
            description : '',
            price : '',
            stock_available : '',
            starts : '',
            ends : '',
        },
        store : store,    
        api : {
            errors : {}
        }        
    });

    (function run()
    {
        layout.loading = true;
        layout.init({
            section : {title : 'User Create'},
            breadcrumb : {title: 'user'},
            page : {className :'page-user-create'}            
        });
    })();     



    function store()
    {
        $http({
            method: 'POST',
            url: API_PATH + '/user/',
            data : {
                user:vm.inputs
            }
        })
        .then(function success(){
            Flash.create('success', '<strong>Successfully Created!</strong>');
        }, function error(response){
            Flash.create('danger', '<strong>Errors</strong>: Check the form')
        });
    }

});
