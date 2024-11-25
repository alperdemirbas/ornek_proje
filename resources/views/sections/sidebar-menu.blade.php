@foreach(config('sidebar') as $item)
    @if(isset($item["submenu"]))
        @if(empty($item['permissions']) || auth()->user()->hasAnyPermission($item['permissions']))
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">
                        @lang($item["title"])
                    </span>
                </a>
                <ul aria-expanded="false" >
                    @foreach($item["submenu"] as $subitem)
                        @if(empty($subitem['permissions']) || auth()->user()->hasAnyPermission($subitem['permissions']))
                            <li>
                                <a  @if(isset($subitem["submenu"]))class="has-arrow"@endif href="@if(isset($subitem["route"])) {{ _route($subitem["route"]) }} @else javascript:void() @endif" aria-expanded="false">
                                    @lang($subitem["title"])
                                </a>
                                @if(isset($subitem["submenu"]))
                                    <ul aria-expanded="false" class="left mm-collapse">
                                        @foreach($subitem["submenu"] as $subItemChild)
                                            @if(empty($subItemChild['permissions']) || auth()->user()->hasAnyPermission($subItemChild['permissions']))
                                                <li>
                                                    <a href="@if(isset($subItemChild["route"])) {{ _route($subItemChild["route"]) }} @else # @endif">
                                                        @lang($subItemChild["title"])
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
        @endif
    @else
        @if(empty($item['permissions']) || auth()->user()->hasAnyPermission($item['permissions']))
            <li>
                <a href="@if(isset($item["route"])) {{ _route($item["route"]) }} @else # @endif" aria-expanded="false">
                    <i class="flaticon-381-user-9"></i>
                    <span class="nav-text">
                         @lang($item["title"])
                    </span>
                </a>
            </li>
        @endif
    @endif
@endforeach