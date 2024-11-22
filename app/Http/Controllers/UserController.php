<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;





use App\Models\User;
use DOMDocument;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use DataTables;


use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    
    public function index(Request $request)
    {
           $users = User::latest()->paginate(5);
       // $users = User::paginate($request->get('elements', 25));


        return view('back.users.index', compact('users'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'], 
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show1($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
           'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'], 
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }



    public function filter(Request $request)
    {
        $users = User::query();

        $last_name = $request->last_name;
        $email = $request->email;
        $bank_name = $request->bank_name;
        $address = $request->address;


        if ($last_name) {
            $users->where('last_name', 'LIKE', '%' . $last_name . '%');
        }
        if ($email) {
            $users->where('email', 'LIKE', '%' . $email . '%');
        }
        if ($bank_name) {
            $users->where('bank_name', 'LIKE', '%' . $bank_name . '%');
        }
        if ($address) {
            $users->where('address', 'LIKE', '%' . $address . '%');
        }



        $data = [

            'email' => $email,
            'name' => $last_name,
            'status'=> $bank_name,
            'address' => $address,

            'users' => $users->latest()->simplePaginate(5),
        ];

        return view('back.users.index', $data);
    }

    /* public function simple(Request $request)
    {
        $users= \DB::table('users');
        if (
            $request->input('search')
        ) {
            $users = $users->where('last_name', 'LIKE', "%" . $request->search . "%");
        }
        $users = $users->paginate(5);
        return view('back.users.index', compact('users'));
    }

    public function advance(Request $request)
    {
        $users = \DB::table('users');
        if ($request->last_name) {
            $users = $users->where('last_name', 'LIKE', "%" . $request->last_name . "%");
        }
        if ($request->address) {
            $users = $users->where('address', 'LIKE', "%" . $request->address . "%");
        }

        $users = $users->paginate(5);
        return view('back.users.index', compact('users'));
    } */

    public function changeStatus($user_id)
    {
        $user = User::find($user_id);

        if ($user) {
            if ($user->status) {
                $user->status = 0;
            } else {
                $user->status = 1;
            }
            $user->save();
        }

        return redirect()->back()
            ->with('success', 'Status updated successfully');
    }



    public function show($id)
    {
        $users = User::find($id);
        return view('back.users.show', compact('users'));
    }

    public function destroy1($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}