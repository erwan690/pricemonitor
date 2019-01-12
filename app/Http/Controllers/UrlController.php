<?php

namespace App\Http\Controllers;

use App\Url;
use App\Product;
use Validator;
use App\Helper\MetaData;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::paginate(10);
        return view('list', ['products'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url|max:255',
        ]);
        $url = $this->checkurl($request->url);
        if ($validator->fails() || !$url) {
            $error = !$url ? 'Only Product on fabelio.com accepted': $validator;
            return redirect('/')
                        ->withErrors($error)
                        ->withInput();
        }

        $result = MetaData::fetch($request->url);
        if ($result) {
            $link = [
                'url'=>$request->url
            ];
            $data = $result->tags();
            $linkdata = [
                'title'=>$data['og:title'],
                'image'=>$data['og:image'],
                'description'=>$data['og:description'],
                'currency'=>$data['product:price:currency'],
                'ammount'=>$data['product:price:amount'],
            ];
            $saveurl = Url::updateOrCreate($link, $link);
            $saveurl->product()->updateOrCreate(['url_id'=>$saveurl->id], $linkdata);
        }
        return redirect('/product/'.$saveurl->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = Url::find($id);
        if ($url) {
            return view('detail', ['product'=>$url->product,'vote'=>$url->product->vote()->paginate(5)]);
        }
        return abort(404);
    }

    /**
     * [checkurl description]
     * @param  string $url
     * @return [type]
     */
    private function checkurl($url='')
    {
        $domain = parse_url($url, PHP_URL_HOST);
        if ($domain == 'fabelio.com') {
            return true;
        }
        return false;
    }
}
