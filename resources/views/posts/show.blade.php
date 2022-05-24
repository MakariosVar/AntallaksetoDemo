@extends('layouts.layout')
@section('content')
<div class="container"  >

        <div class="row m-2 rounded pageMinFit">
					<div class="row d-flex nowrap w-100 justify-content-center">
						<div >
							<div><a href="javascript:history.back()"><-Πίσω</a></div>
							<img src="/storage/{{ $post->image0 }}"  
							style=" height: auto;
  								width: 299px;" >
							<div>
								@if($post->image1)
								<img src="/storage/{{ $post->image1 }}"  
								style=" height: auto;
  								width: 147px;" >
								@endif
								@if($post->image2)
								<img src="/storage/{{ $post->image2 }}"  
								style=" height: auto;
  								width: 147px;" >
								@endif
							</div>
							<div>
								@if($post->image3)
								<img src="/storage/{{ $post->image3 }}"  
								style=" height: auto;
  								width: 147px;" >
								@endif
								@if($post->image4)
								<img src="/storage/{{ $post->image4 }}"  
								style=" height: auto;
  								width: 147px;" >
								@endif
							</div>
						</div>


						<div class="w-100" style="position: relative; max-width: 700px;">

							
							<p class="postText"> <strong>{{ $post->title}}</strong></p>

							

							<p class="postText"><small><strong> Περιγραφή  : </strong>{{ $post->description}}</small></p>
						
							<p class="postText"><small><strong>Περιοχή:</strong> {{ $post->adlocation}}</small></p>
							<p class="postText"><small><strong>Κατηγορία:</strong> {{ $post->category}}</small></p>
							<p class="postText"><small><strong>Κατάσταση:</strong> {{ $post->condition}}</small></p>
							<p class="postText"><small><strong>Ανταλλαγή για:</strong> {{ $post->transferPref }}</small></p>
							<p class="postText"><small><strong>Του Χρήστη:</strong><a href="/profile/{{$post->user_id}}">  {{ $post->user->name }}</a></small></p>
							<p class="postText"><small><strong>Email:</strong>  {{ $post->user->email }}</small></p>
							<p class="postText"><small><strong>Τηλέφωνο:</strong>  {{ $post->phone }}</small></p>
							<p class="postText"><small><strong>Ημερομηνία:</strong> {{ $post->created_at }}</small></p>
							
							@if(Auth::id() == $post->user_id)      
							<div class="text-center">
								<p><a href="/p/{{$post->id}}/edit">Διαμόρφωση Aγγελίας</a></p>
							</div>
             						@endif

							@if(Auth::id() == $post->user_id)
							<form action="{{ route('post.destroy', ['post' => $post->id]) }}" method="POST">
								@csrf
								     
								@method('DELETE')
								<div class="text-center">
									<button type="submit" class="btn btn-danger ml-3">Διαγραφή Αγγελίας</button>
								</div>
							</form>
							@endif  
	
                        			</div>
					</div>
        </div>	
 	


</div>
@endsection
