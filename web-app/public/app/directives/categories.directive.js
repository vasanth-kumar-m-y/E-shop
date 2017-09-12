angular.module('app').directive('categories',
function () {
    return {
        link: function (scope, element, attrs) 
        {
            console.log(scope.page);
            
            for(category in scope.page.product.categories)
            {
                $(element).append('<li>' + category.name + '</li>');
            }

        }
    };
});
