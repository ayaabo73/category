  <form action="{{route('category.store') }}" method="POST'>
             @csrf
            @method('POST')
                     <input type="text"  name="name" placeholder="name" class="@error('name') is-invalid @enderror" ><br><br>
                         
                      @error('name')
                     <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
                                
                <button type="submit">save</button>
            
            </form>
   