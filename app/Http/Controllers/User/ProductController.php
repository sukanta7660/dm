<?php

namespace App\Http\Controllers\User;

use App\Product;
use App\Category;
use App\ProductBid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Exists;

class ProductController extends Controller
{
    public function index(){
        $category = Category::orderBy('name','ASC')->get();
        return view('user.product')->with(['category' => $category]);
    }

    // all product
    public function all_product(){
        $table = Product::orderBy('name', 'ASC')->get();
        $data=[];
        foreach ($table as $row){
            $rowData['productID'] = $row->productID;
            $rowData['name'] = $row->name;
            $rowData['imageName'] = $row->imageName;
            $rowData['categoryID'] = $row->categoryID;
            $rowData['price1'] = money($row->price);
            $rowData['price'] = $row->price;
            $rowData['productGroup'] = $row->productGroup;
            $rowData['description'] = $row->description;
            $rowData['specification'] = $row->specification;
            $data[] = $rowData;
        }

        return response()->json($data);
    }
    // all product

//    Category Wise
    public function cat_wise_product($id){
        $table = Product::orderBy('name', 'ASC')->where('categoryID',$id)->get();
        $data=[];
        foreach ($table as $row){
            $rowData['productID'] = $row->productID;
            $rowData['name'] = $row->name;
            $rowData['imageName'] = $row->imageName;
            $rowData['categoryID'] = $row->categoryID;
            $rowData['price'] = $row->price;
            $rowData['description'] = $row->description;
            $rowData['specification'] = $row->specification;
            $data[] = $rowData;
        }

        return response()->json($data);
    }
    //    Category Wise


    public function itemSearch(Request $request){
        $search = $request->search;
        $table = Product::orderBy('name', 'ASC')->search($search)->get();
        $data=[];
        foreach ($table as $row){
            $rowData['productID'] = $row->productID;
            $rowData['name'] = $row->name;
            $rowData['imageName'] = $row->imageName;
            $rowData['categoryID'] = $row->categoryID;
            $rowData['price'] = $row->price;
            $rowData['description'] = $row->description;
            $rowData['specification'] = $row->specification;
            $data[] = $rowData;
        }
        return response()->json($data);
    }


    public function single_product($id){
        $table = Product::find($id);
        return view('user.product_details')->with(['table' => $table]);
    }


    public function bid(){
        $table = Product::orderBy('created_at', 'DESC')->where('isBidable','YES')->get();
        return view('user.allbid')->with(['table' => $table]);
    }

    public function single_bid($id){
        $table = Product::find($id);
        $bider = ProductBid::orderBy('created_at','DESC')->where('productID',$id)->paginate(10);
        return view('user.bid_page')->with(['table' => $table,'bider' => $bider]);
    }

    public function bid_save(Request $request){
        $product = Product::find($request->productID);
        $isExist = ProductBid::where('productID',$request->productID)->count();
        $maxVal = ProductBid::where('productID',$request->productID)->max('price');
        if($isExist > 0){
            if($request->price > $maxVal){
                $table = new ProductBid();
                $table->price = $request->price;
                $table->userID = $request->userID;
                $table->productID = $request->productID;
                $table->save();
            }else{
                return redirect()->back()->with('error','Please give a price that greater than others!! ');
          }
        }else{
            if($request->price > $product->price){
                $table = new ProductBid();
                $table->price = $request->price;
                $table->userID = $request->userID;
                $table->productID = $request->productID;
                $table->save();
            }else{
                return redirect()->back()->with('error','Please check you give a price with is greater than product price And Check you give the maximum price than others!! ');
            }
        }

        return redirect()->back()->with('success','Success!!');
    }

}
