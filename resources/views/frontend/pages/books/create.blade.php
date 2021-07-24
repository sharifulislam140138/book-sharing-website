@extends('frontend.layouts.app')

@section('styles')
      <!--select1-->
        <link href="{{asset('admin-asset/css/select2.min.css')}}" rel="stylesheet">

          <!--summernote-->
        <link href="{{asset('admin-asset/css/summernote.css')}}" rel="stylesheet">

@endsection

@section('content')

<div class="main-content">

  <div class="book-show-area">
    <h3>upload your book</h3>
 @if(Auth::check())
    <div class="container">
             <form action="{{route('books.store')}}"  enctype="multipart/form-data" method="post">
            
          @csrf


          <div class="row">
            <div class="col-md-6">
              <label for="">book title</label>
              <br>
              <input type="text" class="form-control" name="title" placeholder="book title" >
              
            </div>

            <div class="col-md-6">
              <label for="">book url text</label>
              <br>
              <input type="text" class="form-control" name="slug" placeholder="book url" >
              
            </div>

                  <div class="col-md-6">
              <label for="">book category</label>
              <br>
                 <select name="category_id" id="category_id" class="form-control">
                <option value="">select category</option>

                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
              </select>
              
            </div>


            <div class="col-md-6">
              <label for="">book publishers</label>
              <br>
                 <select name="publisher_id" id="publisher_id" class="form-control">
                <option value="">select publisher</option>

                @foreach($publishers as $publisher)
                <option value="{{$publisher->id}}">{{$publisher->name}}</option>
                @endforeach
              </select>
              
            </div>

            <div class="col-md-6">
              <label for="">book authors</label>
              <br>
                 <select name="author_ids[]" id="author_id" class="form-control select2" multiple>
                <option value="">select author</option>

                @foreach($authors as $author)
                <option value="{{$author->id}}">{{$author->name}}</option>
                @endforeach
              </select>
              
            </div>

             <div class="col-md-6">
              <label for="">book ISBN</label>
              <br>
           <input type="text" class="form-control" name="isbn" placeholder="book isbn" >
            </div>

                <div class="col-md-6">
              <label for="">book publication years</label>
              <br>
                 <select name="publish_id" id="publish_id" class="form-control">
                <option value="">select publish year</option>

                @for($year= date('Y'); $year >=1900; $year--)
                <option value="{{$year}}">{{$year}}</option>

                @endfor
              </select>
              
            </div>



                     <div class="col-md-6">
              <label for="image">book featured image</label>
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

                @foreach($books as $book)
                <option value="{{$book->id}}">{{$book->title}}</option>
                @endforeach
              </select>
              
            </div>
          
            

               <div class="col-12">
              <label for="summernote">book details</label>
              <br>
           <textarea name="description" id="summernote" cols="30" rows="5" class="form-control" placeholder="book description"></textarea>
               
            </div>
            
          </div>
             <div class="mt-4">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">update</button>
          
        </div>
        </form>
    </div>

 @else
 <div class="card card-body">
  <p>
    <a href="{{route('login')}}" class="btn btn-primary"></a>
  please login to upload your book
  </p>
   
 </div>


 @endif
  </div>

</div>
@endsection

@section('scripts')
    <!--select2-->
    <script src="{{asset('admin-asset/js/select2.min.js')}}"></script>
     <!--summernote-->
    <script src="{{asset('admin-asset/js/summernote.js')}}"></script>



   <script >
    $(document).ready( function () {
   
    $('.select2').select2();
    $('#summernote').summernote();
} );

    </script>

    @endsection