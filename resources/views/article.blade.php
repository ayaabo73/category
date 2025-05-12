<h1>creat new article<h1>

             <form action="{{route('store') }}" method="get'>
             @csrf
            
                     <input type="text"  name="title" placeholder="title"><br><br>
                         
                     <textarea  name="body" placeholder="body" ></textarea><br><br>
                     
                   
						
						<select class="form-select" aria-label="Default select example" name="category_ids"  multiple  >
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
   