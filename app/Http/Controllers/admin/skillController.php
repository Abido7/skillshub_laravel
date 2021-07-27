<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class skillController extends Controller
{
    public function skills()
    {
        $data['skills'] = Skill::orderBy("id", "DESC")->paginate(10);
        $data['cats'] = Cat::select('id', 'name')->get();
        return view('admin.skills.skills')->with($data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:100',
            'img' => 'required|image|max:2048',
            'cat_id' => 'required|exists:cats,id',
        ]);

        $imgPath = Storage::disk('uploads')->put('skills', $request->img);


        Skill::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'cat_id' => $request->cat_id,
            'img' => $imgPath
        ]);
        $request->session()->flash('msg', 'row added successfully');

        return back();
    }


    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'id' => 'required|exists:skills,id',
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:100',
            'cat_id' => 'required|exists:cats,id',
            'img' => 'nullable|image|max:2048',
        ]);

        $skill = Skill::findOrFail($request->id);
        $imgPath = $skill->img;

        if ($request->hasFile('img')) {
            unlink(public_path("/uploads/$imgPath"));
            $imgPath = Storage::disk('uploads')->put('skills', $request->img);
        }

        $skill->update([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ]),
            'cat_id' => $request->cat_id,
            'img' => $imgPath
        ]);
        $request->session()->flash('msg', 'row updated successfully');
        return back();
    }





    public function toggle(Skill $skill)
    {
        $skill->update([
            'active' => !$skill->active
        ]);
        return back();
    }

    //route model binding(Skill $skill)
    public function delete(Skill $skill)
    {
        try {

            $imgPath = $skill->img;
            $skill->delete();
            unlink(public_path("/uploads/$imgPath"));
            $msg = "row deleted successfully";
        } catch (\Throwable $th) {
            $msg = "can't delete this row";
        }
        session()->flash('msg', $msg);
        return back();
    }
}