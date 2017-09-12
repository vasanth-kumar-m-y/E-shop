<?php

namespace App\Http\Controllers;

class Mockup extends Controller
{

    // x
    public function getAutocompleteCategories(){
        return ['CategoryA','CategoryB', 'CategoryC', 'CategoryD', 'CategoryE', 'CategoryF', 'CategoryG'];
    }    

    // x
    public function getProductSearchResult(){
        return view('mockups.product-search-result');
    }

    // x
    public function getProductShow(){
        return view('mockups.product-show');
    }

    // x
    public function getProductEdit(){
        return view('mockups.product-edit');
    }

    public function getAuthLogin(){
        return view('mockups.auth-login');
    }

    public function getAuthSignup(){
        return view('mockups.auth-signup');
    }

    // x
    public function getUserSettings(){
        return view('mockups.user-settings');
    }

    public function getUserCart(){
        return view('mockups.user-cart');
    }

    public function getUserProducts(){
        return view('mockups.user-products');
    }
}
