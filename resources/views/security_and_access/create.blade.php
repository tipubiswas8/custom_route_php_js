@extends("admin.template.master")
@section('main-content')
@php   
$moduleId = 0;
@endphp
<div>
    <form action="{{ route('module-store') }}" method="post">
        @method('post')
        @csrf
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="module">Parent Module:</label>
                        <select id="module" name="id" class="form-control">
                            <option value="">--Select module--</option>
                            @foreach ($modules as $module)
                                <option value="{{ $module->id }}">{{ $module->name }}</option>
                                @php   
                                 $moduleId = $module->id;
                                @endphp
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="menu_type">Menu Type:</label>
                        <select id="menu_type" name="type" class="form-control">
                            <option value="2" selected>Main menu</option>
                            <option value="3">Sub menu</option>
                            <option value="4">Other menu</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6" style="display: none;" id="parent_name">
                    <div class="form-group">
                        <label class="form-label" for="patent">Main menu:</label>
                        <select id="patent" name="parent_menu_id" class="form-control">
                            <option value="">--Select main menu--</option>
                            @foreach ($mainMenu as $mm)
                               <option value="{{ $mm->id }}">{{ $mm->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="name">Menu Name:</label>
                        <input id="name" type="text" name="name" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="serial">Serial:</label>
                        <input id="serial" type="text" name="serial" class="form-control">
                    </div>
                </div>
                <div class="col-md-6" id="icon_div">
                    <div class="form-group">
                        <label class="form-label" for="icon">Icon:</label>
                        <input id="icon" type="text" name="icon" class="form-control">
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
    var menu_type = document.getElementById('menu_type');
    var parent_name = document.getElementById('parent_name');
    var icon = document.getElementById('icon');
    var icon_div = document.getElementById('icon_div');
    
    menu_type.onchange = function() {
        if(menu_type.value == '3'){
            parent_name.style.display = 'block';
        }else{
            parent_name.style.display = 'none';
        }
        if(menu_type.value == '4'){
            icon_div.style.display = 'none';
        }else{
            icon_div.style.display = 'block';
        }
    };
});
</script>