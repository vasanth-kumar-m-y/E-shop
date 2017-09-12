'use strict';

angular.module('app')
.controller('ProductResultsController', function(layout, $resource, API_PATH, $scope) 
{
    var vm = Object.assign(this, 
    {

    });
    (function run()
    {
        layout.init({
            section : {title : 'Products'},
            breadcrumb : {title: 'products'},
            page : {className :'products'},
            pagination : {
                active : true,
                sortBy : 'starts',
                sortOrder : 'asc',
                resourceUrl : '/product',
            }
        });
        layout.pagination.fetchItems();
    })();
});
