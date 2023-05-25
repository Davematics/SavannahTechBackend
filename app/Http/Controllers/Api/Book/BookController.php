<?php

namespace App\Http\Controllers\Api\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Services\Book\BookServices;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    protected BookServices $bookServices;
    public function __construct(BookServices $bookServices)
    {
        $this->bookServices = $bookServices;
    }

    public function index()
    {
        $books = $this->bookServices->getAll()->with('author','user')->get();
        return $this->success('Books fetched', $books, Response::HTTP_OK);
    }

    public function store(StoreRequest $request)
    {
        $book = $this->bookServices->store($request);

        return $this->success('Book stored successfully', $book, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $book = $this->bookServices->findBook($id)->with('author','user')->firstOrFail();

        return $this->success('book found', $book, Response::HTTP_OK);
    }

    public function update(UpdateBookRequest $request, $id)
    {
        $book = $this->bookServices->update($request, $id);

        return $this->success('Book updated successfully', $book, Response::HTTP_CREATED);
    }

    public function destory($id)
    {
        $book = $this->bookServices->destory($id);

        return $this->success('Book Deleted', $book, Response::HTTP_CREATED);
    }
}
