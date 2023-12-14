<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School CRUD Project</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>

<body>
    <div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white">School CRUD Project</div>
        </div>
    </div>

    <div class="container">
        <div class="d-flex justify-content-between py-3">
            <div class="h4">Employee</div>
            <div>
                <a href="{{ route('employees.create') }}" class="btn btn-primary">Create</a>
            </div>
        </div>
        @if($employees->isNotEmpty())
        <div class="card border-0 shadow-lg">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($employees as $employee)
                    <tr valign="middle">
                        <td>{{ $employee->id }}</td>
                        <td>
                            @if ($employee->image != '' && file_exists(public_path('uploads/employees/' .
                            $employee->image)))
                            <img src="{{ asset('uploads/employees/'.$employee->image) }}" alt="" width="40" height="40"
                                class="rounded-circle">
                            @else
                            <img src="{{ asset('assets/image/no-image-icon-4.png') }}" alt="" width="40" height="40"
                                class="rounded-circle">
                            @endif

                        </td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>
                            <a href="{{route('employees.edit',$employee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" onclick="deleteEmployee('{{ $employee->id }}')"
                                class="btn btn-danger btn-sm">Delete</a>

                            <form id="employee-edit-action-{{$employee->id}}"
                                action="{{ route('employees.destroy', $employee->id) }}" method="post">
                                @csrf
                                @method('delete')
                            </form>

                        </td>
                    </tr>
                    @endforeach
                    @else
                    <div colspan="6">Record not found</div>
                    @endif
                </table>
            </div>
        </div>
        <div class="mt-3">
            {{ $employees->links() }}
        </div>

    </div>

</body>

</html>
<script>
function deleteEmployee(employeeId) {
    // You can perform actions here, like confirming the deletion or making an AJAX request
    if (confirm('Are you sure you want to delete this employee?')) {
        // Assuming you want to redirect to a delete route
        var form = document.getElementById('employee-edit-action-' + employeeId);
        if (form) {
            form.submit();
        }
    }
}
</script>