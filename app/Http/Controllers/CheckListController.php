<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckList;
use App\Models\User;

class CheckListController extends Controller
{
    public function create(Request $request)
    {
        $checkList = CheckList::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->user()->id 
        ]);
        
        return redirect()->route('home');
    }
}
