@extends('backend.layouts.app')

@section('admin-content')

    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">manage Publisher</h1>


                            <a href="#addModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" ><i
                                class="fas fa-download fa-sm text-white-50" ></i> add Publisher</a>

                     
                    </div>

           @include('backend.layouts.partials.messages')

                  

                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">add new Publisher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.publishers.store')}}" method="get">
          @csrf

          <div class="row">
            <div class="col-md-6">
              <label for="">Publisher name</label>
              <br>
              <input type="text" class="form-control" name="name" placeholder="Publisher name" >
              
            </div>
                  <div class="col-md-6">
              <label for="">Publisher Link</label>
              <br>
              <input type="text" class="form-control" name="link" placeholder="Publisher Link" >
              
            </div>

               <div class="col-md-6">
              <label for="">Publisher Address</label>
              <br>
              <input type="text" class="form-control" name="address" placeholder="Publisher Address" >
              
            </div>
                  <div class="col-md-6">
              <label for="">Publisher Outlet</label>
              <br>
              <input type="text" class="form-control" name="outlet" placeholder="Publisher Outlet" >
              
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
                                          <th>Address</th>
                                            <th>Address</th>
                                             <th>Manage</th>
                                      </tr>
                                  </thead>
                                  <tbody>

                                    @foreach($publishers as $publisher)
                                      <tr>
                                          <td>{{$loop->iteration}}</td>
                                          <td>{{$publisher->name}}</td>
                                          <td>{{$publisher->link}}</td>
                                          <td>{{$publisher->address}}</td>
                                          <td>{{$publisher->outlet}}</td>
                                          <td>
                                              <a href="#editModal{{$publisher->id}}" class="btn btn-success" data-toggle="modal"><i class="fa fa-edit"></i>edit</a>

                                               <a href="#deleteModal{{$publisher->id}}" class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash" ></i>delete</a>
                                          </td>
                                      </tr>

                  

                    <div class="modal fade" id="editModal{{$publisher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">edit publisher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.publishers.update',$publisher->id )}}" method="get">
          @csrf

          <div class="row">
         <div class="col-md-6">
              <label for="">Publisher name</label>
              <br>
              <input type="text" class="form-control" name="name" placeholder="Publisher name" value="{{$publisher->name}}">
              
            </div>
                  <div class="col-md-6">
              <label for="">Publisher Link</label>
              <br>
              <input type="text" class="form-control" name="link" placeholder="Publisher Link" value="{{$publisher->link}}">
              
            </div>

               <div class="col-md-6">
              <label for="">Publisher Address</label>
              <br>
              <input type="text" class="form-control" name="address" placeholder="Publisher Address" value="{{$publisher->address}}">
              
            </div>
                  <div class="col-md-6">
              <label for="">Publisher Outlet</label>
              <br>
              <input type="text" class="form-control" name="outlet" placeholder="Publisher Outlet "value="{{$publisher->outlet}}" >
              
            </div>

               <div class="col-12">
              <label for="">publisher details</label>
              <br>
           <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="author description">{{ $publisher->description }}</textarea>
               
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
              
      
                    <div class="modal fade" id="deleteModal{{$publisher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">are you sure to delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.publishers.delete',$publisher->id )}}" method="get">
          @csrf
          <div>

        {{$publisher->name}} will be deleted

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