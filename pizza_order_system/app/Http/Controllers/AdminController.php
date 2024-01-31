<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
     //change Password dPage
    public function changePasswordPage(){
        return view('admin.account.change');
    }
    //changePassword
    public function changePassword(Request $request){
        /*
            1 all field must be fill
            2  new password and comfim pw must be greater than 6
            3 new password and comfim pw must be same
            4 client old pw must be same with db password
            5 password change

        */

        $this->passwordValidationCheck($request);

        $currentId= Auth::user()->id;

        $user =User::select('password')->where("id",$currentId)->first();
        $dbHashValue = $user->password;

        if(Hash::check($request->oldPassword ,$dbHashValue)){
            $data = [
                'password'=>Hash::make($request->newPassword)
           ] ;
            User::where('id',Auth::user()->id)->update($data);
            // Auth::logout();
            // return redirect()->route('auth#loginPage');

            return redirect()->route('category#list')->with(['pwChangeSuccess'=>"Password Change Success. "]);
        }
        return back()->with(['notMatch'=>"The old Password not match try again. "]);

    }

    //profile detail
    public function details(){
        return view('admin.account.details');
    }
    //profile edit
    public function edit(){
       $id = Auth::user()->id;
        // dd($id);
        return view('admin.account.edit');
    }
    //profile update
    public function update($id,Request $request){
       $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //image
        if($request->hasFile('image')){
            //1 old image name | 2. check =>if exist ,  delete | 3. store
            $dbUser= User::where('id',$id)->first();
            $dbImage= $dbUser->image;

            //to keep the name for store(get the file name)
            $fileName= uniqid().$request->file('image')->getClientOriginalName();
            // actually store in frontend
            $request->file('image')->storeAs('public',$fileName);
            //db store
            $data['image'] = $fileName;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }



        }

      User::where('id',$id)->update($data);

        return redirect()->route('admin#details')->with(['updateSuccess'=>"Update Profile Success"]);
    }

    //password Validation Check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>"required|min:6",
            'newPassword'=>"required|min:6",
            'confirmPassword'=>"required|min:6|same:newPassword"
        ])->validate();
    }
    //request user data
    private function getUserData($request){
        return [
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'address'=>$request->address,
            'gender'=>$request->gender,
            'created_at'=>Carbon::now()
        ];
    }
    //account Validation Check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>"required|min:3",
            'phone'=>"required|min:3",
            'email'=>"required|min:3",
            'address'=>"required|min:3",
            'image'=>"mimes:png,jpeg,jpg,svg|file",

        ])->validate();
    }
}
