@extends('layouts.layout')
@section('content')

<div class="container" style="min-height:700px;">

<form action="/profile/{{ $user->id}}" enctype="multipart/form-data" method="post">
      @csrf
      @method('PATCH')

      <div class='row '>
        <div class="col-8 offset-2 pb-3" >
            <div class="row  justify-content-center ">
               <p class="display-4">Διαμόρφωση Προφίλ</p>
            </div>


            
            <div class="form-group row">
                 <label for="description" class="col-md-4 col-form-label">Περιγραφή:</label>

               
                    <input id="description" 
                            type="text"
                            class="form-control @error('description') is-invalid @enderror" 
                            name="description"
                            value="{{ old('description') ?? $user->profile->description }}"  
                            autocomplete="description" 
                            autofocus>

                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                
            </div>   
           




            <div class="profile-pic-wrapper pt-5">
                <h2>Φωτογραφία Προφίλ</h2>
                <div class="pic-holder">
                     <!-- uploaded pic shown here -->
                    {{-- <img id="profilePic" class="pic" src="{{Auth::user()->profile->ProfileImage()}}"> --}}

                    <Input class="uploadProfileInput" type="file" name="image" id="newProfilePhoto" accept="image/*" style="opacity: 0;" />
                    <label for="newProfilePhoto" class="upload-file-block">
                    @error('image') 
                      <strong>{{ $errors->first('image') }}</strong>
                    @enderror
                        <div class="text-center">
                            <div class="mb-2">
                                <i class="fa fa-camera fa-2x"></i>
                            </div>

                            <div class="text-uppercase">
                                Νέα Φωτογραφία <br /> Προφίλ
                             </div>
                        </div>
                    </label>
                </div>
            </div>
         
            <div class="row pt-4 justify-content-center">
                <button class="btn btn-primary ">Αποθήκευση</button>
            </div>
        </div>
    </div>
    </form>


</div>
@endsection