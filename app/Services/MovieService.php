<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MovieService
{
    public static function validateMovie(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'year' => 'required|numeric|max:3000',
            'format' => 'required|string|max:20',
            'actor_fullname' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }


    public static function createMovie(Request $request)
    {
        $movie = Movie::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'year' => $request->year,
            'format' => $request->format,
            'actor_fullname' => $request->actor_fullname,
        ]);

        return $movie;
    }


    public static function getMovieByNameOrFullName(Request $request)
    {
        return Movie::where('name', $request->name)->orWhere('actor_fullname', $request->actor_fullname)->get();
    }


    public static function updateMovie(Request $request, $id)
    {
        $user_id = Movie::find($id) ? Movie::find($id)->user_id : '';

        if(self::validateMovie($request) != false and $user_id == Auth::id()){
            $movie = Movie::updateOrCreate(
                ['id' => $id],
                [
                    'user_id' => Auth::id(),
                    'name' => $request->name,
                    'year' => $request->year,
                    'format' => $request->format,
                    'actor_fullname' => $request->actor_fullname,
                ]);

            return response()->json(['success' => $movie], 200);
        }

        return response()->json(['error' => 'Sorry. You can not update this movie'], 401);
    }


    public static function delete($id)
    {
        $user_id = Movie::find($id) ? Movie::find($id)->user_id : '';

        if($user_id == Auth::id()) {
            Movie::find($id)->delete();

            return response()->json(['success' => 'Movie is deleted'], 200);
        }
        return response()->json(['error' => 'Sorry. You can not delete this movie'], 401);
    }
}
