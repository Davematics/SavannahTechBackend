<?php

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use App\Services\Author\AuthorServices;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    protected AuthorServices $authorServices;
    public function __construct(AuthorServices $authorServices)
    {
        $this->authorServices = $authorServices;
    }


    public function index()
    {
        $books = $this->authorServices->getAll()->get();
        
        return $this->success('Author fetched', $books, Response::HTTP_OK);
    }

}
