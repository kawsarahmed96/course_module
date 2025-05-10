<?php
namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('home');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //validation
        $request->validate([
            'course_name'                      => 'required|string',
            'course_details'                   => 'nullable|string',

            'modules'                          => 'required|array',

            'modules.*.name'                   => 'required|string',
            'modules.*.description'            => 'nullable|string',
            'modules.*.duration'               => 'required|string',

            'modules.*.contents'               => 'nullable|array',
            'modules.*.contents.*.name'        => 'required|string',
            'modules.*.contents.*.description' => 'nullable|string',
        ]);

        // dd($request->all());

        $course = Course::create([
            'course_name'    => $request->course_name,
            'course_details' => $request->course_details,
        ]);

        if ($request->modules) {
            foreach ($request->modules as $moduleData) {
                $module = Module::create([
                    'module_name'        => $moduleData['name'],
                    'module_description' => $moduleData['description'],
                    'module_duration'    => $moduleData['duration'],
                    'course_id'          => $course->id,
                ]);

                if (! empty($moduleData['contents'])) {
                    foreach ($moduleData['contents'] as $contentData) {
                        Content::create([
                            'content_name'        => $contentData['name'],
                            'content_description' => $contentData['description'],
                            'module_id'           => $module->id,
                        ]);
                    }
                }
            }

        }

        return redirect()->back()->with('success', 'Course created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
