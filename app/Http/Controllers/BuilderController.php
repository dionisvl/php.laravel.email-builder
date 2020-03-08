<?php

namespace App\Http\Controllers;

use App\Block;
use App\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BuilderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blocks = (new BlockController)->getBlocks();

        return view('builder', ['blocks' => $blocks]);
    }

    public function constructPreview(Request $request)
    {
        $template = TemplateController::show('amp_email');

        $ids = is_string($request->ids) ? explode(',', $request->ids) : $request->ids;

        $types = [
            'content',
            'remote_scripts',
            'styles'
        ];
        $content = '';
        $remote_scripts = '';
        $styles = '';
        foreach ($ids as $id) {
            $block = BlockController::show($id);

            $content .= $block->{'content'};
            $remote_scripts .= $block->remote_scripts;
            $styles .= $block->styles;
        }

        $string = $template->{'content'};
        $string = $this->replacer($string, $content, 'content');
        $string = $this->replacer($string, $remote_scripts, 'remote_scripts');
        $string = $this->replacer($string, $styles, 'styles');

        Storage::disk('public')->put('1.html', $string);

        $data['link'] = Storage::disk('public')->url('1.html');
        $data['filename'] = '1.html';
        $data['id'] = 1;
        return $data;
    }

    private function replacer($oldString, $stringToInsert, $type)
    {
        if (empty($stringToInsert)) {
            return $oldString;
        } else {
            return preg_replace(
                "/<!-- $type start -->\s*<!-- $type end -->/",
                "<!-- $type start -->" . $stringToInsert . "<!-- $type end -->",
                $oldString);
        }
    }

    public function viewSource($id)
    {
        $data = Storage::disk('public')->get("$id.html");

        return view('source', [
            'data' => $data
        ]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Template $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Template $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Template $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $template)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Template $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        //
    }
}
