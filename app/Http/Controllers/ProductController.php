<?php

namespace App\Http\Controllers;

use App\Shops\Shopify;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Get the products
     *
     * @param Request request can contain the searchTitle or other parameters
     * @return Response json response with the products or an error. Include a HTTP Status code.
     */
    public function index(Request $request)
    {
        //Validate Request
        $filterParameters = $request->all();
        //Get the Shopify Products, catch/log exception
        $shopify = new Shopify();
        $shopifySDK = $shopify->getShopifySDK();

        $filterParameters = [
            'active'=>true,
            'limit' => 250,
            #More filter parameters
        ];
        $products = $shopifySDK->Product()->get($filterParameters);
        $filterRecord = [];
        if($filterParameters && $request->params['search']){
            foreach($products as $value){
                if(stripos($value['title'], $request->params['search']) !== FALSE){
                    $filterRecord[] = $value;
                }
            }
            return json_encode($filterRecord);
        }
        return json_encode($products);
    }
}
