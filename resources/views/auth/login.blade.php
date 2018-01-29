@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Students & Parents Login<span class="pull-right"> School Year: {{@$school_year->school_year}}</span></strong></div>
                <div class="panel-body">
                <div class="row">
                
                <div class="col-md-3" >
                    <div class="logo text-center">
                    <a href="https://socidy.com/" class="simple-text">
                        <img src="{{asset('/assets/img/logo/logo.jpg')}}" style="width: 130px; height: 130px; border-radius: 50%; margin-left: 20px; ">
                    </a>
                    <div class="text-center" style="color: #3097d1;"> <strong>An Online Gradebook Project for Primary & Secondary Schools</strong> </div>
                   </div>
                    
                </div>
                <div class="col-md-9" style="padding-left:1px; border-left: 1px solid #ccc;">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
                </div>
            </div>
            <footer style="font-size: 11px;">
                <!-- Container -->
                <div class="text-center">
                    <!-- Footer Content -->
                        <!-- Paragraph -->
                        <p style="margin: 0;"> Copyright &copy; 2017 - Totalgrades(v1.0) -by <a href="https://socidy.com">nahorr Analytics </a></p>
                        <p style="margin: 0;">55 Wesylynn Spur, Claresholm, ALberta T0L0T0, Canada</p>
                        <p style="margin: 0;">Email: <a href="mailto:nahorr@totalgrades.com"> nahorr@totalgrades.com </a>
                        <p style="margin: 0;">Phone: +14034022387 , +2348035525141</p>
                        


                        
                       
                        <!-- Clearfix -->
                        <div class="clearfix"></div>
                </div>
            </footer>
        </div>
    </div>
</div>
@endsection
