@extends('admin.master')
@section('admin')
<script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
    <div class="page-content"> 
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Brand</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add Brand</li>
							</ol>
						</nav>
					</div>
					
		</div>
		<!--end breadcrumb-->
		<div class="container">
					<div class="main-body">
						<div class="row">
							
							<div class="col-lg-8 offset-2">
								<div class="card">
                                    
                                    <div class="card-body">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th>#sl</th>
                                                    <th>Brand Name</th>
                                                    <th>Brand Slug</th>
                                                    <th>Brand Image</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach($brands as $brand)
                                                <tr>
                                                    <td>{{$brand->id}}</td>
                                                    <td>{{$brand->brand_name}}</td>
                                                    <td>{{$brand->brand_slug}}</td>
                                                    <td>
                                                        <img src="{{asset('uploads/brand/'.$brand->brand_image)}}" alt="Brand Image" height="100" width="100">
                                                    </td>
                                                    <td>{{$brand->status}}</td>
                                                    <td>
                                                        <button class="btn btn-warning">E</button>
                                                        <button class="btn btn-danger">D</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#sl</th>
                                                    <th>Brand Name</th>
                                                    <th>Brand Slug</th>
                                                    <th>Brand Image</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
									</div>
								</div>
								
							</div>
						</div>
					</div>
		</div>
	</div>
	
    <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
	<script>
		jQuery(document).ready(function(){
			jQuery('.brand_image').change(function(){
				// alert('ok')
				var filereader = new FileReader();
				filereader.onload = function(e){
					jQuery('.imagepre').attr('src',e.target.result);
				}
				filereader.readAsDataURL(this.files['0']);
			})
		})
	</script>

	@endsection