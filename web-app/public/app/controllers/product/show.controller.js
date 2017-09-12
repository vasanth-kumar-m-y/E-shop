'use strict';

angular.module('app')
.controller('ProductShowController', function($location, Flash, auth, layout, API_PATH, $routeParams, $resource, $sce) 
{
    var vm = Object.assign(this, 
    {
        product : {},
        quantity : 1,
        total : total,
        buy : buy,
        canBuy : canBuy
    });
    (function run()
    {
        layout.loading = true;
        $.extend(true, layout, {
            section : {title : 'Product Page'},
            breadcrumb : {title: 'product'},
            page : {className :'page-product-show'}
        });

        loadProduct($routeParams.pid).$promise.then(function(){
            if(!vm.product.is_active){
                Flash.create('danger', 'Product is <strong>NOT active</strong>');
            }

            if(vm.product.seller_id == auth.getUser().id){
                Flash.create('info', 'You are the <strong>seller</strong> of this product');
            }
        })
    })();    


    function loadProduct(pid)
    {
        return $resource(API_PATH + '/product/:pid').get({pid : pid},
            function success(data){
                layout.loading = false;
                vm.product = data;
            }
        );
    }

    function total()
    {
        return (vm.product.price * vm.quantity).toFixed(2);
    }

    function buy()
    {
        layout.loading = true;

        var Buy = $resource(API_PATH + '/user/:uid/buy/:itemId', {
            uid : auth.getUser().id,
        });
        var buy = new Buy(
        {
            pid : vm.product.id,
            quantity : vm.quantity
        })
        buy.$save().then(function success()
        {
            layout.loading = false;
            Flash.create('success', '<strong>Bought!</strong>');  
            $location.url('/user/buys');
        }, function error(response)
        {
            layout.loading = false;

            var error = '';
            if(typeof response.data.pid != 'undefined'){
                error = response.data.pid;
            } else if (typeof response.data.quantity != 'undefined') {
                error = response.data.quantity;
            }

            Flash.create('danger', '<strong>Error: </strong>' + error);
        });
    }

    function canBuy()
    {
        return (vm.product.seller_id != auth.getUser().id) 
            && (vm.product.is_active)
    }
});
