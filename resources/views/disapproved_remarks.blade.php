@include('layouts.app1')
<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <a>
                <p>Disapproved</p>
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
                    <h4 class="title">Disapprove Request of {{$users_request->traveler_name}}</h4>
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
                                        Remarks
                                        <input id="name" type="text" class="form-control" name="remarks"  required >
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
