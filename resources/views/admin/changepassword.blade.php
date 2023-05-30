@extends('admin.master')
@section('admin')

    <div class="page-content"> 
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Admin Profile</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Password Change</li>
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
                                    <!-- @if(session('sucess'))
                                    <div class="alert alert-sucess ">{{ session('sucess') }}</div>
                                    @elseif(session('error'))
                                    <div class="alert alert-warning text-white">{{ session('error') }}</div>
									@endif -->
                                    <div class="card-body">
                                        <form action="{{route('admin.update.password')}}" method="post" enctype="multipart/form-data">
											@csrf
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Old Password</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    
                                                    <input name="old_password" id="old_password" type="password" placeholder="old password" class="form-control @error('old_password') is-invalid @enderror" />

                                                    @error('old_password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">New Password</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                
                                                    <input name="new_password" id="new_password" type="password" placeholder="new password" class="form-control @error('new_password') is-invalid @enderror"  />
                                                        @error('new_password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Confirm Password</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                <input name="new_password_confirmation" id="new_password_confirmation"  type="password" placeholder="Confirme Password" class="form-control @error('new_password_confirmation') is-invalid @enderror"  />
                                                @error('new_password_confirmation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
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
	
	@endsection