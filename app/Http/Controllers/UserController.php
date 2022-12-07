<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        if(Auth::user()->role!='admin'){
            return redirect(route('home'));
        }


         $rows =  User::orderBy('id','desc')->get();

         return view('users',compact('rows'));



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role!='admin'){
            return redirect(route('home'));
        }
        $studentstable =  DB::getSchemaBuilder()->getColumnListing('users');
        $row = [];
        foreach ($studentstable as $rowname) {
            $row[$rowname] = '';
        };
        // $rows[] = $row;
        $user = json_decode(json_encode($row));
        return view('adduser',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */




    public function store(Request $request)
    {
    //   return  $request->all();
    if(Auth::user()->role!='admin'){
        return redirect(route('home'));
    }
        $data = $request->except(['Photo','bank_check','password']);

        if($request->Photo){
            $data['Photo'] =   tmpToBase64($request->Photo, "photo/", 250, 300);
        }
        if($request->bank_check){
            $data['bank_check'] =   tmpToBase64($request->bank_check, "bank_check/");
        }
        if($request->password){
            $data['password'] =   hash::make($request->password);
        }else{
            $data['password'] =   hash::make('123456');

        }


        $data['email'] = time()."@gmail.com";



        $userCreate = User::create($data);

        return redirect(route('user.index'))->with('mess','New user added successfully completed');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Auth::user()->role!='admin'){
            return redirect(route('home'));
        }
        return view('adduser',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        if(Auth::user()->role!='admin'){
            return redirect(route('home'));
        }
            $data = $request->except(['Photo','bank_check','password']);

            if($request->Photo){
                $data['Photo'] =   tmpToBase64($request->Photo, "photo/", 300, 300);
            }
            if($request->bank_check){
                $data['bank_check'] =   tmpToBase64($request->bank_check, "bank_check/");
            }
            if($request->password){
                $data['password'] =   hash::make($request->password);
            }


            $userCreate = $user->update($data);

            return redirect(route('user.index'))->with('mess','User updated successfully completed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
    //   return  $user;
        $user->delete();
    }
}
