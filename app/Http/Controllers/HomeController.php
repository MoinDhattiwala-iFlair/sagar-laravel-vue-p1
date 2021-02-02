<?php

namespace App\Http\Controllers;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function create()
    {

        return view('add');
    }

    public function storeUser(Request $request)
    {
        $password = \Hash::make($request->password);
        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
        );
        User::insert($data);
        return $data;
    }

    public function getUser(Request $request)
    {
        $users = User::all();
        return DataTables::of($users)->addColumn('action', function ($user) {
            return '<a href="edit_view/'.$user->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> <a href="delete/'.$user->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-delete"></i> Delete</a>';
        })->make(true);
    }

    public function deleteUser(Request $request, User $user,$id)
    {
        $delete = User::where('id',$id)->delete();

        if($delete)
        {
            return redirect()->back()->with('success', "Data Successfully Deleted.");
        }
        else
        {
            return redirect()->back()->with('error', "Please Try Again");
        }
    }

    public function editUser(Request $request, User $user)
    {
        // dd($user);
        // dd($request->all());
		// $data =User::where('id', $id)->first();
		$user->name = $request->name;
		$user->email = $request->email;
		$user->save();
		return $user;
    }

    public function edit_view(Request $request, $id){

        // $data =User::where('id', $id)->first();
        // $data->name = $request->get('val_1');
        // $data->email = $request->get('val_2');
        // // $data->save();
        // return $data;
        return view('edit');
    }

    public function fetchUser(User $user)
    {
		// $data =User::where('id', $id)->first();
		return $user;
    }

}
