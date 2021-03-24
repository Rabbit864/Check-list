<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckList;
use App\Models\User;
use App\Http\Requests\CreateCheckListRequest;
use App\Http\Requests\UpdateCheckListRequest;

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

    public function update(UpdateCheckListRequest $request, CheckList $checkList)
    {
        $checkList->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return redirect()->route('home');
    }

    public function destroy(CheckList $checkList)
    {
        $checkList->delete();
        return redirect()->route('home');
    }
}
