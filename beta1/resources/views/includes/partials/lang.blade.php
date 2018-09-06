
<ul class="dropdown-menu bg-success" aria-labelledby="language">
    <?php //var_dump(config())?>
        @foreach (array_keys(config('locale.languages')) as $lang)
                @if ($lang != App::getLocale())
                        <li>
                                <a href="{{asset('/lang/'.$lang)}}">
                                        <img src="{{asset('/images/flags/'.$lang.'.svg')}}" class="pull-left" style="width:15px;"/> &nbsp;
                                        {{trans('menus.language-picker.langs.'.$lang)}}
                                </a>

                        </li>
                @endif
        @endforeach
</ul>