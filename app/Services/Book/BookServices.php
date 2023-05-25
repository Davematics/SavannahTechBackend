<?php
namespace App\Services\Book;

use App\Models\Book;
use Illuminate\Support\Str;

class BookServices
{
    public function getAll()
    {
        return new Book();
    }
    public function store($request)
    {
        $book = new Book();
        $book->title = $request->title;
        $book->price = $request->price;
        $book->description = $request->description;
        $book->author_id = $request->author_id;
        $book->user_id = auth()->user()->id;
        $book->slug = Str::slug($request->title);
        //upload cover photo
        $fileName = $book->slug . '.' . $request->cover_photo->extension();
        $request->cover_photo->move(public_path('books/cover_photo'), $fileName);

        $book->cover_photo = 'books/cover_photo/' . $fileName;
        $book->save();

        return $book;
    }

    public function findBook($id)
    {
        return Book::where('id', $id);
    }

    public function update($request, $id)
    {
        $book = $this->findBook($id)->first();

        $book->title = $request->title;
        $book->price = $request->price;
        $book->description = $request->description;
        $book->author_id =  $request->author_id;
        $book->user_id = auth()->user()->id;
        $book->slug = Str::slug($request->title);

        $book->save();

        return $book;
    }

    public function destory($id)
    {
        return $this->findBook($id)->delete();
    }
}
