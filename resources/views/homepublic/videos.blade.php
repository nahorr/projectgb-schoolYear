@extends('homepublic.layouts.app')

@section('content')			

			<!-- section start -->
			<!-- ================ -->
			<div class="section clearfix object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="300">

				<div class="container">
					<div class="row">
						<div class="col-md-12">

							<h2>Demo Videos</h2>
							<div class="separator-2"></div>

							<!-- isotope filters start -->
							<div class="filters margin-bottom-clear">
								<ul class="nav nav-pills">
									<li class="active"><a href="#" data-filter="*">All</a></li>
									<li><a href="#" data-filter=".students">Students</a></li>
									<li><a href="#" data-filter=".teachers">Teachers</a></li>
									<li><a href="#" data-filter=".systemadministrators">System Administrators</a></li>
								</ul>
							</div>
							<!-- isotope filters end -->

							<!-- portfolio items start -->
							<div class="isotope-container row grid-space-20">

								@include('homepublic.includes.videos.students')

								@include('homepublic.includes.videos.teachers')

								@include('homepublic.includes.videos.systemadministrators')

								
							</div>
							<!-- portfolio items end -->

						</div>
					</div>
				</div>

			</div>
			<!-- section end -->

			
			@include('homepublic.includes.subfooter')


@endsection