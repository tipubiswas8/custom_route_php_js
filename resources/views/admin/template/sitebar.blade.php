
<style>
    a {
    text-decoration: none;
}
</style>
{{-- Sitebar Start--}}
<div class="col-md-2" style="height: 800px; background-color: #dde39f">
    <div class="text-white" style="height: 100%">
        <a href="/">Dashboard</a>
        <br />
        {{-- Main module name and route --}}
        <a href="{{ url($moduleRoute->url ?? '#') }}">{{ $module->name ?? '' }}
            @foreach ($mainMenus ?? [] as $key => $mainMenu)
            <br />
            {{-- Main menu name and route --}}
            <a style="margin-left: 25px" href="{{ url($mmRoute[$key] ?? '#') }}">{{ $mainMenu->name }}
                @foreach ($sMenus as $smKey => $sm)
                @if ($mainMenu->id == $sm->parent_menu_id)
                <br />
                {{-- Sub menu name and route --}}
                <a style="margin-left: 50px" 
                    @foreach ($smRoute as $smr)
                        @if ($sm->id == $smr->sub_menu_id)
                          href="{{ route($smr->name) }}"
                        @endif
                          href="#"
                    @endforeach
                  > 
                {{ $sm->name }}
            </a> 
                @endif
                @endforeach
            </a>
            @endforeach
        </a>
    </div>
</div>
{{-- Sitebar End--}}

{{-- Main Content Start   --}}
<div class="col-md-10">