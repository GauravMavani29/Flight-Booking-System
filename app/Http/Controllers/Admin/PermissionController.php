<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        // Staff Permission Check
        // $this->middleware('role:Super Admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::select('section')->groupBy('section')->get();
        return view('admin.permission.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions|max:255',
            'section' => 'required',
        ]);

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->section = $request->section;
        $permission->guard_name = 'web';
        $permission->save();

        return redirect()->route('admin.permission.index')->with('success', 'Permission created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = Permission::select('section')->groupBy('section')->get();
        $permission = Permission::findOrFail($id);
        return view('admin.permission.edit', compact('permission', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id . '|max:255',
            'section' => 'required',
        ]);

        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->section = $request->section;
        $permission->save();

        return redirect()->route('admin.permission.index')->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        // session()->flash('Your message here');
        return response()->json(['id' => $id]);
    }
}
