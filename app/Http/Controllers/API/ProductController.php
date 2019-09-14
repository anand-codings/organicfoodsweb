<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;
use File;
use App\Category;
use App\Product;
use App\ProductImages;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    public function getProducts() {
        $data['products'] = Product::all();
        $success = $data;
        return Response::json(array('status' => 'success', 'successMessage' => 'List of Products', 'successData' => $success), 200, []);
    
    }
}
