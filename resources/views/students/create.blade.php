@extends('layouts.app')

@section('content')
<h2>Add Student</h2>

 @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('students.store') }}">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
    </div>

    <div class="mb-3">
        <label for="course_ids" class="form-label">Courses</label>
        <select name="course_ids[]" class="form-control" multiple>
            @foreach($courses as $course)
                <option value="{{ $course->id }}" {{ in_array($course->id, old('course_ids', [])) ? 'selected' : '' }}>{{ $course->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
