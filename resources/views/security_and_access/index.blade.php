@extends("admin.template.master")
@section('main-content')

<button class="bg-success">
    <a class="text-right text-white" href="{{ route('module-create') }}">Create</a>
</button>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<table id="example" class="table table-striped" style="width:100%">
    <tr>
        <th>Sl</th>
        <th>name</th>
        <th>Type</th>
        <th>Serial</th>
        <th>Status</th>
    </tr>

    <tbody>
        @foreach ($modules as $module)
        <tr>
            <td>1</td>
            <td>{{ $module->name }}</td>
            <td>{{ $module->type }}</td>
            <td>{{ $module->serial }}</td>
            <td>{{ $module->active_status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
