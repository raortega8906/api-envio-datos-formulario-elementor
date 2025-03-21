<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Forms</div>

                <div class="card-body">
                    @if ($forms->isEmpty())
                        <div class="alert alert-warning">No forms found.</div>
                    @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($forms as $form)
                                    <tr>
                                        <td>{{ $form->first_name }}</td>
                                        <td>{{ $form->last_name }}</td>
                                        <td>{{ $form->email }}</td>
                                        <td>{{ $form->phone }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>