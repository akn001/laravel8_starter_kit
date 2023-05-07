<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\EditProfileRequest;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use Response;
use Auth;
use DataTables;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\User;
use Hash;

class HomeController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($role = null,$id = null)
    {
        $row = User::where('id',$id)->first();
         return view('admin.home',compact('row'));
        //return view('admin.home',[]);
    }

    public function adminProfile($id,$tab = ''){
        $row = User::where('id',$id)->first();
        return view('admin.profile',compact('row','tab'));
    }

    public function AdminChangePassword(EditProfileRequest $request,$id){
        $input = $request->all();//print_r($input);die;
        $data = [
            'password' => Hash::make($input['password'])
        ];
        $result = User::where('id', $id)->update($data);
        if(!empty($result)){
            return response()->json(['error'=>false,'msg'=>"Admin Password Updated!Please Login again with new password!"]);
            return redirect()->route('admin.profile');
        }else{
            return response()->json(['error'=>true,'msg'=>"Something went wrong"]);
            return redirect()->route('admin.profile');
        }
    }

    public function DoEditAdmin(StoreUserRequest $request,$id){
        //dd($id);
        $input = $request->all();//dd($input);
        $data = [
            'name' => $input['name'],
            'email' => $input['email'],
            'mobile' => $input['mobile'],
            'username' => $input['username']
        ];
        $result = User::where('id', $id)->update($data);
        if($request->hasFile('user_image'))
        {
            $image = $request->file('user_image');
            $imagePath = public_path('user_image');
            $imageName = md5(time().'_'.$image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();
            $image->move($imagePath,$imageName);
            $imageData = [
                'user_image'		=> $imageName
            ];
            User::where('id', $id)->update($imageData);
            if($input['hidden_image']!=''){
                unlink($imagePath.'/'.$input['hidden_image']);
            }
        }
        if(!empty($result)){
            return response()->json(['error'=>false,'msg'=>"Successfully Updated"]);
        }else{
            return response()->json(['error'=>true,'msg'=>"Something went wrong"]);
        }
    }
}
