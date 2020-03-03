<?php

namespace App\Http\Controllers;

use App\Section;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::paginate(5);
        return view('sections.index', ['sections' => $sections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Section $section
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('sections.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in logo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $section = new Section;
        $section->name = $request['name'];
        $section->description = $request['description'];

        if ($request->hasFile('logo')) {
            $path = Storage::disk('public')->put($request->file('logo')->getClientOriginalName(),$request->file('logo')->get());
            $section->logo = $request->file('logo')->getClientOriginalName();
        } else {
            $section->logo = 'test.jpg';
        }

        $section->save();

        $users = User::find($request['users']);
        $section->users()->attach($users);

        return redirect()->route('sections.index')
            ->with('success','Section created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = Section::find($id);
        return view('sections.show', ['section' => $section]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $section = Section::find($id);
        $users = User::all();
        $section_user = $section->users->pluck('id')->toArray();
        return view('sections.edit', ['section' => $section, 'users' => $users, 'section_user' => $section_user]);
    }

    /**
     * Update the specified resource in logo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $section = Section::find($id);
        $section->name = $request['name'];
        $section->description = $request['description'];

        if ($request->hasFile('logo')) {
            $path = Storage::disk('public')->put($request->file('logo')->getClientOriginalName(),$request->file('logo')->get());
            $section->logo = $request->file('logo')->getClientOriginalName();
        }


        $section->save();

        $users = User::find($request['users']);
        $section->users()->sync($users);

        return redirect()->route('sections.index')
            ->with('success','Section updated successfully.');
    }

    /**
     * Remove the specified resource from logo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::find($id);
        $section->delete();

        Storage::disk('public')->delete($section->logo);

        return redirect()->route('sections.index')
            ->with('success', 'Section deleted successfully');
    }
}
