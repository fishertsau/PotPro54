<section class="content-header">
    <h1> <i class="livicon" data-name="list-ul" data-size="18" data-c="#000" data-hc="#000"
            data-loop="true"></i> @lang('todo/title.management')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="livicon" data-name="home" data-size="14" data-c="#000"
                                                   data-loop="true"></i>
                @lang('general.home')
            </a>
        </li>
        <li>
            <a href="/admin/todo">@lang('todo/title.management')</a>
        </li>
        <li class="active">{{$section_title}}</li>
    </ol>
</section>