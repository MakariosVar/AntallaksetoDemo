@extends('layouts.layout')
@section('content')

<div class="container">
<?php// dd($post); ?>
        <form action="/p/{{ $post->id}}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')

        <div class='row'>
                <div class="col-8 offset-2">
                        <div class="row text-center">
                                <h1>Διαμόρφωση Αγγελίας</h1>
                        </div>

                        <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label">{{ __('Τίτλος') }}</label>

                    <input id="title" 
                            type="text"
                            class="form-control @error('title') is-invalid @enderror" 
                            name="title"
                            value="{{ old('title') ?? $post->title }}"  
                            autocomplete="title" 
                            autofocus>

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                
                </div>   
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label">{{ __('Περιγραφή') }}</label>

                    <input id="description" 
                            type="text"
                            class="form-control @error('description') is-invalid @enderror" 
                            name="description"
                            value="{{ old('description') ?? $post->description }}"  
                            autocomplete="description" 
                            autofocus>

                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                
                </div>   
                <div class="form-group row">
                    <label for="adlocation" class="col-md-4 col-form-label">{{ __('Τοποθεσία') }}</label>

                    <input id="adlocation" 
                            type="text"
                            class="form-control @error('adlocation') is-invalid @enderror" 
                            name="adlocation"
                            value="{{ old('adlocation') ?? $post->adlocation }}"  
                            autocomplete="adlocation" 
                            autofocus>

                    @error('adlocation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                
                </div>  
                <div class="form-group row">
                    <label for="category" class="col-md-4 col-form-label">{{ __('Κατηγορία') }}</label>

                    <input id="category" 
                            type="text"
                            class="form-control @error('category') is-invalid @enderror" 
                            name="category"
                            value="{{ old('category') ?? $post->category}}"  
                            autocomplete="category" 
                            autofocus>

                    @error('category')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                
                </div>  

                <div class="form-group row">
                    <label for="condition" class="col-md-4 col-form-label">{{ __('Κατάσταση') }}</label>

                    <input id="condition" 
                            type="text"
                            class="form-control @error('condition') is-invalid @enderror" 
                            name="condition"
                            value="{{ old('condition') ?? $post->condition}}"  
                            autocomplete="condition" 
                            autofocus>

                    @error('condition')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                
                </div> 
                <div class="form-group row">
                    <label for="phone" class="col-md-4 col-form-label">{{ __('Τηλέφωνο Επικοινωνίας') }}</label>

                    <input id="phone" 
                            type="text"
                            class="form-control @error('phone') is-invalid @enderror" 
                            name="phone"
                            value="{{ old('phone') ?? $post->phone}}"  
                            autocomplete="phone" 
                            autofocus>

                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                
                </div>  
                <div class="form-group row">
                    <label for="transferPref" class="col-md-4 col-form-label">{{ __('Προτίμηση Ανταλλαγής') }}</label>

                    <input id="transferPref" 
                            type="text"
                            class="form-control @error('transferPref') is-invalid @enderror" 
                            name="transferPref"
                            value="{{ old('transferPref') ?? $post->transferPref }}"  
                            autocomplete="transferPref" 
                            autofocus>

                    @error('transferPref')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                
                </div> 

               
              
               



                   
                <div class="row pt-4">
                    <button class="btn btn-primary ">Εκχώρηση</button>
                </div> 
            
                </div>
        </div>
        </form>


</div>
@endsection