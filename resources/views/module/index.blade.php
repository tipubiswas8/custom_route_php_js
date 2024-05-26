@extends("admin.template.master")
@section('main-content')

<button class="bg-success">
    <a class="text-right text-white" href="{{ route('module-link-create') }}">Create</a>
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
        <th>Url</th>
        <th>Controller</th>
        <th>Method</th>
        <th>Name</th>
        <th>Type</th>
        <th>Status</th>
    </tr>

    <tbody>
        @foreach ($moduleLink as $link)
        <tr>
            <td>1</td>
            <td>{{ $link->url }}</td>
            <td>{{ $link->controller }}</td>
            <td>{{ $link->method }}</td>
            <td>{{ $link->name }}</td>
            <td>{{ $link->type }}</td>
            <td>{{ $link->active_status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection


<script> 
new DataTable('#example');
</script>