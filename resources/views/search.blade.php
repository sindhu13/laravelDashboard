{!! Form::open(['method' => 'get', 'url' => $url, 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
{{ Form::text('search', '', ['class' => 'form-control', 'placeholder' => 'Search...']) }}
@php($now = Carbon\Carbon::now())
{{ Form::selectMonth('monthsearch', $now->month, ['class' => 'form-control']) }}
{{ Form::submit('Search', array('class' => 'btn btn-primary')) }}
{!! Form:: close() !!}


<!--<div class="input-group custom-search-form">
    <input type="text" class="form-control" name="search" placeholder="Search...">
    <span class="input-group-btn">
        <button class="btn btn-default-sm" type="submit">
            <i class="fa fa-search"> </i>
        </button>
    </span>
</div>-->