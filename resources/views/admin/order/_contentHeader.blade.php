<section class="content-header">
    <h1><i class="livicon" data-name="piggybank" data-size="18" data-c="#EF6F6C" data-hc="#EF6F6C"
             data-loop="true"></i> @lang('order/title.management')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="14" data-c="#000"
                                                   data-loop="true"></i>
                @lang('general.home')
            </a>
        </li>
        <li>
            <a href="/admin/order">@lang('order/title.management')</a>
        </li>
        <li class="active">{{$section_title}}</li>
    </ol>
</section>