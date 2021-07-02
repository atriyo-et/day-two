@php use \App\Http\Controllers\MCQ; @endphp
@extends('common/header')
@section('title', 'Questions List')
@section('content')
<div class="content_box">
	<div class="left_bar">
	    <ul class=" nav-tabs--vertical nav" role="navigation">            
            <li class="nav-item">
                <a href="add" class="nav-link active" >Add New</a>
            </li>           
	    </ul>
	</div>
    <div class="right_bar ">
        <div class="tab-content ">
            <div class="tab-pane fade show active" id="questions" role="tabpanel">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Question No.</th>
                        <th>Question</th>
                        <th>Options</th>
                        <th>Point</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $question)
                    <tr>
                        <td>{{$question->ques_num}}</td>
                        <td>{{$question->question}}</td>
                        <td class="text-justify">
                            @if(count(MCQ::getAnswer($question->ques_num)))
                                <ul>
                                @foreach(MCQ::getAnswer($question->ques_num) as $options)
                                    <li>@if($options->correct=='true')<b class="text-success">{{$options->answer}}</b>@else {{$options->answer}} @endif</li>
                                @endforeach
                                </ul>
                            @else
                                <a href="addoptions/{{$question->id}}">Add Options</a>
                            @endif
                        </td>
                        <td>{{$question->point}}</td>
                        <td nowrap><a href="edit/{{$question->id}}">Edit</a> / <a href="delete/{{$question->id}}">Delete</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            
        {{-- <div class="tab-pane fade" id="ipsum" role="tabpanel">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>John</td>
                    <td>Doe</td>
                    <td>john@example.com</td>
                </tr>                
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="dolor" role="tabpanel">
                    <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>John</td>
                    <td>Doe</td>
                    <td>john@example.com</td>
                </tr>                
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="sit-amet" role="tabpanel">
                    <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>John</td>
                    <td>Doe</td>
                    <td>john@example.com</td>
                </tr>                
                </tbody>
            </table>
        </div> --}}
	    </div>
    </div>
</div>
@endsection
@extends('common/footer')