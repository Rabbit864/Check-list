<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckList;
use App\Models\User;
use App\Http\Requests\CreateCheckListRequest;

class CheckListController extends Controller
{
    public function create(CreateCheckListRequest $request)
    {
        $checkList = CheckList::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('home');
    }
}
