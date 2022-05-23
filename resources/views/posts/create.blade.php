@extends('layouts.layout')
@section('content') 

 <div class="container p-5">
    <form action="/p/store" enctype="multipart/form-data" method="post">
    @csrf

    <div class='row'>
        <div class="col-8 offset-2">
            <div class="d-flex"  style="justify-content: center;"><h1 class="text-align-center">Προσθέστε νέα αγγελία</h1></div>
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label">{{ __('Τίτλος') }}</label>

                    <input id="title" 
                            type="text"
                            class="form-control @error('title') is-invalid @enderror" 
                            name="title"
                            value="{{ old('title') }}"  
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
                            value="{{ old('description') }}"  
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
                            value="{{ old('adlocation') }}"  
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

                        <select id="category" name="category">
                            <option value="Διάφορα">Διάφορα</option>
                            <option value="Ρούχα">Ρούχα</option>
                            <option value="Παππούτσια">Παππούτσια</option>
                            <option value="Ηλεκτρικές Συσκευές">Ηλεκτρικές Συσκευές</option>
                            <option value="Ηλεκτρονικές Συσκευλες">Ηλεκτρονικές Συσκευλες</option>
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

                <div class="form-group row">
                    <label for="condition" class="col-md-4 col-form-label">{{ __('Κατάσταση') }}</label>

                        <select id="condition" name="condition">
                            <option value="Καινούριο">Καινούριο</option>
                            <option value="Μεταχειρισμένο">Μεταχειρισμένο</option>
                            <option value="Με φθορές">Με φθορές</option>
                        </select>
                </div> 
                
                <div class="form-group row">
                    <label for="phone" class="col-md-4 col-form-label">{{ __('Τηλέφωνο Επικοινωνίας') }}</label>

                    <input id="phone" 
                            type="text"
                            class="form-control @error('phone') is-invalid @enderror" 
                            name="phone"
                            value="{{ old('phone') }}"  
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
                            value="{{ old('transferPref') }}"  
                            autocomplete="transferPref" 
                            autofocus>

                    @error('transferPref')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                
                </div> 

               
                <input type="checkbox" class="form-check-input" name="premium" value="0">
                <label for="premium"> Premium </label><br>


                 <!-- IMAGE 0 -->
                <div class="row">
                    <label for="image0" class="col-md-4 col-form-label">Προσθήκη Φωτογραφίας 1 (Απαραίτητη τουλαχιστον μια Φωτογραφια)</label>

                    <input type="file" class="form-control-file" id="image0" name="image0">

                    @error('image0') 
                    <strong>{{ $errors->first('image0') }}</strong>
                    @enderror
                </div>   
                        <!-- IMAGE 1 -->
                <div class="row">
                        <label for="image1" class="col-md-4 col-form-label">Προσθήκη Φωτογραφίας 2</label>

                        <input type="file" class="form-control-file" id="image1" name="image1">

                        @error('image1') 
                    <strong>{{ $errors->first('image1') }}</strong>
                    @enderror
                </div> 
                
                    <!-- IMAGE 2 -->   
                <div class="row">
                    <label for="image2" class="col-md-4 col-form-label">Προσθήκη Φωτογραφίας 3</label>

                    <input type="file" class="form-control-file" id="image2" name="image2">

                    @error('image2') 
                    <strong>{{ $errors->first('image2') }}</strong>
                    @enderror
                </div>
                
                    <!-- IMAGE 3 -->   
                <div class="row">
                    <label for="image3" class="col-md-4 col-form-label">Προσθήκη Φωτογραφίας 3</label>

                    <input type="file" class="form-control-file" id="image3" name="image3">

                    @error('image3') 
                    <strong>{{ $errors->first('image3') }}</strong>
                    @enderror
                </div>
               
                 <!-- IMAGE 4 -->   
                <div class="row">
                    <label for="image4" class="col-md-4 col-form-label">Προσθήκη Φωτογραφίας 3</label>

                    <input type="file" class="form-control-file" id="image4" name="image4">

                    @error('image4') 
                    <strong>{{ $errors->first('image4') }}</strong>
                    @enderror
                </div>




                   
                <div class="row pt-4">
                    <button class="btn btn-primary ">Εκχώρηση</button>
                </div> 
            </div>
        </div>
    </div>
    </form>
</div>
           
@endsection
