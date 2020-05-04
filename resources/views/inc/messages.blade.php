@if (session('success'))
    <div class="alert">
        {{session('success')}}
    </div>
@endif

@if (session('error'))
    <div class="alertError">
        {{session('error')}}
    </div>
    
@endif