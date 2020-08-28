<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
   
    /**
     * This methods redirects you to a new-product form
     * 
     * @param   void
     * @return  \Illuminate\View\View
     */
    public function createProduct()
    {
        return view ('product.createProduct');
    }

    /**
     * This store a new product on DB
     * 
     * @param   \Illuminate\Http\Request    $request
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function storeProduct(Request $request)
    {   
        Product::createProduct($request);
        
        return redirect()->route('userHome');
    }

    /**
     * This method edit an already saved product
     * 
     * @param   \Illuminate\Http\Request    $request
     * @return  @return  \Illuminate\Http\RedirectResponse
     */
    public function saveProduct(Request $request)
    {   

        Product::editProduct($request);
 
        return redirect()->route('userHome');
    }

    /**
     * This methods redircts you to a edit-form of a product
     * 
     * @param   \Illuminate\Http\Request    $request
     * @return  \Illuminate\View\View
     */
    public function editProduct(Request $request)
    {   

        $product = Product::find($request->id);

        return view ('product.editProduct', compact('product'));
    }

    /**
     * This method destrou a product from database
     * 
     * @param   \Illuminate\Http\Request
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function destroyProduct(Request $request)
    {
        $id = $request->id;
        $deleted = Product::destroyProduct($id);
        $request->session()->flash('mensagem',"O produto {$deleted} foi excluido com sucesso");

        $products = Product::listProduct(Auth::user()->id);
        return redirect()->route('userHome');        
    }

}