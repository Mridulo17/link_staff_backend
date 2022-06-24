<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\PersonAttachPost;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attach_post(Request $request)
    {   
        // person create post

        $request->validate([
            "details" => "required"
        ]);

        $id = auth()->user()->id; 
        $post = PersonAttachPost::create([
            'person_id' => $id,
            'details' => $request->details,
         ]); 
        $res = 'Person attached post successfully.';
        return $res;
    }
}
