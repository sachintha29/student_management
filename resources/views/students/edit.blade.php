@extends('layouts.app')

@section('content')
<h2>Edit Student</h2>

<!-- Display validation errors -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('students.update', $student->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', $student->name) }}">
        {{-- @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror --}}
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', $student->email) }}">
        {{-- @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror --}}
    </div>

    <div class="mb-3">
        <label for="course_ids" class="form-label">Courses</label>
        <select name="course_ids[]" class="form-control" multiple>
            @foreach($courses as $course)
                <option value="{{ $course->id }}"
                        {{ in_array($course->id, old('course_ids', $student->courses->pluck('id')->toArray())) ? 'selected' : '' }}>
                    {{ $course->name }}
                </option>
            @endforeach
        </select>
        {{-- @error('course_ids')
            <div class="text-danger">{{ $message }}</div>
        @enderror --}}
    </div>

    <button type="submit" class="btn btn-success">Save Changes</button>
</form>
@endsection
