@extends('layouts.layout')
@section('content')
<div class="container"  >

        <div class="row m-2 rounded" 
	    style="	justify-content: center; 
				padding: 20px;
				max-height:auto;
				overflow:hidden;
				background-color: #F5FFFA;"
				>
					<div class="d-flex">
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


						<div style="position: relative;">


							<h1 style="margin: 20px">{{ $post->title}}</h1>

							<p><a href="/chat/{{ $post->user_id }}" target=”_blank”>Στείλτε μήνυμα</a></p>

							<p><small><strong> Περιγραφή  : </strong>{{ $post->description}}</small></p>
						
							<p><small><strong>Περιοχή:</strong> {{ $post->adlocation}}</small></p>
							<p><small><strong>Κατηγορία:</strong> {{ $post->category}}</small></p>
							<p><small><strong>Κατάσταση:</strong> {{ $post->condition}}</small></p>
							<p><small><strong>Ανταλλαγή για:</strong> {{ $post->transferPref }}</small></p>
							<p><small><strong>Του Χρήστη:</strong><a href="/profile/{{$post->user_id}}">  {{ $post->user->name }}</a></small></p>
							<p><small><strong>Email:</strong>  {{ $post->user->email }}</small></p>
							<p><small><strong>Τηλέφωνο:</strong>  {{ $post->phone }}</small></p>
							<p><small><strong>Ημερομηνία:</strong> {{ $post->created_at }}</small></p>
							
							@if(Auth::id() == $post->user_id)      
							<p><a href="/p/{{$post->id}}/edit">Διαμόρφωση Aγγελίας</a></p>
             						@endif

							@if(Auth::id() == $post->user_id)
							<form action="{{ route('post.destroy', ['post' => $post->id]) }}" method="POST">
								 @csrf
								     
								 @method('DELETE')
								     
								<button type="submit" class="btn btn-danger ml-3">Διαγραφή Αγγελίας</button>
							</form>
							@endif  
	
                        			</div>
					</div>
        </div>	
 	


</div>
@endsection
