@extends('admin.admin-master')
@section('brand')
    active
@endsection

@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Starlight</a>
      <span class="breadcrumb-item active">Dashboard</span>
    </nav>
  
    <div class="sl-pagebody">
      <div class="row row-sm">
        <div class="col-md-8">    
              <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Brand DataTable</h6>    
                @if(session('Catupdated'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session('Catupdated')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif
  
                  @if(session('delete'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>{{session('delete')}}</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @endif
                <div class="table-wrapper">
                  <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                      <tr>
                        <th class="wd-15p">Sl</th>
                        <th class="wd-15p">Brand Name</th>
                        <th class="wd-20p">Status</th>  
                        <th class="wd-25p">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                    @foreach ($brands as $brand)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $brand->brand_name }}</td>
                        <td>
                            @if($brand->status == 1)
                            <span class="badge badge-success">Active</span>
                            @else 
                            <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('admin/brands/edit/'.$brand->id) }}" class="btn btn-sm btn-success">Edit</a>
                            <a href="{{ url('admin/brands/delete/'.$brand->id) }}" class="btn btn-sm btn-danger" onclick="return confirm( 'Are you sure you want to delete?' )" >Delete</a>
                            @if($brand->status == 1)
                            <a href="{{ url('admin/brands/status/'.$brand->id) }}" class="btn btn-sm btn-danger">Inactive</a>
                            @else
                            <a href="{{ url('admin/brands/status/'.$brand->id) }}" class="btn btn-sm btn-success">Active</a>
                            @endif
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div><!-- table-wrapper -->
              </div><!-- card -->
        </div>
  
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Add Brand
                </div>
  
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      @endif
  
                    <form action=" {{ route('brand.store') }} " method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Add Brand</label>
                          <input type="text" name="brand_name" class="form-control @error('brand_name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Brand" >
  
                          @error('brand_name')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
  
                        </div>
  
                        <button type="submit" class="btn btn-primary">Add</button>
                      </form>
  
  
  
  
                </div>
            </div>
        </div>
    </div>
  
  </div>
@endsection