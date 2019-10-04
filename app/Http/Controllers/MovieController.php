<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Services\MovieService;

class MovieController extends Controller
{


    public function movies()
    {
        $movies = Movie::all();

        return response()->json(['success' => $movies], 200);
    }


    public function getMovie($id)
    {
        $movie = Movie::find($id);

        if(isset($movie) and !empty($movie)) {
            return response()->json(['success' => $movie], 200);
        }

        return response()->json(['error' => 'Sorry. Movie is not finded'], 401);
    }


    public function search(Request $request)
    {
        $movie = MovieService::getMovieByNameOrFullName($request);

        if(!$movie->isEmpty()) {
            return response()->json(['success' => $movie], 200);
        }

        return response()->json(['error' => 'Sorry. Movie is not finded'], 401);
    }


    public function addMovie(Request $request)
    {
        if(MovieService::validateMovie($request) != false){
            $movie = MovieService::createMovie($request);

            return response()->json(['success' => $movie], 200);
        }

        return response()->json(['error' => 'Sorry. Movie is not created'], 401);
    }


    public function editMovie(Request $request, $id)
    {
        return MovieService::updateMovie($request, $id);
    }


    public function deleteMovie($id)
    {
        return MovieService::delete($id);
    }
}
