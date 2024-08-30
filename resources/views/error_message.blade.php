@if(!empty(session('succsess')))
    <div class=" alert alert-sucsess" role="alert" >
        {{session('sucsess')}}
    </div>
@endif

@if(!empty(session('error')))
    <div class="alert alert-danger" role="alert" >
        {{session('error')}}
    </div>
@endif


