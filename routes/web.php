<?php

use App\Http\Resources\ProductListResource;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.home.index', ["products" => ProductListResource::collection(Product::query()->orderBy('updated_at', 'desc')->paginate(8))->resolve()]);

});
