@extends('layouts.app')
@section('content')
<h3>
    Name: {{{ (Auth::user()->name) }}}
</h3>

<h3>
    Email: {{{ (Auth::user()->email) }}}
</h3>

<h3>
    Department: {{{ (Auth::user()->department)  }}}
</h3>

<h3>
    Leaves Available: {{{ (Auth::user()->leaves_available)  }}}
</h3>
@endsection

