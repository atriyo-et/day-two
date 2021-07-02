@php use \App\Http\Controllers\MCQ; @endphp
@extends('common/header')
@section('title', 'Add Options')
@section('content')
Add Answer Options to Question: <strong>{{$questions->question }}</strong>
<form action="addoptions" method="POST">
    <input type="hidden" name="question_id" value="{{$questions->id}}">
    @csrf    
    <div class="form-group">        
        <div class="row p-2">
            <div class="col-md-10">
            <input class="form-control form-control-sm" type="text" name="option[]" placeholder="Options" required>
            </div>
            <div class="col-md-2">
                <select name="correct[]" required class="form-control form-control-sm">
                    <option value="true">True</option>
                    <option value="false" selected>False</option>
                </select>
            </div>
        </div>
        <div class="row p-2">
            <div class="col-md-10">
            <input class="form-control form-control-sm" type="text" name="option[]" placeholder="Options" required>
            </div>
            <div class="col-md-2">
                <select name="correct[]" required class="form-control form-control-sm">
                    <option value="true">True</option>
                    <option value="false" selected>False</option>
                </select>
            </div>
        </div>
        <div class="row p-2">
            <div class="col-md-10">
            <input class="form-control form-control-sm" type="text" name="option[]" placeholder="Options" required>
            </div>
            <div class="col-md-2">
                <select name="correct[]" required class="form-control form-control-sm">
                    <option value="true">True</option>
                    <option value="false" selected>False</option>
                </select>
            </div>
        </div>
        <div class="row p-2">
            <div class="col-md-10">
            <input class="form-control form-control-sm" type="text" name="option[]" placeholder="Options" required>
            </div>
            <div class="col-md-2">
                <select name="correct[]" required class="form-control form-control-sm">
                    <option value="true">True</option>
                    <option value="false" selected>False</option>
                </select>
            </div>
        </div>
       
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection
@extends('common/footer')