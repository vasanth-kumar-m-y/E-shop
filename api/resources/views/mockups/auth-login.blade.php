@extends('mockups.layout')

@section('content')

<div id="auth-login">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        Home
                    </a>
                </li>
                <li class="active">
                    Login
                </li>
            </ol>
        </div>
    </div>
    <h1 class="section-title">
        Login
    </h1>


    <div class='col-md-4 col-md-offset-4'>

        <form>
            <div class="panel panel-default">
                <div class="panel-body">

                <h2>Login</h2>
                    <!-- username / email -->

                    <div class="form-group">
                        <label for="inputId">
                            Username
                        </label>
                        <input type="text" class="form-control" id="inputId" placeholder="username or email"/>
                    </div>         

                    <!-- Password -->
                    
                    <div class="form-group">
                        <label for="inputPassword">
                                Password
                        </label>
                        <input  type="password" class="form-control" id="inputPassword" placeholder="Password"/>
                    </div> 

                    <div class="form-group submitBtn">
                          <button type="submit" class="btn btn-lg btn-warning">SignUp</button>
                          <button type="submit" class="btn btn-lg btn-primary">Log In</button>
                    </div>

                </div>
            </div>

        </form>

    </div>

</div>

@endsection
