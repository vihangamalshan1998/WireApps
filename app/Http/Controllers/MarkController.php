<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class MarkController extends Controller
{
    public function index()
    {
        try {
            $marks = Mark::all();
            return response()->json(['marks' => $marks]);
        } catch (Exception $th) {
            return response("Bad request. Please Try Again.", 400);
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $mark = new Mark();
            $mark->marks = $request->marks;
            $mark->user_id = $request->user_id;
            $mark->subject_id = $request->subject_id;
            $mark->save();
            DB::commit();
            return response()->json(['Mark' => $mark]);
        } catch (Exception $th) {
            DB::rollBack();
            return response("Bad request. Please Try Again.", 400);
        }
    }
    public function update(Request $request, Mark $mark)
    {
        try {
            DB::beginTransaction();
            $mark->marks = $request->marks;
            $mark->user_id = $request->user_id;
            $mark->subject_id = $request->subject_id;
            $mark->save();
            DB::commit();
            return response()->json(['Mark' => $mark]);
        } catch (Exception $th) {
            DB::rollBack();
            return response("Bad request. Please Try Again.", 400);
        }
    }
    public function destroy(Mark $mark)
    {
        try {
            $mark->delete();
            return response()->json(['Deleted']);
        } catch (Exception $th) {
            return response("Bad request. Please Try Again.", 400);
        }
    }
    public function getRank(Request $request)
    {
        try {
            $marks = Mark::where('subject_id', $request->subject_id)->orderBy('marks', 'desc')->with('user')->get();
            return response()->json(['marks' => $marks]);
        } catch (Exception $th) {
            return response("Bad request. Please Try Again.", 400);
        }
    }
}
