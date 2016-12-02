<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Flop;
use App\User;
class FlopsController extends Controller {

    function matchedProfiles(Request $request) {
        $validateArr = Request::json()->all();
        extract($validateArr['data']);
        $getLikedKeysReverse = getLikedIdsReverse($userId);
        $getMatchedProfiles = Flop::whereIn('user_id', $getLikedKeysReverse)->where(['like_dislike_id' => $userId, 'action' => TRUE])->orderBy('created_at', 'DESC')->get();
        $arr = [];
        foreach ($getMatchedProfiles as $key => $row):
            $arr['rows'][$key] = [
                'usersInfo' => $row->users->first(),
                'images' => $row->pictures,
                'answers' => $row->answers
            ];
        endforeach;
        $arr['status'] = 'success';
        return response()->json(['data' => $arr]);
    }

    function getLikedDisliked(Request $request) {
        $validateArr = Request::json()->all();
        $validator = Validator::make($validateArr['data'], [
                    'action' => 'required' // the action 0 for dislike and 1 for like
        ]);
        if ($validator->fails()) {
            $err = [];
            $validator->errors()->add('status', 'failed');
            $errors = $validator->messages();
            if ($errors->has('status')) {
                $err['status'] = $errors->first('status');
            }if ($errors->has('action')) {
                $err['action'] = $errors->first('action');
            } else {
                unset($err);
            }
            return response()->json($err);
        } else {
            extract($validateArr['data']);
            $getLikedDislikedKeys = getLikedDislikedIds($userId, $action);
            $getLikedDislikedProfiles = Flop::whereIn('user_id' , $getLikedDislikedKeys)->groupBy('user_id')->get();
            
     
            $arr = [];
            foreach ($getLikedDislikedProfiles as $key => $row):
                $arr['users'][$key] = [
                    'usersInfo' => $row->users->first(),
                    'images' => $row->pictures,
                    'answers' => $row->answers
                ];
            endforeach;
            $arr['status'] = 'success';
            return response()->json(['data' => $arr]);
        }
    }

    function saveLikeDislike(Request $request) { //save data when user like or dislike any profile
        $validateArr = Request::json()->all();
        $validator = Validator::make($validateArr['data'], [
                    'likeDislikeId' => 'required', // the is of person whom like or dislike
                    'action' => 'required' // the action 0 for dislike and 1 for like
        ]);
        if ($validator->fails()) {
            $err = [];
            $validator->errors()->add('status', 'failed');
            $errors = $validator->messages();
            if ($errors->has('status')) {
                $err['status'] = $errors->first('status');
            }if ($errors->has('likeDislikeId')) {
                $err['like_dislike_id'] = $errors->first('likeDislikeId');
            }if ($errors->has('action')) {
                $err['action'] = $errors->first('action');
            } else {
                unset($err);
            }
            return response()->json($err);
        } else {
            extract($validateArr['data']);
            $isAlreadyLikedOrDislikedAction = Flop::where(['user_id' => $userId, 'like_dislike_id' => $likeDislikeId])->whereIn('action', [0, 1]);
            $isAlreadyLikedOrDisliked = $isAlreadyLikedOrDislikedAction->count();
            $returnAction = $isAlreadyLikedOrDislikedAction->first();
            if (!empty($returnAction)) {
                $message = ($returnAction->action == true) ? "Liked" : "Disliked";
            } else {
                $message = "";
            }
            $isMatched = Flop::where(['user_id' => $likeDislikeId, 'like_dislike_id' => $userId, 'action' => TRUE])->count();
            if (!$isAlreadyLikedOrDisliked) {
                $flops = Flop::Create(['user_id' => $userId, 'like_dislike_id' => $likeDislikeId, 'action' => $action]);
                if ($flops) {
                    $arr = ['status' => 'success', 'matched' => $isMatched ? 'yes' : 'no', 'likeDislikeId' => $likeDislikeId, 'message' => 'saved entry.'];
                    return response()->json(['data' => $arr]);
                }
            } else {
                $arr = ['status' => 'success', 'likeDislikeId' => $likeDislikeId, 'matched' => $isMatched ? 'yes' : 'no', 'message' => "You already $message this profile."];
                return response()->json(['data' => $arr]);
            }
        }
    }

}
