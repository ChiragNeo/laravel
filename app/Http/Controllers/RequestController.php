<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;
use App\Request as Requests;
use Log;
use App\User;
use Auth;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = \DB::table('request')->select('*')->paginate(4);        
        return view('request.index', compact('request'));
    }
// THis is for index page
    public function getPosts()
    {
        $objDT= new Datatables();
        $request_user = \DB::table('request')       
           ->join('users', 'users.id', '=', 'request.user_id') 
           ->where('request.parent_id','=',Auth::user()->id)                    
            ->select(['users.name', 'request.id','request.fields', 'request.status','request.user_id','request.parent_id']);
            if(Auth::user()->user_type == 'supervisor'){
                $request_user->where('users.id',Auth::user()->id);
            }
        return $objDT->of($request_user)   
            
        ->editColumn('fields',function($request_user){
            if($request_user->status == 'Approved'){
                return '<a href="request/'.$request_user->id.'"  class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-pen"></i> View</a>';
            }else{
                return '<a href="request/'.$request_user->id.'/edit"  class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-pen"></i> Edit</a>';
            }
        })
        ->rawColumns(['fields'])        
        ->make(true);
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('request/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->fields.':'.$request->field_name;
         Requests::create([
            'fields' => $data,
            'user_id' => Auth::user()->id,
            'parent_id' => Auth::user()->parent_id,
            'status' => 'Pending',
        ]);
        return redirect('/request');
    }
      
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $req_data = Requests::findOrFail($id);
        $data = explode(':',$req_data->fields);
        
        return view('request/show', ['req_data' => $req_data,'data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $req_data = Requests::findOrFail($id);
        $data = explode(':',$req_data->fields);        
        
        return view('request/edit', ['req_data' => $req_data,'data' => $data]);
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
        // $user = User::findOrFail($id);
        $request_data = Requests::findOrFail($id);
        $data = explode(':',$request_data->fields);
        $input1 = [            
            'status' => 'Approved',            
        ];
        $input = [
            "$data[1]" => $request->fields,            
        ];
        // $this->validate($request, $constraints);
        Requests::where('id', $id)
            ->update($input1);
        User::where('id',$request_data->user_id)
            ->update($input);    
            
        return redirect()->intended('/request');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    { 
        $user = Requests::where('user_id',$id)->update(['status'=>'Approved']);
       
        return redirect()->intended('request/rejected');
    }

}
