@extends("admin.template.master")
@section('main-content')
<div>
    <form action="{{ route('module-link-store') }}" method="post">
        @method('post')
        @csrf
        <div class="col-md-12">
            <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="module_id">Parent Module:</label>
                                <select id="module_id" name="module_id" class="form-control">
                                    <option value="">--Select module--</option>
                                    @foreach ($modules as $module)
                                        <option value="{{ $module->id }}">{{ $module->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="main_menu">Main menu:</label>
                                <select id="main_menu" name="main_menu" class="form-control">
                                    <option value="">--Select main menu--</option>
                                    @foreach ($mainMenu as $mm)
                                       <option value="{{ $mm->id }}">{{ $mm->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="sub_menu">Sub menu:</label>
                                <select id="sub_menu" name="sub_menu" class="form-control">
                                    <option value="">--Select sub menu--</option>
                                    @foreach ($subMenu as $sm)
                                       <option value="{{ $sm->id }}">{{ $sm->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
        
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="method">Type:</label>
                        <select id="type" name="type" class="form-control">
                            <option value="get" selected>GET</option>
                            <option value="post">POST</option>
                            <option value="put">PUT</option>
                            <option value="patch">PATCH</option>
                            <option value="delete">DELETE</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="url">Url:</label>
                        <input id="url" type="text" name="url" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="method">Method:</label>
                        <input id="method" type="text" name="method" class="form-control">
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

{{-- <script>
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
</script> --}}