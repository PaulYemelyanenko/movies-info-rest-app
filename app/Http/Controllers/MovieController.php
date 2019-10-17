<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Services\MovieService;

class MovieController extends Controller
{
    protected $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function movies()
    {
        return response()->json(['success' => $this->movie->all()], 200);
    }


    public function getMovie($id)
    {
        if($this->movie->find($id) !== null){

            return response()->json(['success' => $this->movie->find($id)], 200);

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
