{{--update用ページ--}}

@extends('layouts.content_base')

@section('title')
    book update
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('common.errors')
            <form action="{{ url('books/update') }}" method="POST" class="form-horizontal">

                <!-- item_name -->
                <div class="form-group">
                    <label for="item_name" class="col-sm-3 control-label" >Title</label>
                    <div class="col-sm-6">
                        <input type="text" id="item_name" name="item_name" class="form-control" value="{{$book->item_name}}">
                    </div>
                </div>
                <!--/ item_name -->

                <!-- item_number -->
                <div class="form-group">
                    <label for="item_number" class="col-sm-3 control-label">Number</label>
                    <div class="col-sm-6">
                    <input type="text" id="item_number" name="item_number" class="form-control" value="{{$book->item_number}}">
                    </div>
                </div>
                <!--/ item_number -->

                <!-- item_amount -->
                <div class="form-group">
                    <label for="item_amount" class="col-sm-3 control-label">Amount</label>
                    <div class="col-sm-6">
                    <input type="text" id="item_amount" name="item_amount" class="form-control" value="{{$book->item_amount}}">
                    </div>
                </div>
                <!--/ item_amount -->

                <!-- published -->
                <div class="form-group">
                    <label for="published" class="col-sm-3 control-label">published</label>
                    <div class="col-sm-6">
                    <input type="datetime" id="published" name="published" class="form-control" value="{{$book->published}}"/>
                    </div>
                </div>
                <!--/ published -->

                <!-- Saveボタン/Backボタン -->
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ url('/dashboard') }}">
                        <i class="glyphicon glyphicon-backward"></i>  Back
                    </a>
                </div>
                <!--/ Saveボタン/Backボタン -->

                <!-- id値を送信 -->
                <input type="hidden" name="id" value="{{$book->id}}" />
                <!--/ id値を送信 -->

                <!-- CSRF -->
            {{ csrf_field() }}
            <!--/ CSRF -->

            </form>
        </div>
    </div>
@endsection
