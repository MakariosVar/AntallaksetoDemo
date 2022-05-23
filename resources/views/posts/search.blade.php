@extends('layouts.layout')
@section('content') 


@if(count($posts) == 0)
<div class="text-center" style="min-height:700px;">
	<p style="font-size:40px">
		Κανένα Αποτέλεσμα
	</p>
	<h3>Δώστε Διαφορετικά Στοιχεία <a href="/find">αναζήτησης</a></h3>
	<h4>Ή Δείτε <a href="/p">Όλες τις Αγγελίες</a></h4>
</div>
@else
<section class="u-clearfix u-gradient" id="sec-64c3" style="min-height:700px;">
      <div class="u-clearfix u-sheet u-sheet-1">
	      <div class="text-center">
		      <h1 class="u-align-center u-text u-text-1">Όλες οι αγγελίες</h1>
	      </div>
        <div class="u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="u-layout-row">
              <div class="u-align-center u-container-style u-layout-cell u-size-12 u-layout-cell-1">
                <div class="u-container-layout u-container-layout-1">
                  <div class="u-expanded-width u-form u-form-1 pr-5">
                    <form action="/p/search" method="GET"  >
                      
                      
                      <div class="u-form-group u-form-name u-label-top">
                        <label for="title" class="u-label">Αναζήτηση</label>
                        <input type="text" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white form-control" placeholder="Ψάχνω για.." name="title">
                      </div>


                      <div class="u-form-group u-label-top">
                        <label for="category" class="u-label">Κατηγορία</label>
                        <select id="category" name="category"  class="form-select form-control form-control-lg"  aria-label="category">
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
                      </div>
                      
                      <div class="u-align-center u-form-group u-form-submit u-label-top">
		      		<div class="form-group">
                      		  	<button class=" u-border-2 u-border-black u-btn u-btn-submit u-button-style u-hover-black u-none u-text-black u-text-hover-white u-btn-1">Αναζήτηση</button>
                     		 </div>
		      </div>
                    
                    </form>
                  </div>
                </div>
              </div>
              <div class="u-container-style u-layout-cell u-size-48 u-layout-cell-2">
                <div class="u-container-layout u-container-layout-2 p-5 u-border-1">

		<section class="post-list">
		@foreach($posts as $post)
		<a href="/p/{{ $post->id }}" class="post">
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
		
		@endforeach
	</section>

		</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> 

@endif
@endsection
