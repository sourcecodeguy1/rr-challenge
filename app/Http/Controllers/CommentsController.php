<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests;

//use App\Comments;

use Illuminate\Support\Facades\DB as DB;

class CommentsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod('post')){
            $first_name = $request->first_name;
            $email = $request->email;
            $message = $request->message;

            $add = DB::table('comments')->insert([
               'first_name' => $first_name,
                'email' => $email,
                'message' => $message
            ]);

            if($add){
               return response()->json([
                    'message' => 'Data saved!'
                ]);
            } else {
               return response()->json([
                    'message' => 'Data not saved!'
                ]);
            }

        }

    }


}
