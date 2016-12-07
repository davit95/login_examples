<?php

namespace App\Http\Controllers\Twitter;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\TwitterInterface;
use Abraham\TwitterOAuth\TwitterOAuth;
use Twitter;
use Session;
use Input;
use Redirect;


class TwitterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TwitterInterface $twitterService)
    {
        //dd($twitterService->a());
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

    public function twitterLogin(TwitterInterface $twitterService)
    {
        $url = $twitterService->getTwitterLoginUrl();
        return $url;
    }



    public function callback(TwitterInterface $twitterService)
    {
        if($twitterService->loginOrRegister()){
            return redirect('/home');
        } else {
            return redirect('/home')->with('warning', 'Error Authentication');
        }
    }
}
