@extends('layouts.admin')

@section('content')
<h1>Create a new project</h1>

<form action="{{ route('admin.projects.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Projects Name</label>
      <input type="text" class="form-control" id="name" name="name" value=" {{old('name')}} ">
    </div>
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
      <label for="client_name" class="form-label">Client name</label>
      <input type="text" class="form-control" id="client_name" name="client_name" value=" {{old('client_name')}} ">
    </div>
    @error('client_name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <label for="summary" class="form-label">Summary</label>
        <textarea class="form-control" id="summary" rows="3" name="summary">{{old('summary')}}</textarea>
    </div>
    @error('summary')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <button type="submit" class="btn btn-primary">Submit</button>
</form>  
@endsection