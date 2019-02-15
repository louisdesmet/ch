<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headers = [
            'Content-Type' => 'application/json',
            'AccessToken' => 'key',
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjJiNTdkZGJjYjk4YWU3ODQyOTFjZmY5YTQ5YmEzNDI5MzgxOWVlOTAzYmU4YmQxNWI4ZTE1N2E1OTRlMmI5ZDVkM2IxYTQxZjA1MDJjYzlkIn0.eyJhdWQiOiIyIiwianRpIjoiMmI1N2RkYmNiOThhZTc4NDI5MWNmZjlhNDliYTM0MjkzODE5ZWU5MDNiZThiZDE1YjhlMTU3YTU5NGUyYjlkNWQzYjFhNDFmMDUwMmNjOWQiLCJpYXQiOjE1NTAwNzI4ODQsIm5iZiI6MTU1MDA3Mjg4NCwiZXhwIjoxNTgxNjA4ODg0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.r4yriCZvd-XQVSUWgXYFmkzM2x5ZtssrWwvF-rCtbVuVn44KMA3kL-ELrClFzQNQMkp8hWoiDrySWv-dt1MlxhNTl4evKL2sPGVfvax47IiVdJ8AKl_wBedLtqSL9oSmx14PBiRN6ajB0xVCpLd1fmBhoQSHdzG3EBsY1_Hj3D5BIeD0CspbIfaHKUSLbibsR46XFYk4Js4loUUynIEvebRJUWwIQjjbd4FbddY6EaVoY__KiTeIXgn05RU-y50XX8MX6LRDENjZ6x-wlw8uhArVWQtzcvrzjnLUCL5oYqiLRTujAOJIA5yMv8zaCdUsgwIjbMSI53xfSYqC6v5XG_arxUgP94zWeL5Juono2Dnl-D6Yn5ZEdecXYKkvJPJbindKlgXPh6dkYDwobpGU--fQtS2lVH4dtPNJ_7Qj4095MPMMtHy5jWgq8CiIN7OPhg-5JOyfEDahLEQ5LtxHgW5N-r1pz2Atvth2U0zNok9aT-DxEowho2RfQkyFlrBsLXUPjTceRcKs1wyjDOXXOJCEjBbC4W3LMqRq2aJMlLAIS4s3vrWK-Fb7O6eBC3NeSWnFYjas8velkjSTV65g6fRMvM0UYR2KNoBeBMy_2B0di6JxQo2ZdqmoZNFFQFLvu90XzG_8Iv7TdEobbujeVtVzAUDyfBV43LPRwjFZgpU',
        ];
        $client = new Client([
            'headers' => $headers
        ]);
        $r = $client->get('laravel-api.test/api/vendors');
        $vendors = json_decode($r->getBody()->getContents());
        return $vendors->data;
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
}
