<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Page;
use Request;
use Session;
use Input;
use DB;

class PagesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $pages = Page::paginate(25);

        return view('pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {

        $requestData = $request->all();

        Page::create($requestData);

        Session::flash('flash_message', 'Page added!');

        return redirect('pages');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $page = Page::findOrFail($id);

        return view('pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $page = Page::findOrFail($id);

        return view('pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Requests\Page $request) {

        $requestData = $request->all();

        $page = Page::findOrFail($id);
        Input::has('status') ? $page->status = 1 : $page->status = 0;
        $page->update($requestData);

        Session::flash('flash_message', 'Page has been updated successfully.');

        return redirect('pages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        Page::destroy($id);

        Session::flash('flash_message', 'Page has been deleted successfully.');

        return redirect('pages');
    }

    function getAllPages() {
        $pages = DB::table('pages')->select('title', 'slug', 'content')->where(['status' => TRUE])->orderBy('title', 'asc')->get();
        return response()->json(['data' => ['status' => 'success','rows' => $pages]]);
    }

}
