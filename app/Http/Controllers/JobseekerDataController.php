<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class JobseekerDataController extends Controller
{
    public function index()
    { //Dashboard Function
        return view('pages/dashboard');
    }

    // Common function to handle cURL requests
    private function makeCurlRequest($url, $params = [])
    {
        $response = Http::get($url, $params);
        if ($response->successful()) {
            return $response->json();
        }
        return null;
    }

    // List Job seekers with or without filter
    public function getJobseekers(Request $request)
    {
        $data = $this->makeCurlRequest('http://localhost:8001/api/jobseekers', $request->all());
        if ($data && isset($data['data'])) {
            return DataTables::of(collect($data['data']))
                ->addColumn('action', function ($jobseeker) {
                    $viewButton = '<button class="btn btn-info btn-sm view-btn" data-id="' . $jobseeker['id'] . '">
                                    <i class="fas fa-eye"></i>
                                    </button>';

                    $downloadButton = '';
                    if (!empty($jobseeker['resume_url'])) {
                        $downloadButton = '<a href="' . $jobseeker['resume_url'] . '" class="btn btn-success btn-sm" download>
                                            <i class="fas fa-download"></i>
                                            </a>';
                    }

                    return $viewButton . ' ' . $downloadButton;
                })
                ->make(true);
        }
        return response()->json(['error' => 'Unable to fetch data from Lumen API'], 500);
    }

    // View Job Seeker's Detail
    public function getJobseeker($id)
    {
        $data = $this->makeCurlRequest('http://localhost:8001/api/jobseeker/' . $id);
        if ($data) {
            return response()->json($data, 200);
        }
        return response()->json(['error' => 'Unable to fetch data from Lumen API'], 500);
    }
}
