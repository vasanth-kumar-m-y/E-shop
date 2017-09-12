'use strict';

angular.module('app')
.controller('MainController', function(layout, $scope, $location)
{
    var vm = Object.assign(this, 
    {
        searchText : '',
        search : search
    });
    (function run()
    {
        
    })();    


    function search()
    {
        $location.url('/?search=' + vm.searchText);
    }

 });
