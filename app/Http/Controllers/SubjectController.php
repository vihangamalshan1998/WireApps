<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function index()
    {
        try {
            if (Auth::check()) {
                if (auth()->user()->type == 'admin') {
                    $subjects = Subject::with('marks')->with('assignments')->get();
                } else {
                    $subjects = Subject::with('marks')->with('assignments')->where('class', auth()->user()->class)->get();
                }
            } else {
                $subjects = Subject::all();
            }
            return response()->json(['subjects' => $subjects]);
        } catch (Exception $th) {
            return response("Bad request. Please Try Again.", 400);
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $subject = new Subject();
            $subject->name = $request->name;
            $subject->class = $request->class;
            $subject->save();
            DB::commit();
            return response()->json(['Subject' => $subject]);
        } catch (Exception $th) {
            DB::rollBack();
            return response("Bad request. Please Try Again.", 400);
        }
    }
    public function update(Request $request, Subject $subject)
    {
        try {
            DB::beginTransaction();
            $subject->name = $request->name;
            $subject->class = $request->class;
            $subject->save();
            DB::commit();
            return response()->json(['Subject' => $subject]);
        } catch (Exception $th) {
            DB::rollBack();
            return response("Bad request. Please Try Again.", 400);
        }
    }
    public function destroy(Subject $subject)
    {
        try {
            $subject->delete();
            return response()->json(['Deleted']);
        } catch (Exception $th) {
            return response("Bad request. Please Try Again.", 400);
        }
    }
}
