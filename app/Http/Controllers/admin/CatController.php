<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use Illuminate\Http\Request;

use function Symfony\Component\String\b;

class CatController extends Controller
{
    public function cats()
    {
        $data['cats'] = Cat::orderBy("id", "DESC")->paginate(3);
        return view('admin.cats.cats')->with($data);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:100',
        ]);

        Cat::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ])
        ]);
        $request->session()->flash('msg', 'row added successfully');

        return back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:cats,id',
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:100',
        ]);

        Cat::findOrFail($request->id)->update([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ])
        ]);
        $request->session()->flash('msg', 'row updated successfully');
        return back();
    }

    public function toggle(Cat $cat)
    {
        $cat->update([
            'active' => !$cat->active
        ]);
        return back();
    }

    //route model binding(Cat $cat)
    public function delete(Cat $cat)
    {
        try {
            $cat->delete();
            $msg = "row deleted successfully";
        } catch (\Throwable $th) {
            $msg = "can't delete this row";
        }
        session()->flash('msg', $msg);
        return back();
    }
}