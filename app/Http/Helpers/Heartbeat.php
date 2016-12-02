<?php

/* It's heartbeat's helper find me on fb/heartbeatsingh */

function generateRandomString($length = 30) {
    return str_random($length);
}

function getToken($userId) {
    $token = DB::table('users')->where('id', $userId)->first();
    return !empty($token->token) ? $token->token : false;
}

function isAuthUser($userId = 0, $token = 'fb/heartbeatsingh') {
    return DB::table('users')->where(['id' => $userId, 'token' => $token])->count();
}

function getLikedDislikedIds($userId, $action) {

    switch ($action) {
        case "both":
            return DB::table('flops')->where(['user_id' => $userId])->whereIn('action', [0, 1])->pluck('like_dislike_id');
            break;
        case 1:
            return DB::table('flops')->where(['user_id' => $userId, 'action' => 1])->pluck('like_dislike_id');
            break;
        default;
            return DB::table('flops')->where(['user_id' => $userId, 'action' => 0])->pluck('like_dislike_id');
    }
}

function getLikedIdsReverse($userId) {
    return DB::table('flops')->where(['user_id' => $userId, 'action' => TRUE])->pluck('like_dislike_id');
    //return DB::table('flops')->whereIn('user_id', $likeIds)->where(['like_dislike_id' => $userId,'action' => TRUE])->pluck('user_id');
}

function responseMsg($status = false) {
    return $status ? ['status' => 'success', 'message' => 'Your profile has been updated successfully.'] :
            ['status' => 'failed', 'message' => 'Opps!! There are some techinal resion, your api hit has been failed.'];
}
