<?php

namespace App\Http\Controllers\Admin\Product;

use App\Category;
use App\Product;
use App\ProductBid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(){
        $table = Product::orderBy('created_at', 'DESC')->get();
        $category = Category::orderBy('name', 'ASC')->get();
        return view('admin.product.product')->with(['category' => $category,'table' => $table]);
    }

    public function save(Request $request){
        $table = new Product();
        $validate = $request->validate([
            'name' => 'required',
            'price' => 'required | min:0',
            'categoryID' => 'required',
            'imageName' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $table->name = $request->name;
        $table->price = $request->price;
        $table->description = $request->description;
        $table->specification = $request->specification;
        $table->categoryID = $request->categoryID;
        $table->productGroup = $request->productGroup;
        $table->productType = $request->productType;
        if($request->hasFile('imageName')){
            $fileName = md5(date('d-m-y H:i:s')).'.jpg';

            //############ 48X48 ###########
            $thumbs_sm = Image::make($request->file('imageName'));
            $thumbs_sm->resize(48, 48, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumbs_sm->resizeCanvas(48, 48, 'center', false, 'rgba(255, 255, 255, 255)');
            $imageStream_sm = $thumbs_sm->stream('jpg');

            Storage::disk('products')->put('sm_'.$fileName, $imageStream_sm->__toString());
            //############ 48X48 ###########

            //############ 64X64 ###########
            $thumbs_sm_o = Image::make($request->file('imageName'));
            $thumbs_sm_o->resize(64, 64, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumbs_sm_o->resizeCanvas(64, 64, 'center', false, 'rgba(255, 255, 255, 255)');
            $imageStream_sm_o = $thumbs_sm_o->stream('jpg');

            Storage::disk('products')->put('sx_'.$fileName, $imageStream_sm_o->__toString());
            //############ 64X64 ###########


            //############ 200X200 ###########
            $thumbs_md = Image::make($request->file('imageName'));

            $thumbs_md->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumbs_md->resizeCanvas(200, 200, 'center', false, 'rgba(255, 255, 255, 255)');

            $thumbs_md->text(config('naz.watermark'), 110, 195, function($font) {
                $font->file(public_path('/OpenSans-LightItalic.ttf'));
                $font->size(13);
                $font->color(array(255, 145, 145, 0.8));
                $font->align('center');
                $font->valign('bottom-right');
            });

            $imageStream_md = $thumbs_md->stream('jpg');

            Storage::disk('products')->put('md_'.$fileName, $imageStream_md->__toString());
            //############ 200X200 ###########


            //############ 512X512 ###########
            $thumbs_lg = Image::make($request->file('imageName'));

            $thumbs_lg->resize(512, 512, function ($constraint) {
                $constraint->aspectRatio();
            });

            $thumbs_lg->resizeCanvas(512, 512, 'center', false, 'rgba(255, 255, 255, 255)');

            $thumbs_lg->text(config('sp.watermark'), 350, 500, function($font) {
                $font->file(public_path('/OpenSans-LightItalic.ttf'));
                $font->size(20);
                $font->color(array(255, 145, 145, 0.8));
                $font->align('center');
                $font->valign('bottom-right');
            });

            $imageStream_lg = $thumbs_lg->stream('jpg');

            Storage::disk('products')->put($fileName, $imageStream_lg->__toString());
            //############ 512X512 ###########
            $table->imageName = $fileName;
        }
        $table->save();
        return redirect()->back()->with('success','Product added Successfully!!');
    }

    public function edit(Request $request){
        $table = Product::find($request->id);
        $validate = $request->validate([
            'name' => 'required',
            'price' => 'required | min:0',
            'categoryID' => 'required',
            'imageName' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $table->name = $request->name;
        $table->price = $request->price;
        $table->description = $request->description;
        $table->productGroup = $request->productGroup;
        $table->productType = $request->productType;
        $table->specification = $request->specification;
        $table->categoryID = $request->categoryID;

        if($request->hasFile('imageName')){

            // previous file delete
            $imagename = $table->imageName;
            $md = 'md_'.$imagename;
            $sm = 'sm_'.$imagename;
            $sx = 'sx_'.$imagename;
            // previous file delete
            $file = public_path('uploads/products/'.$table->imageName);
            $file1 = public_path('uploads/products/'.$md);
            $file2 = public_path('uploads/products/'.$sm);
            $file3 = public_path('uploads/products/'.$sx);
            File::delete($file);
            File::delete($file1);
            File::delete($file2);
            File::delete($file3);
            // previous file delete

            $fileName = md5(date('d-m-y H:i:s')).'.jpg';

            //############ 48X48 ###########
            $thumbs_sm = Image::make($request->file('imageName'));
            $thumbs_sm->resize(48, 48, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumbs_sm->resizeCanvas(48, 48, 'center', false, 'rgba(255, 255, 255, 255)');
            $imageStream_sm = $thumbs_sm->stream('jpg');

            Storage::disk('products')->put('sm_'.$fileName, $imageStream_sm->__toString());
            //############ 48X48 ###########

            //############ 64X64 ###########
            $thumbs_sm_o = Image::make($request->file('imageName'));
            $thumbs_sm_o->resize(64, 64, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumbs_sm_o->resizeCanvas(64, 64, 'center', false, 'rgba(255, 255, 255, 255)');
            $imageStream_sm_o = $thumbs_sm_o->stream('jpg');

            Storage::disk('products')->put('sx_'.$fileName, $imageStream_sm_o->__toString());
            //############ 64X64 ###########


            //############ 200X200 ###########
            $thumbs_md = Image::make($request->file('imageName'));

            $thumbs_md->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumbs_md->resizeCanvas(200, 200, 'center', false, 'rgba(255, 255, 255, 255)');

            $thumbs_md->text(config('sp.watermark'), 110, 195, function($font) {
                $font->file(public_path('/OpenSans-LightItalic.ttf'));
                $font->size(12);
                $font->color(array(255, 145, 145, 0.8));
                $font->align('center');
                $font->valign('bottom-right');
            });

            $imageStream_md = $thumbs_md->stream('jpg');

            Storage::disk('products')->put('md_'.$fileName, $imageStream_md->__toString());
            //############ 200X200 ###########


            //############ 512X512 ###########
            $thumbs_lg = Image::make($request->file('imageName'));

            $thumbs_lg->resize(512, 512, function ($constraint) {
                $constraint->aspectRatio();
            });

            $thumbs_lg->resizeCanvas(512, 512, 'center', false, 'rgba(255, 255, 255, 255)');

            $thumbs_lg->text(config('sp.watermark'), 350, 500, function($font) {
                $font->file(public_path('/OpenSans-LightItalic.ttf'));
                $font->size(20);
                $font->color(array(255, 145, 145, 0.8));
                $font->align('center');
                $font->valign('bottom-right');
            });

            $imageStream_lg = $thumbs_lg->stream('jpg');

            Storage::disk('products')->put($fileName, $imageStream_lg->__toString());
            //############ 512X512 ###########
            $table->imageName = $fileName;
        }
        $table->save();
        return redirect()->back()->with('success','Product edited Successfully!!');
    }

    public function del($id){
        $table = Product::find($id);

        // previous file delete
        $imagename = $table->imageName;
        $md = 'md_'.$imagename;
        $sm = 'sm_'.$imagename;
        $sx = 'sx_'.$imagename;
        // previous file delete
        $file = public_path('uploads/products/'.$table->imageName);
        $file1 = public_path('uploads/products/'.$md);
        $file2 = public_path('uploads/products/'.$sm);
        $file3 = public_path('uploads/products/'.$sx);
        File::delete($file);
        File::delete($file1);
        File::delete($file2);
        File::delete($file3);
        // previous file delete

        $table->delete();
        return redirect()->back()->with('success','Product deleted Successfully!!');
    }

    public function bidable($id){
        $table = Product::find($id);
        $table->isBidable = 'YES';
        $table->save();
        return redirect()->back()->with('success','Product biddable is ON Now!!');
    }

    public function allBiddle(){
        $table = Product::orderBy('created_at', 'DESC')->where('isBidable','YES')->get();
        return view('admin.product.productBidable')->with(['table' => $table]);
    }

    public function start_bid($id){
        $table = Product::find($id);
        $table->bidStatus = 'ON';
        $table->save();
        return redirect()->back()->with('success','Product Bid is start Now!!');

    }

    public function stop_bid($id){
        $table = Product::find($id);
        $table->bidStatus = 'OFF';
        $table->save();
        return redirect()->back()->with('success','Product biddable is Stop Now!!');

    }


}
