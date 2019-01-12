<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Product;


class VoteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect('/product/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }
        $product = Product::where('url_id', $id)->firstOrFail();
        if ($product) {
            $product->vote()->updateOrCreate($request->only(['comment']));
            return redirect('/product/'.$id)->with('success', 'Comment has been added');
        }
        return abort(404);

    }

    /**
     * Vote the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function vote(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'up' => 'required_without:down|integer|size:1',
            'down' => 'required_without:up|integer|size:1',
        ]);
        if ($validator->fails()) {
            return redirect('/product/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }
        $product = Product::where('url_id', $id)->first();
        if ($product) {
            if($request->has('up')){
                $product->vote()->increment('up');
            }
            if ($request->has('down')) {
                $product->vote()->increment('down');
            }
            return redirect('/product/'.$id)->with('success', 'Vote has been added');
        }
        return abort(404);
    }

}
