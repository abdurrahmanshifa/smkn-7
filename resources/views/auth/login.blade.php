<x-guest-layout>
    <div id="back-to-home">
        <a href="index.html" class="btn btn-outline btn-default">
            <i class="fa fa-home animated zoomIn"></i>
        </a>
    </div>
    <div class="simple-page-wrap">
        <div class="simple-page-form animated flipInY" id="login-form">
            <h4 class="form-title m-b-xl text-center">Login</h4>
            <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="form-group">
                    <input name="email" type="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <input name="password" type="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">
                    Login
                </button>
                <br><br>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops, terjadi kesalahan!</strong> <br>
                        @foreach ($errors->all() as $error)
                            -- {{ $error }} <br>
                        @endforeach
                    </div>
                @endif
            </form>
        </div>
    </div>
</x-guest-layout>