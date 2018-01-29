@extends('homepublic.layouts.app')

@section('content')			

			<!-- main-container start -->
			<!-- ================ -->
			<section class="main-container">

				<div class="container">
					<div class="row">
						@include('flash::message')

						<!-- main start -->
						<!-- ================ -->
						<div class="main object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
							<div class="form-block center-block">
								<h2 class="title">Contact Us</h2>
								<div class="alert-danger">
                            
                                      <ul>
                                        @foreach($errors->all() as $error)

                                          <li> {{ $error }}</li>

                                        @endforeach

                                      </ul>

                                  </div>
                                  <hr>
								<form class="form-horizontal" role="form" action="{{url('/contact')}}" method="POST">
									{{ csrf_field() }}
									<div class="form-group has-feedback">
										<label for="inputName" class="col-sm-3 control-label">First Name <span class="text-danger small">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="first_name" placeholder="Fisrt Name" required>
											<i class="fa fa-user form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="inputLastName" class="col-sm-3 control-label">Last Name <span class="text-danger small">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
											<i class="fa fa-user form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="inputPhone" class="col-sm-3 control-label">Phone <span class="text-danger small">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="phone" placeholder="Phone" required>
											<i class="fa fa-phone form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="inputEmail" class="col-sm-3 control-label">Email <span class="text-danger small">*</span></label>
										<div class="col-sm-8">
											<input type="email" class="form-control" name="email" placeholder="Email" required>
											<i class="fa fa-envelope form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="inputMessage" class="col-sm-3 control-label">Message <span class="text-danger small">*</span></label>
										<div class="col-sm-8">
											<textarea class="form-control" rows="6" name="message" name="message" placeholder=""></textarea>
											<i class="fa fa-pencil form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-8">
											<button type="submit" class="btn btn-default">SEND</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<!-- main end -->

					</div>
				</div>
			</section>
			<!-- main-container end -->
			@include('homepublic.includes.subfooter')


@endsection