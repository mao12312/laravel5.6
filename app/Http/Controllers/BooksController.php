<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Illuminate\Support\Facades\Auth;
use Validator;

class BooksController extends Controller
{
    //このクラスが呼ばれたら最初に処理する（ログインが必要）
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('/welcome');
    }

    //本の一覧画面
    public function dashboard()
    {
        $books = Book::where('user_id', Auth::user()->id)->orderBy('created_at', 'asc')->paginate(3);
        return view('/dashboard', [
            'books' => $books
        ]);
    }

    public function booksedit($book_id)
    {
        //view(viewの選択, 渡す値)
        $books =Book::where('user_id',Auth::user()->id)->find($book_id);
        return view('/booksedit', ['book' => $books]);
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
        $books->user_id = Auth::user()->id;
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published = $request->published;
        $books->save();
        return redirect('/dashboard');
    }

    //更新機能
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
        $books = Book::where('user_id',Auth::user()->id)->find($request->id);
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published = $request->published;
        $books->save();
        return redirect('/dashboard');
    }

    public function delete(Book $book)
    {
        $book->delete();
        return redirect('/dashboard');
    }


}
