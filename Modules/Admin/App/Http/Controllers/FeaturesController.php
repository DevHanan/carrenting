<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Models\Feature;

class FeaturesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:definitions']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Feature::where(function($query) {
            $query->where('type', '=', request('type'));
        })->orderBy("id","desc")->paginate(10);
        return view('admin::features.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        $data['name'] = [];
        foreach(\Config::get("app.languages") as $key => $lang) {
            $data['name'][$key] = $request->get("name_" . $key);
        }
        $f = Feature::create($data);
        return redirect("/admin/features?type=". $f->type)->withSuccess("تم حفظ التغييرات بنجاح");
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Feature::find($id)->delete();
        return redirect("/admin/features")->withSuccess("تم حفظ التغييرات بنجاح");
    }
}
