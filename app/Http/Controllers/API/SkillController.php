<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function show($id)
    {
        $skill = Skill::with('exams')->find($id);
        if ($skill !== null) {
            return new SkillResource($skill);
        } else {
            return response()->json(["msg", "category not found"], 404);
        }
    }
}