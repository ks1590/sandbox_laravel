<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Imports\UsersImport;

class UsersController extends Controller
{
    public function export(){
	    // return Excel::download(new UsersExport, 'users.csv'); 
        // return Excel::download(new UsersExport, 'users.html');
        
        return (new UsersExport)->download('test.csv');
    }

    public function index(){
    	return view('index');
    }

    public function store(Request $request){
		$file = $request->file('file');
		Excel::import(new UsersImport, $file);
    }
}