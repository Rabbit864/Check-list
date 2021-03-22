<?php

namespace App\Http\Controllers;

use App\Models\SubParagraph;
use Illuminate\Http\Request;

class SubParagraphController extends Controller
{
    public function create(Request $request)
    {
        $subparagraph = SubParagraph::create([
            'name' => $request->name,
            'paragraph_id' => $request->paragraph_id,
            'status' => 0
        ]);

        return $subparagraph;
    }

    public function updateStatus(Request $request,SubParagraph $subParagraph){
        $request->status ? $subParagraph->status = 1 : $subParagraph->status = 0;
        $subParagraph->save();
    }
}
