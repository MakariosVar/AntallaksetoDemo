@extends('layouts.layout')
@section('content') 

<div class="container p-5">
    <form action="/p/search" method="get">

    <div class="row text-center" style="display: flex; justify-content: center; align-items: center; flex-direction: column; ">
                   
           <span class="h2 underline" style="text-decoration-color: red;">Βρείτε τις αγγελίες που σας ενδιαφέρουν</span>
    
                
                        <div class="col-sm-4 py-5">
                            <div class="form-floating text-center">
                                <input type="text" class="form-control" placeholder="Ψάχνω για.." name="title">
                                <label for="title"><span class="h5" >Ψάχνω για....</span></label>
                            </div>
                        </div>
                        
                      
                        
                        <label for="category" class="col-md-4 col-form-label"><span class="h4">Στην Κατηγορία</span></label>
                        <div style="max-width:300px; max-height:3000px;">
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
                            
                        </div>
  
                        <div class="col-3 p-5">
                            <div class="form-group">
                                <button class="search_bt">Αναζήτηση</button>
                            </div>
                        </div>
                        
</div>
@endsection
                    