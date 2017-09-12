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
                    SignUp
                </li>
            </ol>
        </div>
    </div>
    <h1 class="section-title">
        SignUp
    </h1>


    <div class='col-md-4 col-md-offset-4'>

        <form>
            <div class="panel panel-default">
                <div class="panel-body">

                <h2>SignUp</h2>


                    <!-- username -->

                    <div class="form-group">
                        <label for="inputUsername">
                            Username
                        </label>
                            <input type="text" class="form-control" id="inputUsername" placeholder="username"/>
                    </div>

                    <!-- Email -->
                    
                    <div class="form-group">
                        <label for="inputEmail">
                                Email
                        </label>
                        <input  type="text" class="form-control" id="inputEmail" placeholder="Email"/>
                    </div> 

                    <!-- Password -->
                    
                    <div class="form-group">
                        <label for="inputPassword">
                                Password
                        </label>
                        <input  type="password" class="form-control" id="inputPassword" placeholder="Password"/>
                    </div> 

                    <!-- PasswordConfirm -->
                    
                    <div class="form-group">
                        <label for="inputPasswordConfirm">
                                Password Confirm
                        </label>
                        <input  type="passwordConfirm" class="form-control" id="inputPasswordConfirm" placeholder="PasswordConfirm"/>
                    </div> 

                    <div class="form-group submitBtn">
                          <button type="submit" class="btn btn-lg btn-warning">SignUp</button>
                    </div>

                </div>
            </div>

        </form>

    </div>

</div>

@endsection
