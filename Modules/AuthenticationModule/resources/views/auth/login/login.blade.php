@extends('authenticationmodule::layouts.master')
@section('content')
    <div class="container-fluid bg-dark">
        <div class="d-flex align-items-center justify-content-center" style="height: 100vh">
            <form action="{{  route('login') }}" method="POST" style="width: 500px">
                @csrf
                @method('POST')
                <div class="group-form mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="group-form mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="group-form mb-3">
                    <button type="submit" class="btn btn-success btn-sm">LOGIN</button>
                </div>
            </form>
        </div>
    </div>
@endsection