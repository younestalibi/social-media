@extends('layouts.app')

@section('content')




<form action="/post" method='post' enctype="multipart/form-data">
@csrf
<div class="container w-50 m-auto">

    <div class="row m-5">
        <div class="col">
            <label for="description" class="text-md-end">{{__('Description')}}</label>
        </div>
        <div class="col">
        <input id="description" type="text" class="w-75 form-control @error('description')is-invalid @enderror" name="description" value="{{ old('description')}}" required autocomplete="description" autofocus>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>


    <div class="row m-5">
        <div class="col">
            <label for="post" class="text-md-end">{{__('upload image')}}</label>
        </div>
        <div class="col">
        <input id="post" type="file" class="w-75 form-control @error('post')is-invalid @enderror" name="post" value="{{ old('post')}}" required autocomplete="post" autofocus>
            @error('post')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row m-5">
        <div class="col">
            <input type="submit" value="upload" class='btn btn-success px-2'>
        </div>
    </div>
</div>
</form>













@endsection
