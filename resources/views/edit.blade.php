@php use \App\Http\Controllers\MCQ; @endphp
@extends('common/header')
@section('title', 'Edit Question')
@section('content')
<form action="edit" method="POST">
    <input type="hidden" name="question_id" value="{{$questions->id}}">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Question</label>
      <input type="text" name="question" class="form-control" placeholder="Question" value="{{$questions->question}}">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Point</label>
      <input type="number" name="point" class="form-control" placeholder="Point" value="{{$questions->point}}">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Options</label>
        @foreach(MCQ::getAnswer($questions->ques_num) as $option)
        <div class="row p-2">
            <div class="col-md-10">
        <input class="form-control form-control-sm" type="text" name="option[]" placeholder="Options" value="{{$option->answer}}">
            </div>
            <div class="col-md-2">
                <select name="correct[]" class="form-control form-control-sm">
                    <option value="true" {{$option->correct=='true'?'selected':''}}>True</option>
                    <option value="false" {{$option->correct=='false'?'selected':''}}>False</option>
                </select>
            </div>
            <div class="col-md-6">
        <input class="form-control form-control-sm" type="hidden" name="option_id[]" value="{{$option->id}}">
        </div>
        </div>
        @endforeach
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection
@extends('common/footer')