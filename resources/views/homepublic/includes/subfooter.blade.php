<!-- footer start (Add "light" class to #footer in order to enable light footer) -->
			<!-- ================ -->
			<footer id="footer light">

				<!-- .subfooter start -->
				<!-- ================ -->
				<div class="subfooter">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<p>Copyright © 2017 TotalGrades by <a target="_blank" href="{{ url('/') }}">nahorr Analytics</a>. All Rights Reserved</p>
							</div>
							<div class="col-md-6">
								<nav class="navbar navbar-default" role="navigation">
									<!-- Toggle get grouped for better mobile display -->
									<div class="navbar-header">
										<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-2">
											<span class="sr-only">Toggle navigation</span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</button>
									</div>   
									<div class="collapse navbar-collapse" id="navbar-collapse-2">
										<ul class="nav navbar-nav">
											<li><a href="{{url('/')}}">Home</a></li>
											<li><a href="{{url('/features')}}">Features</a></li>
											<li><a href="{{ url('/login') }}"> Students login</a></li>
											<li><a href="{{ url('/admin_login') }}"> Teachers login</a></li>
											<li><a href="{{url('/Contact')}}">Contact</a></li>
										</ul>
									</div>
								</nav>
							</div>
						</div>
					</div>
				</div>
				<!-- .subfooter end -->

			</footer>
			<!-- footer end -->
