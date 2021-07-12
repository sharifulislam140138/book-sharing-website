@extends('backend.layouts.app')

@section('admin-content')

    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">manage categories</h1>


                            <a href="#addModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" ><i
                                class="fas fa-download fa-sm text-white-50" ></i> add categories</a>

                     
                    </div>

           @include('backend.layouts.partials.messages')

                  

                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">add new categories</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.categories.store')}}" method="get">
          @csrf

          <div class="row">
            <div class="col-md-6">
              <label for="">category name</label>
              <br>
              <input type="text" class="form-control" name="name" placeholder="category name" >
              
            </div>
                  <div class="col-md-6">
              <label for="">category url text</label>
              <br>
              <input type="text" class="form-control" name="slug" placeholder="category slug,e.g,c-programming" >
              
            </div>

            <div class="col-md-6">
              <label for="parent_id">parent category</label>
              <br>
              <select name="parent_id" id="parent_id" class="form-control">
                <option value="">select category</option>

                @foreach($parent_categories as $parent)
                <option value="{{$parent->id}}">{{$parent->name}}</option>
                @endforeach
              </select>
             
              
            </div>
            

               <div class="col-12">
              <label for="">category details</label>
              <br>
           <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="category description"></textarea>
               
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

                  <div class="col-sm-12" class="form-control">
                        <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">category list</h6>
                                </div>
                                <div class="card-body">
                              <table class="table " id="dataTable">
                                  <thead>
                                      <tr>
                                          <th>s1</th>
                                          <th>name</th>
                                          <th>url</th>
                                          <th>parent category</th>
                                            
                                             <th>Manage</th>
                                      </tr>
                                  </thead>
                                  <tbody>

                                    @foreach($categories as $category)
                                      <tr>
                                          <td>{{$loop->iteration}}</td>
                                          <td>{{$category->name}}</td>
                                          <td>
                                            <a href="{{route('categories.show', '$category->slug')}}" target="blank">{{route('categories.show',$category->slug)}}</a>
                                          </td>
                                          <td>
                                      @if(!is_null($category->parent_category($category->parent_id)))
                                            {{$category->parent_category($category->parent_id)->name}}
                                          </td>
                                          
                                          @else
                                          --

                                          @endif
                                          <td>
                                              <a href="#editModal{{$category->id}}" class="btn btn-success" data-toggle="modal"><i class="fa fa-edit"></i>edit</a>

                                               <a href="#deleteModal{{$category->id}}" class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash" ></i>delete</a>
                                          </td>
                                      </tr>

                  

                    <div class="modal fade" id="editModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">edit category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.categories.update',$category->id )}}" method="get">
          @csrf

          <div class="row">
          <div class="col-md-6">
              <label for="">category name</label>
              <br>
              <input type="text" class="form-control" name="name" placeholder="category name" value="{{$category->name}}" >
              
            </div>
                  <div class="col-md-6">
              <label for="">category url text</label>
              <br>
              <input type="text" class="form-control" name="slug" placeholder="category slug,e.g,c-programming" value="{{$category->slug}}" >
              
            </div>

            <div class="col-md-6">
              <label for="parent_id">parent category</label>
              <br>
              <select name="parent_id" id="parent_id" class="form-control">
                <option value="">select category</option>

                @foreach($parent_categories as $parent)
                <option value="{{$parent->id}}" {{$category->parent_id==$parent->id ? 'selected' : ''}}>{{$parent->name}}</option>
                @endforeach
              </select>
             
              
            </div>
            

               <div class="col-12">
              <label for="">category details</label>
              <br>
           <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="category description">{{$category->description}}</textarea>
               
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
              
      
                    <div class="modal fade" id="deleteModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">are you sure to delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.categories.delete',$category->id )}}" method="get">
          @csrf
          <div>

        {{$category->name}} will be deleted

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