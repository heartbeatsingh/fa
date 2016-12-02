<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Search;
use Validator;
use App\Picture;
use App\Ansqus;

class SearchController extends Controller {

    function index() {
        $validateArr = Request::json()->all();
        $validator = Validator::make($validateArr['data'], [
                    'latitude' => 'required|min:1|max:25',
                    'longitude' => 'required|min:1|max:25',
                    'gender' => 'required|in:male,female,both|min:4|max:6',
                    'miles' => 'required|min:1|max:3',
        ]);
        if ($validator->fails()) {
            $err = [];
            $validator->errors()->add('status', 'failed');
            $errors = $validator->messages();
            if ($errors->has('gender')) {
                $err['gender'] = $errors->first('gender');
            }if ($errors->has('latitude')) {
                $err['latitude'] = $errors->first('latitude');
            }if ($errors->has('longitude')) {
                $err['longitude'] = $errors->first('longitude');
            }if ($errors->has('miles')) {
                $err['miles'] = $errors->first('miles');
            } else {
                unset($err);
            }
            return response()->json($err);
        } else {
            extract($validateArr['data']);
            $latA = $latitude;
            $lonA = $longitude;
            if (is_array($validateArr['data']['age'])) {
                $age = array('startAge' => $validateArr['data']['age']['startAge'], 'endAge' => $validateArr['data']['age']['endAge']);
            } else {
                $age = array('startAge' => 0, 'endAge' => 0);
            }

            $bb = $this->bound($latA, $lonA, $miles, "mi");
            $getLikeDislikeIds = getLikedDislikedIds($userId, 'both');
            $results = Search::whereBetween('lati', [$bb["S"]["lat"], $bb["N"]["lat"]])
                            ->whereBetween('longi', [$bb["W"]["lon"], $bb["E"]["lon"]])
                            ->whereBetween('age', [$age['startAge'], $age['endAge']])
                            ->when($gender, function ($query) use ($gender) {
                                if ($gender == 'both') {
                                    return $query->whereIn('gender', ['male', 'female']);
                                } else {
                                    return $query->where('gender', $gender);
                                }
                            })->whereNotIn('user_id', $getLikeDislikeIds)->where('user_id', '<>', $userId)->get();
            $arr = [];
            foreach ($results as $key => $row):
                $arr['users'][$key] = [
                    'miles' => round($this->distance($latA, $lonA, $row->lati, $row->longi, $units = "mi"), 2),
                    'userInfo' => $row->users->first(),
                    'images' => $row->pictures,
                    'answers' => $row->answers
                ];
            endforeach;
            $arr['status'] = 'success';
            return response()->json(['data' => $arr]);
        }
    }

    function bound($lat, $lon, $distance, $units = "mi") {
        return array("N" => $this->destination($lat, $lon, 0, $distance, $units),
            "E" => $this->destination($lat, $lon, 90, $distance, $units),
            "S" => $this->destination($lat, $lon, 180, $distance, $units),
            "W" => $this->destination($lat, $lon, 270, $distance, $units));
    }

    function distance($latA, $lonA, $latB, $lonB, $units = "mi") {
        $radius = strcasecmp($units, "km") ? 3963.19 : 6378.137;
        $rLatA = deg2rad($latA);
        $rLatB = deg2rad($latB);
        $rHalfDeltaLat = deg2rad(($latB - $latA) / 2);
        $rHalfDeltaLon = deg2rad(($lonB - $lonA) / 2);

        return 2 * $radius * asin(sqrt(pow(sin($rHalfDeltaLat), 2) +
                                cos($rLatA) * cos($rLatB) * pow(sin($rHalfDeltaLon), 2)));
    }

// calculate destination lat/lon given a starting point, bearing, and distance
    function destination($lat, $lon, $bearing, $distance, $units = "mi") {
        $radius = strcasecmp($units, "km") ? 3963.19 : 6378.137;
        $rLat = deg2rad($lat);
        $rLon = deg2rad($lon);
        $rBearing = deg2rad($bearing);
        $rAngDist = $distance / $radius;

        $rLatB = asin(sin($rLat) * cos($rAngDist) +
                cos($rLat) * sin($rAngDist) * cos($rBearing));
        $rLonB = $rLon + atan2(sin($rBearing) * sin($rAngDist) * cos($rLat), cos($rAngDist) - sin($rLat) * sin($rLatB));

        return array("lat" => rad2deg($rLatB), "lon" => rad2deg($rLonB));
    }

}
