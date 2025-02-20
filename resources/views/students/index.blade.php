@extends('layouts.app')

@section('content')
<h2>Students List</h2>

<!-- Display success message if any -->
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>

<table class="table mt-4" id="students">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Courses</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->courses->pluck('name')->join(', ') }}</td>
                <td>
                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection


@section('scripts')
<script>
    $(document).ready(function() {
        $('#students').DataTable({
            searching: true, // Enable search
            responsive: true, // Enable responsiveness
            lengthChange: true, // Enable length change
            paging: true, // Enable pagination
            ordering: true, // Enable sorting
        });
    });
</script>
@endsection
