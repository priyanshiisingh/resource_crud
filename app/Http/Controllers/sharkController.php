<?php

namespace App\Http\Controllers;

use App\Models\Shark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class sharkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all the sharks
        $sharks = Shark::all();

        // load the view and pass the sharks
        return View::make('sharks.index')
            ->with('sharks', $sharks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return View::make('sharks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        $rules = array(
            'name'       => 'required',
            'email'      => 'required|email',
            'shark_level' => 'required|numeric'
        );
        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('sharks/create')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            // store
            $shark = new Shark;
            $shark->name       = $request->get('name');
            $shark->email      = $request->get('email');
            $shark->shark_level = $request->get('shark_level');
            $shark->save();

            // redirect
            Session::flash('message', 'Successfully created shark!');
            return Redirect::to('sharks');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // get the shark
        $shark = shark::find($id);

        // show the view and pass the shark to it
        return View::make('sharks.show')
            ->with('shark', $shark);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // get the shark
        $shark = shark::find($id);

        // show the edit form and pass the shark
        return View::make('sharks.edit')
            ->with('shark', $shark);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // validate
    $rules = [
        'name'       => 'required',
        'email'      => 'required|email',
        'shark_level' => 'required|numeric'
    ];

    $validator = Validator::make($request->all(), $rules);

    // process the login
    if ($validator->fails()) {
        return redirect()->route('sharks.edit', ['id' => $id])
            ->withErrors($validator)
            ->withInput($request->except('password'));
    } else {
        // update
        $shark = Shark::find($id);
        $shark->name       = $request->input('name');
        $shark->email      = $request->input('email');
        $shark->shark_level = $request->input('shark_level');
        $shark->save();

        // redirect
        Session::flash('message', 'Successfully updated shark!');
        return redirect()->route('sharks.index');
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // delete
        $shark = shark::find($id);
        $shark->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the shark!');
        return Redirect::to('sharks');
    }
}
