'use strict';

angular.module('app')
.controller('ProductCreateController', function(layout, $routeParams, $resource, API_PATH, Flash, $http) 
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
            section : {title : 'Product Create'},
            breadcrumb : {title: 'product'},
            page : {className :'page-product-create'}            
        });
    })();     



    function store()
    {
        $http({
            method: 'POST',
            url: API_PATH + '/product/',
            data : {
                product:vm.inputs
            }
        })
        .then(function success(){
            Flash.create('success', '<strong>Successfully Created!</strong>');
        }, function error(response){
            Flash.create('danger', '<strong>Errors</strong>: Check the form')
        });
    }

});
