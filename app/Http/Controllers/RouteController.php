<?php

namespace App\Http\Controllers;

use App\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        //get list of routes
        $routes = Route::all();
        //dd($routes);
        return view('route.index', compact('routes'));
    }

    public function create()
    {
        //
        return view('route.create');
    }

    public function store(Request $request)
    {
        //validate input
        //store data
        //show route created
        $this->validate(request(), ['route'=>'required|min:3']);
        Route::create(['route'=>request('route'), 'description'=>request('description')]);

        return redirect('/routes');
    }

    public function show(Route $route)
    {
        return view('route.show', compact('route'));
    }

    public function edit(Route $route)
    {
        //show edit form
        return view('route.edit', compact('route'));

    }

    public function update(Request $request, Route $route)
    {
        //validate
        $this->validate(request(), ['route'=>'required|min:3']);
        //save
        $route->update(['route'=>request('route'), 'description'=>request('description')]);
        //redirect
        return view('route.show', compact('route'));
    }

    public function destroy(Route $route)
    {
        //
    }
}
