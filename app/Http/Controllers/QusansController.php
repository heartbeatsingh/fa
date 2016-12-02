<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Qusan;
use Illuminate\Http\Request;
use Session;
use Input;
use DB;

class QusansController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $qusans = Qusan::paginate(25);
        return view('qusans.index', compact('qusans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('qusans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Requests\Question $request) {

        $requestData = $request->all();

        Qusan::create($requestData);

        Session::flash('success', 'Question has been added successfully.');

        return redirect('qusans');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $qusan = DB::table('qusans')->where(['id' => $id])->first();
        return view('qusans.show', compact('qusan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $qusan = DB::table('qusans')->where(['id' => $id])->first();
        return view('qusans.edit', compact('qusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Requests\Question $request) {

        $requestData = $request->all();

        $qusan = Qusan::findOrFail($id);
        Input::has('status') ? $qusan->status = 1 : $qusan->status = 0;
        $qusan->update($requestData);

        Session::flash('success', 'Question has been updated successfully.');

        return redirect('qusans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        Qusan::destroy($id);

        Session::flash('success', 'Question has been deleted successfully.');

        return redirect('qusans');
    }

    function getAllQuestions() {
        $questions = DB::table('qusans')->select('order_no as orderNo', 'question')->where(['status' => TRUE])->orderBy('order_no', 'asc')->get();
        return response()->json($questions);
    }

}
