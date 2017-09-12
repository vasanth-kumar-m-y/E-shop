@extends('mockups.layout')

@section('content')

<div id="product-edit">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        Home
                    </a>
                </li>
                <li class="active">
                    User Settings
                </li>
            </ol>
        </div>
    </div>
    <h1 class="section-title">
        User Settings
    </h1>


    <div class='col-md-10 col-md-offset-1'>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">
                    Basic
                </a>
            </li>
            <li role="presentation">
                <a href="#password" aria-controls="more" role="tab" data-toggle="tab">
                    Password
                </a>
            </li>
        </ul>

        <form class="form-horizontal">

            <!-- Tab panes -->
            <div class="tab-content">

                <!-- panel basic -->

                <div role="tabpanel" class="tab-pane active" id="basic">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <h2 class="col-sm-offset-1 form-title">
                                User Settings
                            </h2>

                            <!-- username -->

                            <div class="form-group">
                                <label for="inputUsername" class="col-sm-2 control-label">
                                    Username
                                </label>
                                <div class="col-sm-9">
                                    <input readonly="readonly" type="text" class="form-control" id="inputUsername" placeholder="username"/>
                                </div>
                            </div>

                            <!-- first Name -->
                            
                            <div class="form-group">
                                <label for="inputFirstName" class="col-sm-2 control-label">
                                    First Name
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputFirstName" placeholder="First Name"/>
                                </div>
                            </div>                    

                            <!-- Second Name -->
                            
                            <div class="form-group">
                                <label for="inputSecondName" class="col-sm-2 control-label">
                                    Second Name
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputSecondName" placeholder="Second Name"/>
                                </div>
                            </div> 

                            <!-- Email -->
                            
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">
                                        Email
                                </label>
                                <div class="col-sm-9">
                                    <input  type="text" class="form-control" id="inputEmail" placeholder="Email"/>
                                </div>
                            </div> 

                            <!-- Phone -->
                            
                            <div class="form-group">
                                <label for="inputPhone" class="col-sm-2 control-label">
                                        Phone
                                </label>
                                <div class="col-sm-9">
                                    <input  type="text" class="form-control" id="inputPhone" placeholder="Phone"/>
                                </div>
                            </div> 


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-lg btn-primary">Save</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- panel more -->

                <div role="tabpanel" class="tab-pane" id="password">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h2 class="col-sm-offset-1 form-title">
                                Change Password
                            </h2>

                            <!-- Password -->
                            
                            <div class="form-group">
                                <label for="inputPassword" class="col-sm-2 control-label">
                                        Password
                                </label>
                                <div class="col-sm-9">
                                    <input  type="password" class="form-control" id="inputPassword" placeholder="Password"/>
                                </div>
                            </div> 

                            <!-- PasswordConfirm -->
                            
                            <div class="form-group">
                                <label for="inputPasswordConfirm" class="col-sm-2 control-label">
                                        Password Confirm
                                </label>
                                <div class="col-sm-9">
                                    <input  type="passwordConfirm" class="form-control" id="inputPasswordConfirm" placeholder="PasswordConfirm"/>
                                </div>
                            </div> 

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-lg btn-primary">Change Password</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- end panel more -->
            </div>

        </form>

    </div>

</div>

@endsection
