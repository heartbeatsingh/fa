<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Request;
use App\Http\Requests;
use App\User;
use App\Ansqus;
use DB;
use App\Picture;
use Validator;
use Config;

class ProfileController extends Controller {

    function index(Request $request) {
        $validateArr = Request::json()->all();
        $user = new User();
        $results = $user->getProfile($validateArr);
        $results->pictures;
        $results->answers;
        $arr['data'] = $results;
        $arr['status'] = "success";
        return response()->json($arr);
    }

    function editProfile(Request $request) {
        $validateArr = Request::json()->all();
        $validator = Validator::make($validateArr['data'], [
                    'firstName' => 'required|min:2|max:150',
                    'lastName' => 'required|min:2|max:150',
        ]);
        if ($validator->fails()) {
            $err = [];
            $validator->errors()->add('status', 'failed');
            $errors = $validator->messages();
            if ($errors->has('firstName')) {
                $err['first_name'] = $errors->first('firstName');
            }if ($errors->has('lastName')) {
                $err['last_name'] = $errors->first('lastName');
            } else {
                unset($err);
            }
            return response()->json($err);
        } else {
            extract($validateArr['data']);
            $ok = false;
            $arrUser = [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'age' => $age ? $age : '',
                'education' => $education ? $education : '',
                'workplace' => $workplace ? $workplace : '',
                'about' => $about ? $about : ''
            ];
            if (User::where(['id' => $userId])->update($arrUser)) {
                $ok = true;
            }
            /* save question answers */
            if (!empty($validateArr['data']['answers'])) {
                foreach ($validateArr['data']['answers'] as $anws):
                    if (!empty($anws['questionId'])) {

                        $isQusExist = Ansqus::where(['question_id' => $anws['questionId'], 'user_id' => $anws['userId']])->count();
                        if (empty($isQusExist)) {
                            Ansqus::insert(['answer' => $anws['answer'], 'question_id' => $anws['questionId'], 'user_id' => $anws['userId'], 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
                        } else {
                            Ansqus::where(['question_id' => $anws['questionId'], 'user_id' => $anws['userId']])->update(['answer' => $anws['answer']]);
                        }
                        $ok = true;
                    } else {
                        return response()->json(['status' => 'failed', 'message' => 'Question id will not empty in any case.']);
                    }
                endforeach;
            }
            if ($ok == true) {
                return response()->json(['status' => 'success', 'message' => 'Your profile has been updated successfully.']);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Opps!! there are some techinal resion, your profile has been not updated, please try again.']);
            }
        }
    }

    function imagesUpdate() {
        $validateArr = Request::json()->all();
        if (!empty($validateArr['data']['images'])) {
            extract($validateArr['data']);
            foreach ($validateArr['data']['images'] as $anws):
                if (!empty($anws['imageId'])) {
                    /* save image data */
                    $img = $anws['image'];
                    $img = str_replace(array('data:image/png;base64,', 'data:image/jpeg;base64,', 'data:image/jpg;base64'), array('', '', ''), $img);
                    $img = str_replace(' ', '+', $img);
                    $dataImage = base64_decode($img);
                    $picName = 'heartbeat-' . generateRandomString(10) . '-' . $userId . ".png";
                    $picPath = Config::get('constants.profilePicPath') . $picName;
                    if (!empty($dataImage)) {
                        file_put_contents($picPath, $dataImage);
                    } else {
                        return response()->json(['status' => 'failed', 'message' => 'Image data will not be empty in any case.']);
                    }
                    $isQusExist = Picture::where(['pic_id' => $anws['imageId'], 'user_id' => $userId])->count();
                    if (empty($isQusExist)) {
                        Picture::insert(['pic' => $picName, 'pic_id' => $anws['imageId'], "order_no" => $anws['orderNo'], 'user_id' => $userId, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
                    } else {
                        /* delete image before update */
                        $getImageRow = Picture::where(['pic_id' => $anws['imageId'], 'user_id' => $userId])->first();
                        unlink('public/images/fotuan/' . $getImageRow->pic);
                        Picture::where(['pic_id' => $anws['imageId'], 'user_id' => $userId])->update(['pic' => $picName, "order_no" => $anws['orderNo']]);
                    }
                } else {
                    return response()->json(['status' => 'failed', 'message' => 'Image id will not be empty in any case.']);
                }
            endforeach;
            return response()->json(['status' => 'success', 'message' => 'Images has been saved successfully.']);
        } else {
            return response()->json(['status' => 'failed', 'message' => 'Image data is empty.']);
        }
    }

    function lastActive() {
        $validateArr = Request::json()->all();
        $validator = Validator::make($validateArr['data'], [
            'lastActive' => 'required|min:2|max:50'
        ]);
        if ($validator->fails()) {
            $err = [];
            $validator->errors()->add('status', 'failed');
            $errors = $validator->messages();
            if ($errors->has('lastActive')) {
                $err['lastActive'] = $errors->first('lastActive');
            } else {
                unset($err);
            }
            return response()->json($err);
        } else {
            extract($validateArr['data']);
            User::where(['id' => $userId, 'token' => $token])->update(['last_active' => $lastActive]);
            return response()->json(['status' => 'success', 'message' => 'Data has been updated successfully.']);
        }
    }

    
    
}
