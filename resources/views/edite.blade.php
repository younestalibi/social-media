@extends('layouts.app')

@section('content')




<div class="container w-75 ">
    <div class="row">
        <div class="col-5">
            <div class="row">
                <div class="col">Edite profile</div>
            </div>
            <div class="row my-3">
                <div class="col text-danger">Delete account</div>
            </div>
        </div>
        <div class="col-7">
            <form action="{{route('update',$user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <table class='w-100'>
                    <!-- image -->
                    <tr>
                        <td >
                            <!-- <img class="rounded-circle z-depth-2 border border-dark p-1" width='50'height='50'  src="/storage/{{$user->profile->image}}"data-holder-rendered="true"> -->
                            <img class='img-edite border border-dark' src='/storage/{{$user->profile->image}}' alt="post">
                        </td>
                        <td class="form-group">
                            <h4>{{auth()->user()->user_name}}</h3>
                            <input class="form-control w-50" type="file" name="image" id="image">
                        </td>
                    </tr>
                    <!-- name -->
                    <tr>
                        <td >
                        <label for="name" class="text-md-end">{{__('Name')}}</label>
                        </td>
                        <td>
                        <input id="name" type="text" class="w-75 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name}}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </td>
                    </tr>
                    <!-- username -->
                    <tr>
                        <td >
                        <label for="user_name" class="text-md-end">{{__('User name')}}</label>
                        </td>
                        <td>
                        <input id="user_name" type="text" class="w-75 form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') ?? $user->user_name}}" required autocomplete="user_name" autofocus>
                            @error('user_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </td>
                    </tr>
                    <!-- link -->
                    <tr>
                        <td >
                        <label for="link" class="text-md-end">{{__('Website')}}</label>
                        </td>
                        <td>
                        <input id="link" type="text" class="w-75 form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link') ?? $user->profile->link ?? 'N/A'}}"  autocomplete="link" autofocus>
                            @error('link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </td>
                    </tr>
                    <!-- bio -->
                    <tr>
                        <td >
                        <label for="description" class="text-md-end">{{__('Bio')}}</label>
                        </td>
                        <td>
                        <input id="description" type="text" class="w-75 form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $user->profile->description ?? 'N/A'}}"  autocomplete="description" autofocus>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </td>
                    </tr>
                    <!-- email -->
                    <tr>
                        <td >
                        <label for="email" class="text-md-end">{{__('Email')}}</label>
                        </td>
                        <td>
                        <input id="email" type="text" class="w-75 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class='btn btn-primary px-4' type="submit" value="Update">
                        </td>
                    </tr>
                </table>
               
            </form>

        </div>
    </div>

    
</div>








@endsection
