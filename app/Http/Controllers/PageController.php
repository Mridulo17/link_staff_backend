<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageAttachPost;
use Illuminate\Http\Request;

class PageController extends Controller
{ 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // page create method

        $request->validate([
            "page_name" => "required"
        ]);

        $page = Page::create([
            'page_name' => $request->page_name,
         ]);

        $res = 'Page created successfully.';
        return $res;
    }

    public function attach_post(Request $request, $id)
    { 
        // page attach post 
        
        $request->validate([
            "details" => "required"
        ]); 

        $post = PageAttachPost::create([
            'page_id' => $id,
            'details' => $request->details,
         ]); 

        $res = 'Page attached post successfully.';
        return $res;
    }
}
