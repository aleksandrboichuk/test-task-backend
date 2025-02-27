@extends('layouts.main')

@section('title', 'Sign Up')

@section('style')
    <link rel="stylesheet" href="/css/login.css">
@endsection

@section('content')
    <div class="signup-form mt-20">
        <form action="{{route('register')}}" method="POST">
            @csrf
            <h2>Create Account</h2>
            <p class="lead"></p>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" name="username" value="{{old('username')}}" placeholder="Username" required="required">
                </div>

            </div>
            @error('username')
            <div class="form-text text-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-paper-plane"></i></span>
                    <input type="phone" class="form-control" name="phone" placeholder="Phone Number" value="{{old('phone')}}" required="required">
                </div>
            </div>
            @error('phone')
            <div class="form-text text-danger">{{ $message }}</div>
            @enderror
            @error('system')
            <div class="form-text text-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-lg">Sign Up</button>
            </div>
        </form>
    </div>
@endsection
