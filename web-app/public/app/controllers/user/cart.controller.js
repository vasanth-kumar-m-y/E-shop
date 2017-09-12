'use strict';

angular.module('app')
.controller('UserCartController', function(layout, auth) 
{
    var vm = Object.assign(this, 
    {

    });
    (function run()
    {
        layout.init({
            section : {title : 'Your cart'},
            breadcrumb : {title: 'your carts'},
            page : {className :'page-user-cart'},
            pagination : {
                active : true,
                sortBy : 'starts',
                sortOrder : 'asc',
                resourceUrl : '/user/' + auth.getUser().id + '/cart',
            }
        });
        layout.pagination.fetchItems();
    })();
});
