<?php

namespace App\Http\Controllers;

use App\Block;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json($this->getBlocks());
    }

    public function getBlocks()
    {
        $blocks = Block::take(500)->orderBy('created_at', 'DESC')->get()->sortBy('created_at');

        //remove keys after sortBy
        $blocks = $blocks->unique('id')->values();

        return $blocks;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $types = TypeController::getTypes();
        return view('block.create', ['types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $block = new Block;

        $block->name = $request->name;
        $block->type_id = $request->type_id;
        $block->content = $request->{'content'};
        $block->styles = $request->styles;
        $block->scripts = $request->scripts;
        $block->remote_styles = $request->remote_styles;
        $block->remote_scripts = $request->remote_scripts;
        $block->save();


        return response()->json('ok');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function show($id)
    {
        return Block::where('id', $id)
            ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $block = Block::where('id', $id)->first();
        $types = TypeController::getTypes();
        return view('block.edit',[
            'block' => $block,
            'types' => $types
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $block = Block::where('id', $id)->first();

        $block->name = $request->name;
        $block->type_id = $request->type_id;
        $block->content = $request->{'content'};
        $block->styles = $request->styles;
        $block->scripts = $request->scripts;
        $block->remote_styles = $request->remote_styles;
        $block->remote_scripts = $request->remote_scripts;
        $block->save();

        //return response()->json('ok');
        return redirect()->action('BuilderController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Block $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Block $block)
    {
        //
    }
}
