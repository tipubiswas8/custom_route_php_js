@extends("admin.template.master")
@section('main-content')
<div>
    <form action="{{ route('module-store') }}" method="post">
        @method('post')
        @csrf
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="name">Module Name:</label>
                        <input id="name" type="text" name="name" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="icon">Icon:</label>
                        <input id="icon" type="text" name="icon" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="serial">Serial:</label>
                        <input id="serial" type="text" name="serial" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="status">Status:</label>
                        <select id="status" name="status" class="form-control">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="type" value="1">
                <div class="col-md-12">
                    <div class="form-group">
                        <input id="submit" type="submit" class="form-control bg-primary mt-5 text-white" value="Submit">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var module_type = document.getElementById('module_type');
    var parent_name = document.getElementById('parent_name');
    
    module_type.onchange = function() {
        if(module_type.value == '2'){
            parent_name.style.display = 'block';
        }else{
            parent_name.style.display = 'none';
        }
    };
});
</script>