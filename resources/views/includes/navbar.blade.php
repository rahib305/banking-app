<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm navbar-first">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <h5>ABC BANK</h5>
        </a>
    </div>
</nav>

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm navbar-second">
    <div class="container">
            {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> --}}

            <div class=" " id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link {{Request::segment(1) == null ? 'active' : ''}}" href="{{route('home')}}"> <i class="fa fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::segment(1) == 'deposit' ? 'active' : ''}}" href="{{route('deposit')}}" ><i class="fa fa-cloud-upload"></i> Deposit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::segment(1) == 'withdraw' ? 'active' : ''}}" href="{{route('withdraw')}}" ><i class="fa fa-cloud-download"></i> Withdraw</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::segment(1) == 'transfer' ? 'active' : ''}}" href="{{route('transfer')}}" ><i class="fa fa-exchange"></i> Transfer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::segment(1) == 'statements' ? 'active' : ''}}" href="{{route('statements')}}" ><i class="fa fa-file-text-o"></i> Statement</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('logout')}}"><i class="fa fa-sign-out"></i> logout</a>
                </li>


          </div>
    </div>
</nav>
