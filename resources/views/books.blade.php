@extends('layouts.content_base')

@section('title')
    book list
@endsection

@section('content')

    {{--bootstrapの定型コード--}}
    <div class="panel-body">
        {{--display validation error--}}
        @include('common.errors')

        {{--register book--}}
        <form action="{{url('books')}}" method="POST" class="form-horizontal">

            {{csrf_field()}}

            {{--book title--}}
            <div class="form-group">
                <label for="book" class="col-sm-3 control-label">Title</label>
                <div class="col-sm-6">
                    <input type="text" name="item_name" id="book-name" class="form-control">
                </div>
            </div>

            {{--register book_number --}}
            <div class="form-group">
                <label for="book" class="col-sm-3 control-label">Number</label>
                <div class="col-sm-6">
                    <input type="text" name="item_number" id="book-number" class="form-control">
                </div>
            </div>

            {{--register book_amount --}}
            <div class="form-group">
                <label for="book" class="col-sm-3 control-label">Amount</label>
                <div class="col-sm-6">
                    <input type="text" name="item_amount" id="book-amount" class="form-control">
                </div>
            </div>

            {{--register publish --}}
            <div class="form-group">
                <label for="book" class="col-sm-3 control-label">Publish</label>
                <div class="col-sm-6">
                    <input type="text" name="published" id="published" class="form-control">
                </div>
            </div>


            {{--register book button--}}
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus"></i> Save
                    </button>
                </div>
            </div>

        </form>


        @if(count($books)>0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    投稿
                </div>
                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                        <th>投稿一覧</th>
                        <th>&nbsp;</th>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td class="table-text">
                                    <div>{{$book->item_name}}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{$book->item_number}}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{$book->item_amount}}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{$book->published}}</div>
                                </td>

                                {{--更新ボタン--}}
                                <td>
                                    <form action="{{url('booksedit/'.$book->id)}}" method="POST">
                                        {{csrf_field()}}
                                        <button type="submit" class="btn btn-primary">
                                            <i class="glyphicon glyphicon-pencil"></i>Update
                                        </button>
                                    </form>
                                </td>
                                {{--削除ボタン--}}
                                <td>
                                    <form action="{{url('book/'.$book->id)}}" method="POST">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}

                                        <button type="submit" class="btn btn-danger">
                                            <i class="glyphicon glyphicon-trash"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
