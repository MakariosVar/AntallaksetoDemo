@extends('layouts.layout')

@section('content') 

     <!-- banner section start -->
            <div class="layout_padding banner_section">
                    <div class="container">
                        <div class="row">
                            
                            <div class="col-sm-12">
                              
                                <h1 class="banner_taital" style=" text-align: center; color: red;"><span style="background: rgba(0, 0, 0, 0.6);"> <big>  Δώσε</big> ο,τι δεν χρειάζεσαι </span></h1>
                                <h2 class="banner_taital" style=" text-align: center; color: red;"><span style="background: rgba(0, 0, 0, 0.6);" > <big>  Βρες</big> ο,τι χρειάζεσαι </h2></span>
                                <p class="browse_text"><span style="background: rgba(0, 0, 0, 0.8);">Browse from more than 15,000,000 adverts while new ones come on daily bassis</span></p>
                                <div class="banner_bt">
                                    <a href="/info"><button class="read_bt">Πληροφορίες</button></a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
    <!-- banner section end -->  
    <br><br><br><br>
    <!-- search box start -->
            <div class="container">
                <div class="search_box" >
                <form action="/p/search" method="get">
                    <div class="row" style="display: flex; justify-content: center;">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input type="text" class="email_boton" placeholder="Ψάχνω για.." name="title">
                            </div>
                        </div>
                        <div class="text-center" style="max-width:300px;">
                            <select id="category" name="category" class="form-select"  aria-label="category">
                                <option value="Διάφορα" selected>Διάφορα</option>
                            <option value="Ρούχα">Ρούχα</option>
                            <option value="Παππούτσια">Παππούτσια</option>
                            <option value="Ηλεκτρικές Συσκευές">Ηλεκτρικές Συσκευές</option>
                            <option value="Ηλεκτρονικές Συσκευλες">Ηλεκτρονικές Συσκευές</option>
                            <option value="Έπιπλα">Έπιπλα</option>
                            <option value="Τρόφιμα">Τρόφιμα</option>
                            <option value="Οχήματα">Οχήματα</option>
                            <option value="Εργαλεία - Μηχανήματα">Εργαλεία - Μηχανήματα</option>
                            <option value="Αντίκες">Αντίκες</option>
                            <option value="Συλλεκτικά">Συλλεκτικά</option>
                            <option value="Συλλογές">Συλλογές</option>
                            <option value="Βιβλία">Βιβλία</option>
                            <option value="Παιχνίδια">Παιχνίδια</option>
                            <option value="Είδη μωρού">Είδη μωρού</option>
                            <option value="Είδη Κατοικιδίου">Είδη Κατοικιδίου</option>
                            <option value="Είδη Αθλητισμού">Είδη Αθλητισμού</option>
                            <option value="Χειροποίητα Αντικέιμενα">Χειροποίητα Αντικέιμενα</option>
                            <option value="Είδη Σπιτιού">Είδη Σπιτιού</option>
                            <option value="Είδη Κήπου">Είδη Κήπου</option>
                            <option value="Κοσμήματα">Κοσμήματα</option>
                            <option value="Ακίνητα">Ακίνητα</option> 
                        </select>
                        <span class="h6 ">Στην Κατηγορία</span>
                            
                        </div>
                      
                        <div class="col-sm-3">
                            <div class="form-group">
                                <button class="search_bt">Αναζήτηση</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

	<!-- search box end -->

    <!-- section PROMOTED start -->



			
	<div class="container pb-5"  >
	<div class="row p-2"> <h1 class="promoted_text"><span style="border-bottom: 5px solid red;">Προωθημένες Αγγελίες </span></h1>
	</div>

	 
	 <section class="post-list">
		@foreach($posts as $post)
        @if($post->premium == 1)
		<a href="p/{{ $post->id }}" class="post">
 			<figure class="post-image">
     			<img src="/storage/{{ $post->image0 }}">
   			</figure>
    		<span class="post-overlay ">
			<div class="d-inline-block">
		 	<h5>	
			        <span style="color:white; ">{{ $post->title}}</span>	
     			</h5>
			     <p>
			    	<span style="color:white; ">Περιοχή : </span>
			 	<span style="color:white; font-size:13px;">{{ $post->adlocation}}</span>
			     </p>
			</div>
		</span>
 		</a>
		@endif
		@endforeach
	</section>


       
    
</div>



	<!-- section PROMOTED end -->


    <!-- about section start -->


    <div class="layout_padding about_section">
    	<div class="container">
    		<div class="row">
    			<div class="col-sm-12">
    				<h1 class="about_taital">Σχετικά με το Antallakseto.gr</h1>
    				<p class="lorem_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to</p>
    			</div>
    		</div>
    	</div>
    </div>


	<!-- about section end -->




    <!-- contact section start -->


    <div class="contact_section layout_padding">
    	<div class="container-fluid">
            <h1 style="text-align:center; color:white;"> Επικοινωνήστε μαζί μας</h1>
    		<div class="row">
    			<div class="col-md-6">
                    <div class="input_main">
                        <div class="container">
                          <form action="/">
                            <div class="form-group">
                                <input type="text" class="email-bt" placeholder="Όνομα " name="Name">
                            </div>
                            <div class="form-group">
                              <input type="text" class="email-bt" placeholder="Email" name="Email">
                            </div>
                            <form action="/action_page.php">
                                <div class="form-group">
                                  <textarea class="massage-bt" placeholder="Μήνυμα" rows="5" id="comment" name="text"></textarea>
                                </div>
                                <div>
                                    <button class="search_bt">Αποστολή</button>
                                </div>
                            </form>
                          </form>
                       </div> 
                    </div>
                </div>
    			<div class="col-md-6">
                    <div class="map-responsive">
                        <iframe src="https://maps.google.com/maps?q=greece&t=&z=5&ie=UTF8&iwloc=&output=embed" width="600" height="450" frameborder="0" style="border:0; width: 100%;" allowfullscreen></iframe>
                    </div>
    			</div>
    		</div>
    	</div>
    </div>


	<!-- contact section end -->


   



@endsection