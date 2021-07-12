@extends('backend.layouts.app')

@section('admin-content')

    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">manage books</h1>


                            <a href="{{route('admin.books.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"  ><i
                                class="fas fa-download fa-sm text-white-50" ></i> add books</a>

                     
                    </div>

           @include('backend.layouts.partials.messages')

                  



             

                    <!-- Content Row -->

                    <div class="row">

                  <div class="col-sm-12" class="form-control">
                        <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">book list</h6>
                                </div>
                                <div class="card-body">
                              <table class="table " id="dataTable">
                                  <thead>
                                      <tr>
                                          <th>s1</th>
                                          <th>name</th>
                                          <th>url</th>
                                          <th>category</th>
                                           <th>publisher</th>
                                            <th>statistics</th>
                                             <th>status</th>
                                           <th>Manage</th>
                                      </tr>
                                  </thead>
                                  <tbody>

                                    @foreach($books as $book)
                                      <tr>
                                          <td>{{$loop->iteration}}</td>
                                          <td>{{$book->title}}</td>
                                          <td>
                                            <a href="{{route('books.show', '$book->slug')}}" target="blank">{{route('books.show',$book->slug)}}</a>
                                          </td>
                                          <td>
                                   {{$book->category->name}}
                                       </td>
                                     <td>
                                        {{$book->publisher->name}}
                                        </td>

                                       <td>
                                <i class="fa-fa-eye"></i> {{$book->total_view}}
                              <i class="fa-fa-search"></i>{{$book->total_search}}
                                     </td>

                                     <td>
                                       @if($book->is_approved)
                                       <span class="badge badge-success">
                                         <i class="fa fa-file"></i> Approved
                                       </span>
                                       @else
                                       <span class="badge badge-danger">
                                         <i class="fa fa-times"></i>not approved
                                       </span>
                                       
                                     </td>
                                     @endif




                                         
                                      
                                          
                                       

                                         
                                          <td>
                                              <a href="{{route('admin.books.edit', $book->id)}}" class="btn btn-success" ><i class="fa fa-edit"></i>edit</a>

                                               <a href="#deleteModal{{$book->id}}" class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash" ></i>delete</a>
                                          </td>
                                      </tr>


                  

              
      
                    <div class="modal fade" id="deleteModal{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">are you sure to delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.categories.delete',$book->id )}}" method="get">
          @csrf
          <div>

        {{$book->name}} will be deleted

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