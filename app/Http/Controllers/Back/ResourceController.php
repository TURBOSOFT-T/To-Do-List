<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;

use App\Models\Courses;
use App\Models\Department;
use App\Models\University;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    protected $dataTable;
    protected $view;
    protected $formRequest;
    protected $singular;


    public function __construct()
    {
        if (!app()->runningInConsole()) {

            $segment = getUrlSegment(request()->url(), 2); // categories ou newcategories

            if (substr($segment, 0, 3) === 'new') {
                $segment = substr($segment, 3);
            }

            $name = substr($segment, 0, -1); // categorie
            $this->singular = Str::singular($segment); // category

            $model = ucfirst($this->singular); // Category

            $this->model = 'App\Models\\' . $model;
            $this->dataTable = 'App\DataTables\\' . ucfirst($name) . 'sDataTable';
            $this->view = 'back.' . $name . 's.form';
            $this->formRequest = 'App\Http\Requests\Back\\' . $model . 'Request';
            // $this->formRequest = 'App\Http\Requests\\' . $model . 'Request';
        }
    }


    public function index()
    {
        return app()->make($this->dataTable)->render('back.shared.index');
    }


    public function create()
    {
        $universities = University::all();
        $departments = Department::all();
        $courses = Courses::all();
        return view($this->view, compact('universities', 'departments', 'courses'));
    }




    public function store()
    {
        $request = app()->make($this->formRequest);
        // $universities = University::all();
        app()->make($this->model)->create($request->all());
        //  app()->make($this->model)->create(array_merge($request->all()));

        return back()->with(['ok' => __('The ' . $this->singular . ' has been successfully created.')]);

    }





    public function edit($id)
    {

        $departments = Department::all();
        $universities= University::all();

        $element = app()->make($this->model)->find($id);

        return view($this->view, [$this->singular => $element], compact('departments', 'universities'));
    }


    public function update($id)
    {

        $departments = Department::all();
        $universities = University::all();
        $request = app()->make($this->formRequest);

        app()->make($this->model)->find($id)->update($request->all());

        return back()->with(['ok' => __('The ' . $this->singular . ' has been successfully updated.')], compact('universities'));

    }


    public function destroy($id)
    {
        app()->make($this->model)->find($id)->delete();

        return response()->json();
    }
}