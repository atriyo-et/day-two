@php use \App\Http\Controllers\MCQ; @endphp
@extends('common/header')
@section('title', 'MCQ Quiz')
@section('content')
<div class="container mt-2">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10 col-lg-10">
            <form action="quiz" method="POST">
                @csrf
            <div class="border">
                <div class="question bg-white p-3 border-bottom">
                    <div class="d-flex flex-row justify-content-between align-items-center mcq">
                        <h4>MCQ Quiz</h4><span>(Total Questions {{count($questions)}})</span>
                    </div>
                </div>
                @foreach($questions as $question)
                <div class="question bg-white p-3 border-bottom">
                    <div class="d-flex flex-row align-items-center question-title">
                        <h3 class="text-danger">Q{{$question->ques_num}}.</h3>
                        <h5 class="mt-1 ml-2">{{$question->question}}</h5>
                    </div>
                    @foreach(MCQ::getAnswer($question->ques_num) as $options)
                    <div class="ans ml-2">
                        <label class="radio"> <input type="radio" name="ques[{{$options->ques_id}}]" value="{{$options->id}}"> <span>{{$options->answer}}</span>
                        </label>
                    </div>
                    @endforeach
                </div>
                @endforeach
                <div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white text-right"><button class="btn btn-primary border-success align-items-right btn-success position-relative" type="submit">Submit</button></div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
@extends('common/footer')