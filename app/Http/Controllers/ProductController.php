<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ProductController extends Controller
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
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwNGVkMGE2ZjMzMGFmY2VhYmU1YmE2ZGJjYzRiYzYzZDBkZTdjOGZiMGJiNjcxNDI3NzlmMTRkNTNmNjQ5MTJlZjY0NzVkMGZjZGQ5ZjQyIn0.eyJhdWQiOiIyIiwianRpIjoiNDA0ZWQwYTZmMzMwYWZjZWFiZTViYTZkYmNjNGJjNjNkMGRlN2M4ZmIwYmI2NzE0Mjc3OWYxNGQ1M2Y2NDkxMmVmNjQ3NWQwZmNkZDlmNDIiLCJpYXQiOjE1NDk4ODMwODEsIm5iZiI6MTU0OTg4MzA4MSwiZXhwIjoxNTgxNDE5MDgxLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.AQtHDiV3rcVflOk5t4rfbDlPy1tIIgC_VZ8hU15Os2vsWlmAfftE_Fy0gs8_JrV0VU7ELtI_XHxK-0WsimnfvGEW93b76keqroMXxF_2JVkzz8BG0jYVWVNP2vl_tfCJa2IoLQeESa56DBuu38ny7OgLj1h6IoQEGW5ozetYptmDESquYYoQtERFul8asNW32hPmzZNA6ZizZCqfM8JaLRDhIK4XztoJDYF1D9yqEjTmfGISTjplxFmy1BlvTPM1i7bAKaXSOmqHqmcGXpgIDlyel_UyMYpCdy8opjCwA3gSUtmffR_rQ7qXQXIpovhzIzjlf3UYfen8g2J3wWq4tT-p4YDkA3FDUHx-OvrTW-vemWM_TIciFzv1X9V_aEz7E-j0wLw9ojPMZuCNNwZCzohKFEtgywMlqqxh_m739UK1x9jqAbvhyYCdckIIZ_e6l5SQbkEw7gj4o8OAuxImWRkIbjaOI_TXGyTkBFSANdJUnKUDONJj31wh5OGbeNM1xqFSWDnu5ro941Amq6ynqzHsW2iGI6dJtDwSGBqeYfXnjZz8iD5D7AKRIC3IXVEEklf_JI7CSRxZtPzhuU0qbmSGrxWAFaBu0qdUxUT9ZM3yaOwZOfQl6JhFKl5GWRFHaF6RE6fCisWZ6JSN9clqSnylAOG2iRt_OAmkIbkMd3Y',
        ];
        $client = new Client([
            'headers' => $headers
        ]);
        $r = $client->get('laravel-api.test/api/products');
        $products = json_decode($r->getBody()->getContents());
        return $products->data;
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
