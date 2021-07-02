@extends('common/header')
@section('title', 'Add Question')
@section('content')
<form action="add" method="POST">    
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Question</label>
      <input type="text" name="question" class="form-control" placeholder="Question">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Point</label>
      <input type="number" name="point" class="form-control" placeholder="Point" >
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Options</label>
        
        <div class="row p-2">
            <div class="col-md-10">
        <input class="form-control form-control-sm" type="text" name="option[]" placeholder="Options" >
            </div>
            <div class="col-md-2">
                <select name="correct[]" class="form-control form-control-sm">
                    <option value="true">True</option>
                    <option value="false" selected>False</option>
                </select>
            </div>            
        </div>
        <div class="row p-2">
            <div class="col-md-10">
        <input class="form-control form-control-sm" type="text" name="option[]" placeholder="Options" >
            </div>
            <div class="col-md-2">
                <select name="correct[]" class="form-control form-control-sm">
                    <option value="true">True</option>
                    <option value="false" selected>False</option>
                </select>
            </div>            
        </div>
        <div class="row p-2">
            <div class="col-md-10">
        <input class="form-control form-control-sm" type="text" name="option[]" placeholder="Options" >
            </div>
            <div class="col-md-2">
                <select name="correct[]" class="form-control form-control-sm">
                    <option value="true">True</option>
                    <option value="false" selected>False</option>
                </select>
            </div>            
        </div>
        <div class="row p-2">
            <div class="col-md-10">
        <input class="form-control form-control-sm" type="text" name="option[]" placeholder="Options" >
            </div>
            <div class="col-md-2">
                <select name="correct[]" class="form-control form-control-sm">
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