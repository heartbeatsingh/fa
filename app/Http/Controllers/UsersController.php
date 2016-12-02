<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Picture;
use Request;
use Session;
use Input;
use DB;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $users = User::where('role', '<>', '143')->paginate(50000);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Requests\User $request) {

        $requestData = $request->all();

        User::create($requestData);

        Session::flash('flash_message', 'User added!');

        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $user = DB::table('users')->where(['id' => $id])->first();

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Requests\User $request) {
        $requestData = $request->all();
        $user = User::findOrFail($id);
        $user->update($requestData);
        Session::flash('success', 'User has been updated successfully.');
        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        User::destroy($id);
        Session::flash('success', 'User has been deleted successfully.');
        return redirect('users');
    }

    //http://localhost/flopapp/api/register
    function register(Request $request) {
        $validateArr = Request::json()->all();
        if (!empty($validateArr['data'])) {
            $validator = Validator::make($validateArr['data'], [
                        'firstName' => 'required|min:2|max:150',
                        'lastName' => 'required|min:2|max:150',
                        'email' => 'required|email',
                        'latitude' => 'required|min:2|max:15',
                        'longitude' => 'required|min:2|max:15',
                        'facebookId' => 'required',
                        'gender' => 'required|in:male,female|min:4|max:6']);
            if ($validator->fails()) {
                $err = [];
                $validator->errors()->add('status', 'failed');
                $errors = $validator->messages();
                if ($errors->has('firstName')) {
                    $err['first_name'] = $errors->first('firstName');
                }if ($errors->has('lastName')) {
                    $err['last_name'] = $errors->first('lastName');
                }if ($errors->has('email')) {
                    $err['email'] = $errors->first('email');
                }if ($errors->has('gender')) {
                    $err['gender'] = $errors->first('gender');
                }if ($errors->has('latitude')) {
                    $err['latitude'] = $errors->first('latitude');
                }if ($errors->has('longitude')) {
                    $err['longitude'] = $errors->first('longitude');
                }if ($errors->has('facebookId')) {
                    $err['facebookId'] = $errors->first('facebookId');
                }if ($errors->has('status')) {
                    $err['status'] = $errors->first('status');
                } else {
                    unset($err);
                }
                return response()->json($err);
            } else {
                extract($validateArr['data']);
                /* Check if user already exist */
                $isUserExist = DB::table('users')->where(['facebook_id' => $facebookId, 'email' => $email])->count();
                if ($isUserExist == 1) {
                    $userRow = DB::table('users')->where(['facebook_id' => $facebookId, 'email' => $email])->first();
                    $returData = ['status' => 'success', 'userId' => $userRow->id, 'email' => $userRow->email, 'token' => $userRow->token];
                    return response()->json($returData);
                }
                $user = new User;
                $user->first_name = $firstName;
                $user->last_name = $lastName;
                $user->email = $email;
                $user->password = bcrypt('123456');
                $user->gender = strtolower($gender);
                $user->lati = $latitude;
                $user->longi = $longitude;
                $user->age = isset($age) ? $age : 0;
                
                $user->facebook_id = $facebookId;
                $user->about = isset($about) ? $about : '';
                $user->status = TRUE;
                $user->datetime = time();
                $user->token = generateRandomString();
                $user->remember_token = generateRandomString(10);
                $user->role = TRUE;
                $user->save();
                $newId = $user->id;
                /* has profile pic */
                if (!empty($profilePic)) {
                    $picData = array('pic' => $profilePic, 'userId' => $newId);
                    $this->savePictures($picData);
                }
                $userRow = User::findOrFail($newId);
                $returData = ['status' => 'success', 'userId' => $userRow->id, 'email' => $userRow->email, 'token' => $userRow->token];
                return response()->json($returData);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Data is empty.']);
        }
    }

    function savePictures($arr) {
        $pic = new Picture();
        $pic->pic = $arr['pic'];
        $pic->user_id = $arr['userId'];
        $pic->order_no = rand(1, 5);
        $pic->save();
    }

}
