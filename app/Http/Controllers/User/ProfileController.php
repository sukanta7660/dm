<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $table = Order::orderBy('created_at','DESC')->where('userID',Auth::user()->id)->paginate(15);
        return view('user.profile')->with(['table' => $table]);
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'contactNo' => 'required',
            'address' => 'required',
            'email' => 'required | email',
            'imageName' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $table = User::find($request->id);
        $table->name = $request->name;
        $table->address = $request->address;
        $table->contactNo = $request->contactNo;
        $table->email = $request->email;

        //image upload
        if ($request->hasFile('imageName')) {

            // // previous file delete
            // $file = public_path('uploads/profile/'.$table->imageName);
            // if(file_exists($file)){
            //     unlink($file);
            // }
            // // previous file delete

            $extension = $request->imageName->extension();
            $filename =  md5(date('Y-m-d H:i:s'));
            $filename = $filename.'.'.$extension;
            $table->imageName = $filename;
            $request->imageName->move('public/uploads/profile',$filename);
        }
        $table->save();

        return redirect()->back()->with('message','Profile Updated Successfully.');
    }

    public function change_pass(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'same:new_password'
        ]);
        $table = User::find($request->id);

        $main_pass = $table->password;
        $old = $request->current_password;
        $new = $request->new_password;

        if(Hash::check($old, $main_pass)){
            $table->password = Hash::make($new);
            $table->update();
        }else{
            return redirect()->back()->with('error','Old password not correct. Enter a correct password.');
        }
        $table->save();

        return redirect()->back()->with('message','Password changed Successfully.');
    }
}
