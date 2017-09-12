angular.module('app').factory('layout', function($document, auth, $location, Flash, $resource, API_PATH, $rootScope, $http) 
{
    var defaults = {};
    var service = {}; 

    (function init()
    {
        $rootScope.$on('layout.changePagination', onChangePagination);
        $rootScope.$watch('layout.pagination.currentPage', onChangePagination);
    })();

    return angular.copy(defaults = 
    {
        setDefaults : setDefaults,
        init : init,
        breadcrumb : {
            title : null
        },
        section : {
            title : ''
        },
        page : {
            className : ''
        },  
        logout: logout,
        loading : false,
        pagination : 
        {
            active: false,
            sortBy : null,
            sortOrder : null,
            currentPage : 1,
            totalItems : 1,
            items : [],
            changeSort : changeSort,
            fetchItems: fetchItems,
            resourceUrl : '',
            resourceData : {},
        },
        addToCart : addToCart,
        toggleActive : toggleActive,
        deleteProduct : deleteProduct,
        deleteUser : deleteUser,
        deleteCart : deleteCart,
        getProductImage : getProductImage
    }, service);


    function setDefaults()
    {
        angular.copy(defaults, this);
    }

    function init(config)
    {
        this.setDefaults();
        $.extend(true, this, config);
    }


    function logout()
    {
        auth.logout();

        Flash.create('info', '<strong>Bye!</strong> you are logged out');  

        $location.path('/auth/login');
    }


    function changeSort(sortBy, sortOrder)
    {
        this.sortBy = sortBy;
        this.sortOrder = sortOrder || 'asc';

        if(this.currentPage != 1){
            this.currentPage = 1;
        } else {
            $rootScope.$broadcast('layout.changePagination');
        }
    }

    function fetchItems()
    {
        service.loading = true;

        var data = {page: this.currentPage};
        if(this.sortBy) data.sort_by = this.sortBy;
        if(this.sortBy) data.sort_order = this.sortOrder;
        
        var queries = $location.search();
        if(typeof queries.search !== 'undefined') 
            data.search = queries.search;

        Object.assign(data, this.resourceData);

        $resource(API_PATH + this.resourceUrl).get(data,
            function(data){
                service.loading = false;

                service.pagination.items = data.items;
                service.pagination.totalItems = data.count;
                
                //scroll animate to top
                $document.scrollToElementAnimated($('body'), 0, 1000);
            }
        );
    }

    function onChangePagination()
    {
        if(service.pagination.active) 
            service.pagination.fetchItems();
    }

    function addToCart(item, quantity)
    {
        var Cart = $resource(API_PATH + '/user/:uid/cart/:cid', 
        {
            uid : auth.getUser().id, 
            cid : '@id' 
        });
        
        if(item.cart){
            item.cart = null;
            (new Cart()).$delete({cid: item.id});
            Flash.create('success', '<strong>Successfully Deleted From Cart!</strong>');
        } else {
            item.Cart = (new Date()).toISOString();
            total_price = quantity * item.price;
            (new Cart({pid : item.id, qty : quantity, total_price : total_price})).$save();
            Flash.create('success', '<strong>Successfully Added To Cart!</strong>');
        }
    }


    function toggleActive (item) 
    {
        var Product = $resource(API_PATH + '/product/:pid', {pid : item.id });

        if(item.is_active){
            item.is_active = false;
            (new Product({is_active : '0'})).$save({pid: item.id});            
        } else {
            item.is_active = true;
            (new Product({is_active : '1'})).$save({pid: item.id});
        }        
    }

    function deleteProduct(item)
    {
        $http.delete( API_PATH + '/product/' + item.id)
        .then(function success(){
            fetchItems();
            Flash.create('success', '<strong>Successfully Deleted!</strong>');
        }, function error(response){
            Flash.create('danger', '<strong>Errors</strong>: Check the form')
        });
    }

    function deleteUser(item)
    {
        $http.delete( API_PATH + '/user/' + item.id)
        .then(function success(){
            fetchItems();
            Flash.create('success', '<strong>Successfully Deleted!</strong>');
        }, function error(response){
            Flash.create('danger', '<strong>Errors</strong>: Check the form')
        });
    }

    function deleteCart(item)
    {
        $http.delete( API_PATH + '/user/' + item.id)
        .then(function success(){
            fetchItems();
            Flash.create('success', '<strong>Successfully Deleted!</strong>');
        }, function error(response){
            Flash.create('danger', '<strong>Errors</strong>: Check the form')
        });
    }


    function getProductImage(id)
    {
        return API_PATH + '/imgs/products/' + id + '.jpg';  
    }
});