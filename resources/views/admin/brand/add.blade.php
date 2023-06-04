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
                                        <form action="{{route('brand.store')}}" method="post" enctype="multipart/form-data">
											@csrf
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Brand Name</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    
                                                    <input name="brand_name"  type="text" placeholder="Enter Brand Name" class="form-control " />

                                                    @error('brand_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Brand Image</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                
                                                    <input name="brand_image"   type="file" placeholder="Brand Image" class="brand_image form-control "  />
                                                    <img src="{{asset('uploads/empty.jpeg')}}" class="mt-3 imagepre"   height="200" width="200" alt="">
                                                        @error('brand_image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="submit" class="btn btn-primary px-4" value="Add Brand" />
                                                </div>
                                            
                                            </div>
                                        </form>
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