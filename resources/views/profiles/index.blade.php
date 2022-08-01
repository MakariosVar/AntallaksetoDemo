@extends('layouts.layout')
@section('content')
<div class="container">
 
    <div class="row">
      <div class="col-md-4 mt-1">
        <div class="card text-center sidebar">
          <div class="card-body">
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle" width="150">
            <div class="mt-3">
           
              @can('update', $user->profile)      
                <a href="/profile/{{$user->id}}/edit">Διαμόρφωση Προφίλ</a>
              @endcan
          
              
                @if( Auth::check() && !(Auth::user()->id == $user->id) )
                  <div>
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                  </div>
                @endif
            
              <div  style=" text-align: center;"> Posts: <strong>{{$postCount}}</strong></div>
              <div  style=" text-align: center;">Followers: <strong>{{$followersCount}}</strong> </div>
              <div  style=" text-align: center;">Following: <strong>{{$followingCount}}</strong> </div>
           
            </div>
          </div>
        </div>
        <div class="card text-center sidebar my-2">
          <div class="card-body">
            <h1>Αφήστε Σχόλιο</h1>

          <form action="/c/store" method="post">
            @csrf
            <div class="form-group row  justify-content-center">
                    <label for="comment" class="col-md-4 col-form-label"></label>

                    <input id="comment" 
                            type="text"
                            class="form-control @error('comment') is-invalid @enderror" 
                            name="comment"
                            value="{{ old('comment') }}"  
                            autocomplete="comment" 
                            autofocus>

                    @error('comment')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="row pt-4">
                    <button class="btn btn-dark ">Εκχώρηση</button>
                </div> 
            </div>  
          </form>
             
           
          
          </div>
        </div>
      </div>
      <div class="col-md-8 mt-1">
        <div class="card mb-3 content text-center">
          <h1 class="m-3 pt-3"> {{ $user->name}}</h1>
           <div class="card-body">
            <div class="row">
              <div class="col-md-3">
                <h5>Περιγραφή: </h5>
              </div>
              <div class="col-md-9 text-secondary">
              {{ $user->profile->description}}
              </div>
            </div>
          <hr>
          <div class="row">
            <div class="col-md-3">
              <h5>Εmail: </h5>
            </div>
            <div class="col-md-9 text-secondary">
            {{ $user->email }}
            </div>
          </div>
    
        
      </div>
    </div>
    <div class="mt-3">

        <div  style=" text-align: center; font-size:30px"><strong>Αγγελίες</strong></div>
        <hr>
            
           
    </div>

    <div class="card mb-3 content">
       <section class="post-list">
	    	@foreach($posts as $post)
	    	<a href="../p/{{ $post->id }}" class="post">
 	    		<figure class="post-image">
        			<img src="/storage/{{ $post->image0 }}">
      			</figure>
       		<span class="post-overlay">
         			<p>
           				<span style="color:white;">{{ $post->title}}</span>
       				
         			</p>
        		</span>
 	    	</a>
		
	    	@endforeach
    	</section>
    </div>


    <div class="mt-3">

        <div  style=" text-align: center; font-size:30px"><strong>Σχόλια</strong></div>
        <hr>
            
           
    </div>

    
    @foreach($user->profile->comments->sortByDesc("id") as $comment)
   
    <div class="card mb-3 content text-center">
          <a href="/profile/{{ $comment->user->id }}"><h3 class="blue">{{ $comment->user->name }}</h3></a>
          <p>
            <span >{{ $comment->comment}}</span>
          </p>
          <span style="font-size:13px;">{{ $comment->created_at }}</span>
          @if(Auth::id() == $comment->user_id)
							<form action="{{ route('comment.destroy', ['comment' => $comment->id]) }}" method="POST">
								 @csrf
								     
								 @method('DELETE')
								     
								<button type="submit" class="btn btn-link">Delete</button>
							</form>
							@endif  
 	    	
               
    </div>
	    	@endforeach
    	
  </div>
</div>



</div>
@endsection