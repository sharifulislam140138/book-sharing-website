@extends('backend.layouts.app')

@section('admin-content')

    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">edit books {{$book->title}}</h1>


                         
                     
                    </div>

           @include('backend.layouts.partials.messages')

                  

     <div class="row">
      <div class="col-md-12">
           <form action="{{route('admin.books.store')}}"  enctype="multipart/form-data" method="post">
            
          @csrf


          <div class="row">
            <div class="col-md-6">
              <label for="">book title</label>
              <br>
              <input type="text" class="form-control" name="title" placeholder="book title" value="{{$book->title}}">
              
            </div>

            <div class="col-md-6">
              <label for="">book url text</label>
              <br>
              <input type="text" class="form-control" name="slug" placeholder="book url" value="{{$book->slug}}" >
              
            </div>

                  <div class="col-md-6">
              <label for="">book category</label>
              <br>
                 <select name="category_id" id="category_id" class="form-control">
                <option value="">select category</option>

                @foreach($categories as $category)
                <option value="{{$category->id}}" {{$book->category_id==$category->id? 'selected' :''}}>{{$category->name}}</option>
                @endforeach
              </select>
              
            </div>


            <div class="col-md-6">
              <label for="">book publishers</label>
              <br>
                 <select name="publisher_id" id="publisher_id" class="form-control">
                <option value="">select publisher</option>

                @foreach($publishers as $publisher)
                <option value="{{$publisher->id}}"  {{$book->publisher_id==$publisher->id? 'selected' :''}}>{{$publisher->name}}</option>
                @endforeach
              </select>
              
            </div>

            <div class="col-md-6">
              <label for="">book authors</label>
              <br>
                 <select name="author_ids[]" id="author_id" class="form-control select2" multiple>
                <option value="">select author</option>

                @foreach($authors as $author)
                <option value="{{$author->id}}" {{App\Book::isAuthorSelected($book->id, $author->id) ?'selected': ''}}>{{$author->name}}</option>
                @endforeach
              </select>
              
            </div>

             <div class="col-md-6">
              <label for="">book ISBN</label>
              <br>
           <input type="text" class="form-control" name="isbn" placeholder="book isbn" value="{{$book->isbn}}" >
            </div>

                <div class="col-md-6">
              <label for="">book publication years</label>
              <br>
                 <select name="publish_id" id="publish_id" class="form-control">
                <option value="">select publish year</option>

                @for($year= date('Y'); $year >=1900; $year--)
                <option value="{{$year}}"  {{$book->publish_year==$year? 'selected' :''}}>{{$year}}</option>

                @endfor
              </select>
              
            </div>



                     <div class="col-md-6">
              <label for="image">book featured image(optional) <a href="{{asset('images/books/'.$book->image)}}">old image</a></label>
              <br>
          <input type="file" name="image" id="image" class="form-control" required>
               
            </div>
            <div class="col-md-6">
              
            </div>


                 <div class="col-md-6">
              <label for="translator_id">book translator</label>
              <br>
                 <select name="translator_id" id="translator_id" class="form-control select2">
                <option value="">select translator</option>

                @foreach($books as $tb)
                <option value="{{$tb->id}}" {{$tb->id==$book->translator_id ?'selected' : ''}}>{{$book->title}}</option>
                @endforeach
              </select>
              
            </div>
          
            

               <div class="col-12">
              <label for="summernote">book details</label>
              <br>
           <textarea name="description" id="summernote" cols="30" rows="5" class="form-control" placeholder="book description">{!!$book->description!!}</textarea>
               
            </div>
            
          </div>
             <div class="mt-4">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">update</button>
          
        </div>
        </form>
        
      </div>
       
     </div>

                 

@endsection