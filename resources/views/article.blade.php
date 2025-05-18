<h1>creat new article<h1>
 
             <form action="{{route('store') }}" method="get'>
             @csrf
            
                     <input type="text"  name="title" placeholder="title"  class="@error('title') is-invalid @enderror">
                     @error('title')
                     <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
                     <br><br>
                         
                     <textarea  name="body" placeholder="body"  class="@error('body') is-invalid @enderror"></textarea><br><br>
                     
                    @error('body')
                     <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
						
						<select class="form-select" aria-label="Default select example" name="category_ids" class="@error('category_ids') is-invalid @enderror"  multiple  >
               @error('category_ids')
                     <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
                        <option selected >Open this select menu</option>
                           @foreach ($categorys as $category )
                        <option value="{{ $category ->id }}" >{{ $category ->name }}</option>
                        @endforeach
                        </select>
                      <br><br>
                <button type="submit">save</button>
                <br><br>
            
                <a href= {{ url('/category') }}> اضافة تصنيف جديد</a>

            </form>
              @foreach ($articales as $articale )
        

     <table class="table">
      <thead>
    <tr>
      <th scope="id">{{ $articale->id }}</th>
      <th scope="title">{{ $articale->title}}</th>
       <th scope="body">{{ $articale->body }}</th>
          @foreach ($articale->categories as $category )
         <th scope="category">{{ $category->name}}</th>
         @endforeach
      
    </tr>
   </thead>
   </table>
              @endforeach
   