<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    public function index()
    {
        try {
            $assignments = Assignment::all();
            return response()->json(['assignments' => $assignments]);
        } catch (Exception $th) {
            return response("Bad request. Please Try Again.", 400);
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $assignment = new Assignment();
            $assignment->name = $request->name;
            $assignment->subject_id = $request->subject_id;
            $assignment->save();
            DB::commit();
            return response()->json(['Assignment' => $assignment]);
        } catch (Exception $th) {
            DB::rollBack();
            return response("Bad request. Please Try Again.", 400);
        }
    }
    public function update(Request $request, Assignment $assignment)
    {
        try {
            DB::beginTransaction();
            $assignment->name = $request->name;
            $assignment->subject_id = $request->subject_id;
            $assignment->save();
            DB::commit();
            return response()->json(['Assignment' => $assignment]);
        } catch (Exception $th) {
            DB::rollBack();
            return response("Bad request. Please Try Again.", 400);
        }
    }
    public function destroy(Assignment $assignment)
    {
        try {
            $assignment->delete();
            return response()->json(['Deleted']);
        } catch (Exception $th) {
            return response("Bad request. Please Try Again.", 400);
        }
    }
}
