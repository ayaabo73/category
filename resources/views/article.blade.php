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

   