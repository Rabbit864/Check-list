<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckList;

class DetailingController extends Controller
{
    public function show(int $id){
        return view('detailing', [
            'checkList' => CheckList::select('name','id')->with('paragraphs')->find($id)
        ]);
    }
}
