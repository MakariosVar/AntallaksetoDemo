<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use App\Models\Profile;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($token, $type = null)
    {
        $user = User::authenticateByToken($token);
        if ($user && ($user->isAdmin() || $user->isModerator())) {
            if ($type === null) {
                // Return all reports
                $reports = Report::all();
            } else {
                // Return reports based on object_type
                $reports = Report::where('object_type', $type)
                    ->where(['deleted_at' => null])
                    ->get();
            }

            foreach ($reports as $report) {
                if ($report->object_type === Report::TYPE_POST) {
                    $report->post = Post::find($report->object_id);
                } elseif ($report->object_type === Report::TYPE_PROFILE) {
                    $report->profile = User::find($report->object_id);
                }
                $report->reporter = User::find($report->user_id);
            }
            $groupedReports = $reports->groupBy('object_id');
            // Returning reports with appropriate HTTP status code
            return response()->json([
                'status' => 'success',
                'data' => $groupedReports,
            ], 200); // 200 OK status code for successful response
        }
    
        // Return unauthorized access response
        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized access',
        ], 401); // 401 Unauthorized status code
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
            'object_id' => ['required', 'integer'],
            'object_type' => ['required', 'max:60'],
            'report_category' => ['required', 'max:60'],
            'other_text' => ['nullable', 'max:60'],
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422); // 422 Unprocessable Entity status code for validation errors
        }
    
        $report = Report::create($validator->validated());
        return response()->json([
            'status' => 'success',
            'data' => $report,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $token)
    {
        $user = User::authenticateByToken($token);
        $report = Report::find($id);

        if (!empty($report) &&$user && ($user->isAdmin() || $user->isModerator())) {
            if ($report->softDelete()) {

                return response()->json([
                    'status' => 'success',
                ], 200);
            }
        }

        // Return unauthorized access response
        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized access',
        ], 401); // 401 Unauthorized status code
    }
}
