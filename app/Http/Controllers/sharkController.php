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
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'       => 'required',
            'email'      => 'required|email',
            'shark_level' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('sharks/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $shark = new shark;
            $shark->name       = Input::get('name');
            $shark->email      = Input::get('email');
            $shark->shark_level = Input::get('shark_level');
            $shark->save();

            // redirect
            Session::flash('message', 'Successfully created shark!');
            return Redirect::to('sharks');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
