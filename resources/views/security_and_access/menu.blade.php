@extends("admin.template.master")
@section('main-content')

<button class="bg-success">
    <a class="text-right text-white" href="{{ route('menu-create') }}">Create</a>
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
        @foreach ($menus as $menu)
        <tr>
            <td>1</td>
            <td>{{ $menu->name }}</td>
            <td>{{ $menu->type }}</td>
            <td>{{ $menu->serial }}</td>
            <td>{{ $menu->active_status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
