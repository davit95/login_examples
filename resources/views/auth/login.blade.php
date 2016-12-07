<form method="POST" action="../auth/login">
    {!! csrf_field() !!}

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
</form>
<a href="{{url('password/email')}}">forgot password?</a>
<br><br>
<a href="{{$facebookLoginUrl}}" tabindex="5" class="btn btn-lg btn-primary btn-block facebook">Login with Facebook</a>
<br><br>
<a href="{{$twitterLoginUrl}}">login with twitter</a>
<br/><br/>
<a href="{{$googleLoginUrl}}">login with google</a>



