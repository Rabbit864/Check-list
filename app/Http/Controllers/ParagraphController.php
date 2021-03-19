<?php

namespace App\Http\Controllers;

use App\Models\CheckList;
use App\Models\Paragraph;
use Illuminate\Http\Request;

class ParagraphController extends Controller
{
    public function create(Request $request,CheckList $checkList){
        Paragraph::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 0,
            'check_list_id' => $checkList->id
        ]);
        return redirect()->route('detailing',$checkList->id);
    }

    public function updateStatus(Request $request,Paragraph $paragraph){
        $request->status ? $paragraph->status = 1 : $paragraph->status = 0;
        $paragraph->save();
    }
}
