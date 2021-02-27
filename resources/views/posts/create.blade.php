@extends('layouts.app')

@section('content')
    <div class="container">

        <form action="/p" enctype="multipart/form-data" method="post">
        @csrf
            <div class='row'>
                <div class="col-8 offset-2">
        
                    <div class="row">
                        <h2>Add New Post</h2>
                    </div>

                <div class="form-group row">
                    <label for="caption" class="col-md-4 col-form-label">Posts Caption</label>
        
                    
                        <input id="caption"
                         type="text"
                         name="caption" 
                         class="form-control @error('caption') is-invalid
                         @enderror"
                         value="{{ old('caption') }}" required autocomplete="caption" autofocus>
        
                        @error('caption')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                   
                </div>
        
                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Image</label>

                    <input type="file" class="form-control-file" id="image" name="image">

                    @error('iamge')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
        
                <div class="row pt-4">
                    <button class="btn btn-primary">Add new Post</button>
                </div>

            </div>
        </form>
    
    </div>

@endsection
