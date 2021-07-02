@extends('common/header')
@section('title', 'Quiz Results')
@section('content')
<div class="container mt-2">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10 col-lg-10">
            <div class="question bg-white p-3 border-bottom">
                <div class="d-flex flex-row justify-content-between align-items-center mcq">
                    <h4>You have obtained: <span>({{$obtained}} out of {{$total}})</span></h4>
                </div>
                <div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white text-right"><a class="btn btn-primary border-success align-items-right btn-success position-relative" href="/">Try Again</a></div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('common/footer')