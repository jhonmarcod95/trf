@extends('layouts.app1')
@section('content')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <a>
                <p>Company</p>
            </a>
            
        </li>
    </ul>
</div>
</div>
</nav>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">New Company</h4>
                    </div>
                    <div class="content">
                        
                        <form  method="POST" action="">
                            
                            {{ csrf_field() }}
                            @if(session()->has('status'))
                            <div class="form-group">
                                <div class="alert alert-danger">
                                    {{session()->get('status')}}
                                    
                                </div>
                            </div>
                            @endif
                            @include('error')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        Company Name
                                        <input id="name" type="text" class="form-control" name="company_name" value="{{ old('destination') }}" required >
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-info btn-fill pull-right">Save </button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
