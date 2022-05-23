@extends('layouts.layout')
@section('content')


	@if(count($posts) > 0)
	<div class="mt-3">
		<div  style=" text-align: center; font-size:40px;"><strong>Οι Αγγελίες μου</strong>
		</div>      
	</div>
	<div class="card mb-3 content">
       	<section class="post-list">
             
	    	@foreach($posts as $post)
	    	<a href="../{{ $post->id }}" class="post">
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
	@else
	<div  style=" text-align: center; font-size:40px;"><strong>Δεν έχετε καταχωρήσει αγγελίες ακόμη</strong>
	<br>
	<a href="http://antallakseto.gr/p/create">Νέα αγγελία</a>
	</div>
	@endif
	


@endsection