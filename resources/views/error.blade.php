@if (count($errors))
    @foreach($errors->all() as $error)
    <div class='row col-md-12'>
        <div class="alert alert-danger fade in col-md-6" style='margin-left:28px;margin-bottom:10px;margin-top:10px;'>
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong> {{ $error }}</strong>
        </div>
    </div>
    @endforeach
@endif
