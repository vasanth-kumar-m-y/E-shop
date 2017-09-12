angular.module('app').factory('auth', function($cookies, $http, API_PATH, $q, $resource) {
    return {
        isLogged : isLogged,
        getUser : getUser,
        logout : logout,
        lightLogout : lightLogout,
        attempt : attempt,
        signup : signup,
    };

    function isLogged()
    {
        return !!getUser();
    }

    function getUser() 
    {
        return $cookies.getObject('auth-user');
    }

    function logout() 
    {
        $cookies.remove('auth-user');

        return $http({
            method: 'POST',
            url: API_PATH + '/auth/logout'
        });
    }

    function lightLogout()
    {
        $cookies.remove('auth-user');
    }

    function attempt(loginId, password)
    {
        var deferred = $q.defer();

        this.lightLogout();

        $http({
            method: 'POST',
            url: API_PATH + '/auth/login',
            data : {
                login_id : loginId,
                password : password
            }
        })
        .then(_loginSuccess, _loginError);

        return deferred.promise;


        function _loginSuccess(response)
        {   
            var user = response.data;

            _saveUserInCookie(user);

            deferred.resolve(user);
        }

        function _loginError(response)
        {
            deferred.reject(response);
        }
    }


    function _saveUserInCookie(user)
    {
         //store user logged for 3 hours
        var options = {expires: new Date()};
        options.expires.setHours((new Date()).getHours() + 3);

        $cookies.putObject('auth-user', user, options );
    }

    function signup(data)
    {
        var User = $resource( API_PATH + '/user/' );
        var user = new User(data);
        return user.$save(_signupSuccess);

        function _signupSuccess(user)
        {
            _saveUserInCookie(user);
        }
    }
});