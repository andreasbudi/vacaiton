@extends('layouts.app')
@section('content')

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> there where some problems with your input.<br>
                <ul>
                    @foreach ($errors as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
                <div class="col-xl-6">
                    <!--begin:: Widgets/Tasks -->
                    <div class="m-portlet m-portlet--full-height ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Apply Form
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="tab-content">
                                <div class="m-widget2">
                                    <form action="{{route('leave.store')}}" method="post">
                                        @csrf
                                        {{-- <div class="col-md-12">
                                            <strong>Leaves :</strong>
                                            <input type="text" name="leaves_available" class="form-control">
                                        </div> --}}
                                        <div class="col-md-12">
                                            <strong>From :</strong>
                                            <input type="date" name="from" class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <strong>To :</strong>
                                            <input type="date" name="to" class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <strong>Duration (Day) :</strong>
                                            <input type="text" name="duration" class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <strong>Reason :</strong>
                                            <textarea class="form-control" name="reason" rows="2" cols="80"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                        <a href="../../index.php" class="btn btn-sm btn-success">Back</a>
                                        <button type="submit" value="send" class="btn btn-sm btn-primary">Submit</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end:: Widgets/Tasks -->
                </div>
                <div class="col-xl-6">
                    <!--begin:: Widgets/Support Tickets -->
                    <div class="m-portlet m-portlet--full-height ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Calendar
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="m-widget3">
                                    <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=2&amp;bgcolor=%23ffffff&amp;
                                    ctz=Asia%2FJakarta&amp;src=ZW4uaW5kb25lc2lhbiNob2xpZGF5QGdyb3VwLnYuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;color=%237986CB&amp;
                                    showNav=1&amp;showPrint=0&amp;showTabs=1&amp;showCalendars=1&amp;showTz=0" style="border-width:0" width="700" height="600" frameborder="0" scrolling="no"></iframe>
                            </div>
                        </div>
                    </div>
                    <!--end:: Widgets/Support Tickets -->
                </div>
        </div>
@endsection