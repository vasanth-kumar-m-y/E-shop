'use strict';

angular.module('app')
.controller('UserAllController', function(layout, $resource, API_PATH, $scope) 
{
    var vm = Object.assign(this, 
    {

    });
    (function run()
    {
        layout.init({
            section : {title : 'Users'},
            breadcrumb : {title: 'users'},
            page : {className :'users'},
            pagination : {
                active : true,
                sortBy : 'starts',
                sortOrder : 'asc',
                resourceUrl : '/user/',
            }
        });
        layout.pagination.fetchItems();
    })();
});
