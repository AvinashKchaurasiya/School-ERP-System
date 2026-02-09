<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\IAdminRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct(private IAdminRepository $adminRepository)
    {
    }
    // login page
    public function adminLogin(){
        return view('admin.admin-login');
    }

    // register page
    public function adminRegister(){
        return view('admin.admin-register');
    }

    // register process 
    public function adminRegisterProcess(Request $request){
        try{
            $validate = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:5',
                'password_confirmation' => 'required|same:password',
            ]);
            
            if($validate->fails()){
                return redirect()->back()->with('error', $validate->errors()->first());
            }

            $data = $this->adminRepository->adminRegisterProcess($request->all());

            return redirect()->route('admin.login')->with('success', 'Admin created successfully');

        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // login process
    public function adminLoginProcess(Request $request){
        try{
            $validate = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
            if($validate->fails()){
                return redirect()->back()->with('error', $validate->errors()->first());
            }

            $data = $this->adminRepository->adminLoginProcess($request->all());
            return redirect()->route('admin.dashboard')->with('success', 'Admin logged in successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
