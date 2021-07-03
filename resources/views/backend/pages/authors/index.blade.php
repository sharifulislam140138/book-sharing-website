@extends('backend.layouts.app')

@section('admin-content')

    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">manage authors</h1>


                            <a href="#addModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" ><i
                                class="fas fa-download fa-sm text-white-50" ></i> add author</a>

                     
                    </div>

           @include('backend.layouts.partials.messages')

                  

                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">add new author</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.authors.store')}}" method="get">
          @csrf

          <div class="row">
            <div class="col-12">
              <label for="">author name</label>
              <br>
              <input type="text" class="form-control" name="name" placeholder="author name" >
              
            </div>

               <div class="col-12">
              <label for="">author details</label>
              <br>
           <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="author description"></textarea>
               
            </div>
            
          </div>
             <div class="mt-4">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">update</button>
          
        </div>
        </form>
     
          
        ...
      </div>
    
    </div>
  </div>
</div>


             

                    <!-- Content Row -->

                    <div class="row">

                  <div class="col-sm-12">
                        <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">author list</h6>
                                </div>
                                <div class="card-body">
                              <table class="table " id="dataTable">
                                  <thead>
                                      <tr>
                                          <th>s1</th>
                                          <th>name</th>
                                          <th>link</th>
                                          <th>manage</th>
                                      </tr>
                                  </thead>
                                  <tbody>

                                    @foreach($authors as $author)
                                      <tr>
                                          <td>{{$loop->iteration}}</td>
                                          <td>{{$author->name}}</td>
                                          <td>{{$author->link}}</td>
                                          <td>
                                              <a href="#editModal{{$author->id}}" class="btn btn-success" data-toggle="modal"><i class="fa fa-edit"></i>edit</a>

                                               <a href="#deleteModal{{$author->id}}" class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash" ></i>delete</a>
                                          </td>
                                      </tr>

                  

                    <div class="modal fade" id="editModal{{$author->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">add new author</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.authors.update',$author->id )}}" method="get">
          @csrf

          <div class="row">
            <div class="col-12">
              <label for="">author name</label>
              <br>
              <input type="text" class="form-control" name="name" value="{{$author->name}}" placeholder="author name" >
              
            </div>

               <div class="col-12">
              <label for="">author details</label>
              <br>
           <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="author description">{{ $author->description }}</textarea>
               
            </div>
            
          </div>
             <div class="mt-4">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">update</button>
          
        </div>
        </form>
     
          
        ...
      </div>
    
    </div>
  </div>
</div>
              
      
                    <div class="modal fade" id="deleteModal{{$author->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">are you sure to delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.authors.delete',$author->id )}}" method="get">
          @csrf
          <div>

        {{$author->name}} will be deleted

        </div>
             <div class="mt-4">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
        <button type="submit" class="btn btn-primary">ok,confirm</button>
          
        </div>
        </form>
     
          
        ...
      </div>
    
    </div>
  </div>
</div>





 @endforeach
                                  </tbody>

                              </table>
                                </div>
                            </div>

                      

                  </div>
                    </div>

                 

@endsection