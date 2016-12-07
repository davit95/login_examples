<?php

namespace App\Http\Controllers\Facebook;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Facebook\Facebook;
use App\Contracts\FacebookInterface;

class FacebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * get facebook login url
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function fbLogin(FacebookInterface $facebookService)
    {
        $facebookLoginUrl = $facebookService->getFacebookLoginUrl();
        return view('facebook.index',['facebookLoginUrl' => $facebookLoginUrl]);
    }

    public function callback(FacebookInterface $facebook_service)
    {
        if($facebook_service->loginOrRegister()){
            return redirect('/home');
        } else {
            return redirect('/home')->with('warning', 'Error Authentication');
        }
    }

}
