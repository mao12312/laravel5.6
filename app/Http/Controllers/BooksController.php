<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Validator;

class BooksController extends Controller
{
    public function index(){
        return view('/welcome');
    }

    //本の登録画面
    public function dashboard()
    {
        $books = Book::orderBy('created_at', 'asc')->get();
        return view('books', [
            'books' => $books
        ]);
    }

    public function booksedit(Book $books)
    {
        //view(viewの選択, 渡す値)
        return view('booksedit', ['book' => $books]);
    }

//本の登録
    public function store(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|min:3|max:255',
            'item_number' => 'required|min:1|max:3',
            'item_amount' => 'required|max:6',
            'published' => 'required',
        ]);
        //validation error
        if ($validator->fails()) {
            return redirect('/dashboard')
                ->withInput()
                //varidatorのエラーをviewの中でerrorとして使えるようにしている
                ->withErrors($validator);
        }

        //Eloquent model
        //make instance
        $books = new Book;
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published = $request->published;
        $books->save();
        return redirect('/dashboard');
    }

    public function update(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'item_name' => 'required|min:3|max:255',
            'item_number' => 'required|min:1|max:3',
            'item_amount' => 'required|max:6',
            'published' => 'required',
        ]);
        //validation error
        if ($validator->fails()) {
            return redirect('/dashboard')
                ->withInput()
                //varidatorのエラーをviewの中でerrorとして使えるようにしている
                ->withErrors($validator);
        }
        //データの更新
        //find:主キーを指定して検索
        $books = Book::find($request->id);
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published = $request->published;
        $books->save();
        return redirect('/dashboard');
    }

    public function welcom()
    {
        return view('welcome');
    }

    public function delete(Book $book){
        $book->delete();
        return redirect('/dashboard');
    }


}
