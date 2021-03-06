@if(Session::has('message'))

    @switch(Session::get('alert-type', 'info'))
        @case('info')
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <span class="alert-inner--text">{!! Session::get('message') !!}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @break
        @case('warning')
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <span class="alert-inner--text">{!! Session::get('message') !!}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @break
        @case('success')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--text">{!! Session::get('message') !!}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @break
        @case('error')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="alert-inner--text">{!! Session::get('message') !!}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @break

    @endswitch


@endif
