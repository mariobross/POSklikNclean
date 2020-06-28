<?php

namespace App\Http\Controllers;

use App\Cashier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CashiersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cashier = Cashier::paginate(5);
        return view('kasir.index', compact('cashier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('kasir.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|string|max:100',
            'password' => 'required|string',
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'address' => 'required|string|max:100',
            'phone' => 'required|string|max:12'
            
        ]);

        Cashier::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);  

        return redirect('/cashier')->with('success', 'Data successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cashier  $cashier
     * @return \Illuminate\Http\Response
     */
    public function show(Cashier $cashier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cashier  $cashier
     * @return \Illuminate\Http\Response
     */
    public function edit(Cashier $cashier)
    {
        return view('kasir.edit', compact('cashier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cashier  $cashier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cashier $cashier)
    {
        $this->validate($request,[
            'username' => 'required|string|max:100',
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'address' => 'required|string|max:100',
            'phone' => 'required|string|max:12'
        ]);

        Cashier::where('id',$cashier->id)
                ->update([
                    'username' => $request->username,
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'phone' => $request->phone
                ]);

        return redirect('/cashier')->with('success', 'Data successfully changed');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cashier  $cashier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cashier $cashier)
    {
        Cashier::destroy($cashier->id);
        return redirect('/cashier')->with('success', 'Data successfully deleted');
    }
}
