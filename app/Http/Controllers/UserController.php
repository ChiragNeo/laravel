<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Log;
use Yajra\DataTables\Datatables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('is-admin', ['only' => ['verification']]);
        $this->middleware('auth');
    }

    public function index()
    {
        // \DB::connection()->enableQueryLog();
        $users = User::where('is_verify','1');
        if(Auth::user()->user_type == 'manager'){
            $users->where('parent_id',Auth::user()->id);
        }
        $users->paginate(4);

        $queries = \DB::getQueryLog();

        // dd($queries);
        return view('user.index', compact('users'));
    }

    public function getPosts()
    {
        $objDT= new Datatables();
        $users = \DB::table('users')->select('*')->where('is_verify','1')->where('is_deleted','0');
        if(Auth::user()->user_type == 'manager'){
            $users = User::where('parent_id',Auth::user()->id);
        }
        return $objDT->of($users)        
        ->editColumn('user_type',function($users){
                return '<a href="user/view/'.$users->id.'" data-toggle="modal"  data-backdrop="static" data-keyboard="false" data-target= "#loginmodal" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon"></i> View</a>';
            })
            ->rawColumns(['user_type'])        
            ->make(true);
    }
    //activate/deactivate user

    public function activate(){
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $user = User::findOrFail($id);
        $formatedDate = date("d-m-Y",strtotime($user->dob));       
        return view('user/view', ['user' => $user,'formatedDate' => $formatedDate]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);        
        return view('user/edit', ['user' => $user]);
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
        $user = User::findOrFail($id);
        $newDate = date("Y-m-d",strtotime($request['dob']));
        $constraints = [
            'name' => 'required|max:20',
            'email'=> 'required|max:60',            
            ];
        $input = [
            'name' => $request['name'],
            'email' => $request['email'],
            'education' => $request['education'],
            'dob' => $newDate
        ];
        
        $this->validate($request, $constraints);
        User::where('id', $id)
            ->update($input);
        
        return redirect()->intended('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->intended('/user');
    }

    public function newuser()
    {        
        $users = User::where('is_verify', 0)->where('is_deleted',0)->paginate(10);
        return view('user.newuser', compact('users'));         
    }

    public function getPostdata()
    {
        $objDT= new Datatables();
        $users = \DB::table('users')->select('*')->where('is_verify','0')->where('is_deleted',0);
        
        return $objDT->of($users)        
        ->editColumn('education',function($users){
            return '<a href="/user/approve/'.$users->id.'"  class="btn btn-xs btn-primary"><i class="glyphicon glyphicon"></i> Verify</a>
            <a href="/user/validation/'.$users->id.'"  class="btn btn-xs btn-danger"><i class="glyphicon glyphicon"></i> Reject</a>';
        })
        ->rawColumns(['education'])        
        ->make(true);
    } 

    public function validation(Request $request,$id){
        
        $user = User::where('id',$id)->update(['is_deleted'=>'1']);
        
        return redirect()->intended('/user/newuser');
    }

    public function approve(){
        $id = $_POST['id'];
        $value = $_POST['value'];

        if($value == 1){
            $user = User::where('id',$id)->update(['is_verify'=> '1','is_deleted'=> '0']);
        }
        
        return json_encode(true);
        
        // return redirect()->intended('/user/newuser');
    }
    //to approve disabled users
    public function rejected(){
        $request = \DB::table('users')->select('*')->where('is_deleted',1)->paginate(4); 
           
        return view('user/rejected', compact('request'));
    }

    public function getPost()
    {
        $objDT= new Datatables();
        $request_user = \DB::table('users')->where('is_deleted',1);  
        
        return $objDT->of($request_user)        
        ->editColumn('education',function($request_user){             
            return '<button id ='. $request_user->id .' value="1" class="btn btn-xs btn-primary ActivateButton"><i class="glyphicon glyphicon-"></i> Approve</button>';
        })
        ->rawColumns(['education'])        
        ->make(true);
    }
}
