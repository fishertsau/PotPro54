@if(!count($faqs)>0)
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 無符合條件的項目/資料!</h4>
        No any items which conforms the search criteria were found.
    </div>
@else

    總筆數: {{$faqs->count()}} &nbsp;頁數:{{$faqs->currentPage()}}/{{$faqs->lastPage()}}
    <table class="table table-bordered " id="table">
        <thead>
        <tr class="filters">
            <th>類別</th>
            <th>狀態</th>
            <th>熱門</th>
            <th>標題</th>
            <th>編輯</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($faqs as $faq)
            <tr>
                <td>{!! $faq->category_text !!}</td>
                <td>{!! $faq->active_text !!}</td>
                <td>{!! $faq->hot_text !!}</td>
                <td>{!! $faq->title !!}</td>
                <td>
                    <a href="{{ route('admin.faq.show', $faq->id) }}" class=""><i class="fa fa-info-circle"
                                                                    aria-hidden="true"></i></a>
                    <a href="{{ route('admin.faq.edit', $faq->id) }}" class=""><i class="fa fa-pencil-square-o"
                                                                         aria-hidden="true"></i></a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <div class="text-center">
        {!! $faqs->links() !!}
    </div>

    <script>
        $(document).ready(function () {
            $('.pagination a').on('click', function (event) {
                event.preventDefault();
                if ($(this).attr('href') != '#') {
                    $('#faqListContent').load($(this).attr('href'));
                }
            });
        });
    </script>

@endif