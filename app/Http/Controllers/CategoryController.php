<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CategoryController extends Controller
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
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6Ijc3M2MxMTU1MGU0ODJkOTM3YWNlNzVjYmYxM2Y3Y2I4OWE1ZDZhZmFkNzFmYWI5Yjg3YjNmMjRmNWZkM2FhY2Y0YzcyYzI1ZTRiODViYjNhIn0.eyJhdWQiOiIyIiwianRpIjoiNzczYzExNTUwZTQ4MmQ5MzdhY2U3NWNiZjEzZjdjYjg5YTVkNmFmYWQ3MWZhYjliODdiM2YyNGY1ZmQzYWFjZjRjNzJjMjVlNGI4NWJiM2EiLCJpYXQiOjE1NTAzMTc2NTksIm5iZiI6MTU1MDMxNzY1OSwiZXhwIjoxNTgxODUzNjU5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Jf4knv3ecvt2qC_qUNJYKkZi9zXoPCmr7sgD867IKpXTOmBn-gfevp6YSVEEVCXXpdnmaZTnpQedyGo6TIwf-mI-A8e9GkpMQjAlJXqU8CWlLX-sfPdMtyycPp39b4bM8xjCRj_7zRP4pzHXc8kGLQ-TX_lRksaObmEdX0Z41JCdri65Usz2Gm3MdelzOuRH2zGzPITke5Txsgg-WMPIk7y41ritZTqP5twy0BlTQQJYYW_ySmYixIcRR5woejZpN30LZz61SgCtc3O_aXLKxnz2Dcfj9UdEfn-xcM66Df-ZuLS-JiFPBYD4nggFpqli5DUs2kytU98Vyc-E3MozYEgQdMqBaZCWKiKuGcMczpEZoUD0fJQUgG__SbvzpVVcYBGjb_No2TaTBs4vYkv9V9HmkkLzwhRJ0V1Lh14Uk7Z_vku4JQ9SSdyhi3C5mcxFANhj8_1mFVpze9zRnlXj35_tJ3zoQKpQeqamVL8Psxe87-HvnB8RadCBxKtlkZv7CkwQrZoL7CUbq0ZDYU-3sfr-e04JIWNC_vZkuz4t88QZg_zQZ1KYoqVdvf5zHd3HTnw2TYw1P9wzw7CPy0rq0IeZVgO4WEzeNb7dw6Ftfj4gDUdnJR13Qx2LqbY0ukCuXnAbn5EW18fbYG9iol9mEtNCT98cgcW-nBLWT8G6jLU',
        ];
        $client = new Client([
            'headers' => $headers
        ]);
        $r = $client->get('laravel-api.test/api/categories');
        $categories = json_decode($r->getBody()->getContents());
        return $categories->data;
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
