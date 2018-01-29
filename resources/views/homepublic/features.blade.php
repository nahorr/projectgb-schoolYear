@extends('homepublic.layouts.app')

@section('content')			

			<!-- main-container start -->
			<!-- ================ -->
			<section class="main-container">

				<div class="container">
					<div class="row">

						<!-- main start -->
						<!-- ================ -->
						<div class="main col-md-12">

							<!-- page-title start -->
							<!-- ================ -->
							<h1 class="page-title text-center">Core Features</h1>
							<div class="separator"></div>
							<!-- page-title end -->
							
							<div class="row">
								<div class="col-md-6">
									<div class="box-style-3 right animated fadeInUpSmall">
										<div class="icon-container default-bg">
											<i class="fa fa-line-chart"></i>
										</div>
										<div class="body">
											<h2>Student grades and Statistics</h2>
											<p>Easy to understand grades and class statistics.</p>
											
										</div>
									</div>
									<div class="box-style-3 right animated fadeInUpSmall">
										<div class="icon-container default-bg">
											<i class="fa fa-list"></i>
										</div>
										<div class="body">
											<h2>Report Card</h2>
											<p>Beautifully designed report card with your school logo and student picture.</p>
											
										</div>
									</div>
									<div class="box-style-3 right animated fadeInUpSmall">
										<div class="icon-container default-bg">
											<i class="fa fa-tablet"></i>
										</div>
										<div class="body">
											<h2>Students Attendance</h2>
											<p>Daily student attendance by teachers and student attendance history for the school year.</p>
											
										</div>
									</div>

									<div class="box-style-3 right animated fadeInUpSmall">
										<div class="icon-container default-bg">
											<i class="fa fa-user-plus"></i>
										</div>
										<div class="body">
											<h2>Student Registration and Biodata</h2>
											<p>Register your students and safely store and access student registration anytime. </p>
											
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="space hidden-lg hidden-md"></div>
									<iframe class="animated fadeInUpSmall" width="560" height="400" src="https://www.youtube.com/embed/Bzn9dMX7ISs" frameborder="100" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
								</div>
							</div>
							<div class="space"></div>

						</div>
						<!-- main end -->

					</div>
				</div>
			</section>
			<!-- main-container end -->


			<!-- page-top start-->
			<!-- ================ -->
			<div class="space"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<div class="call-to-action">
								<h1 class="title">Need a live demonstration?</h1>
								<p>We are always happy to show you how TotalGrades could help your school stand out. Plase call us or send us a messages. </p>
								<a class="btn btn-white more" data-toggle="modal" data-target="#myModal">
								Call Us <i class="pl-10 fa fa-phone"></i>
								</a>

								<!-- Modal -->
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
												<h4 class="modal-title" id="myModalLabel">Call or Whatsapp us</h4>
											</div>
											<div class="modal-body">
												<p>Phone or Whatsapp Canada:</p>
												<ul class="list-icons">
													<li><i class="icon-check"></i> +14034022387</li>
												</ul>
												<p>Phone or Whatsapp Nigeria:</p>
												<ul class="list-icons">
													<li><i class="icon-check"></i> +2348035525141</li>
												</ul>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="icon-check"></i> Ok</button>
											</div>
										</div>
									</div>
								</div>
								or
								<a href="{{url('/contact')}}" class="btn btn-default contact">Contact us <i class="pl-10 fa fa-envelope"></i></a>
							</div>
						</div>
					</div>
				</div>
			<div class="space"></div>
			<!-- page-top end -->
			@include('homepublic.includes.subfooter')


@endsection