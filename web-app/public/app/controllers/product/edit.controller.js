'use strict';

angular.module('app')
.controller('ProductEditController', function(layout, $routeParams, $resource, API_PATH, Flash) 
{
    var Product;

    var vm = Object.assign(this, 
    {
        product : {},
        save : save,
        api : {
            errors : {}
        }        
    });
    (function run()
    {
        layout.loading = true;
        layout.init({
            section : {title : 'Product Edit'},
            breadcrumb : {title: 'product'},
            page : {className :'page-product-edit'}            
        });

        Product = $resource(API_PATH + '/product/:pid', {pid : $routeParams.pid });

        vm.product = loadProduct();

    })();     

    function loadProduct()
    {
        return Product.get(
            function success(data){ layout.loading = false; },
            function error() {Flash.create('danger', '<strong>,Not Found</strong>');}
        );
    }

    function save()
    {
        vm.product.$save(function success(){
            vm.api.errors = {};
            Flash.create('success', '<strong>Successfully Saved!</strong>');
        }, function error(response){
            vm.api.errors = response.data;
            Flash.create('danger', '<strong>Errors</strong>: Check the form')
        });
    }

});
