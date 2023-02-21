<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response("Bad request. Please verify email and password.", 400);
        }
        $user = User::where('email', $request->email)->where('active', 1)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response("These credentials do not match our records", 401);
        }
        $token = $user->createToken('API Token')->plainTextToken;
        $user->remember_token = $token;
        $user->save();
        return response()->json([$token]);
    }

    public function register(Request $request)
    {
        try {
            DB::beginTransaction();
            if (auth()->user()->type == 'admin') {
                $user = new User();
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $user->password = Hash::make('secret');
                switch ($request->type) {
                    case 'teacher':
                        $user->type = User::TYPE_TEACHER;
                        $user->dob = $request->dob;
                        $user->qualification = $request->qualification;
                        $user->subject = $request->subject;
                        $user->class = $request->class;
                        break;

                    case 'student':
                        $user->type = User::TYPE_STUDENT;
                        $user->subject = $request->subject;
                        $user->class = $request->class;
                        break;

                    default:
                        $user->type = User::TYPE_USER;
                        break;
                }
                $user->save();
                DB::commit();
                return response()->json(['User' => $user]);
            } else {
                return response("Unauthorized.", 401);
            }
        } catch (Exception $th) {
            DB::rollBack();
            return response("Bad request. Please Try Again.", 400);
        }
    }
    public function activeUser(Request $request)
    {
        try {
            DB::beginTransaction();
            if (auth()->user()->type == 'admin') {
                $user = User::where('email', $request->email)->first();
                $user->active = 1;
                $user->save();
                DB::commit();
                return response()->json(['User' => $user]);
            } else {
                return response("Unauthorized.", 401);
            }
        } catch (Exception $th) {
            DB::rollBack();
            return response("Bad request. Please Try Again.", 400);
        }
    }
    public function deactiveUser(Request $request)
    {
        try {
            DB::beginTransaction();
            if (auth()->user()->type == 'admin') {
                $user = User::where('email', $request->email)->first();
                $user->active = 0;
                $user->save();
                DB::commit();
                return response()->json(['User' => $user]);
            } else {
                return response("Unauthorized.", 401);
            }
        } catch (Exception $th) {
            DB::rollBack();
            return response("Bad request. Please Try Again.", 400);
        }
    }
    public function getStudent()
    {
        try {
            DB::beginTransaction();
            if (auth()->user()->type == 'teacher') {
                $students = User::where('class', auth()->user()->class)->get();
                return response()->json(['students' => $students]);
            } else {
                return response("Unauthorized.", 401);
            }
        } catch (Exception $th) {
            DB::rollBack();
            return response("Bad request. Please Try Again.", 400);
        }
    }
}
