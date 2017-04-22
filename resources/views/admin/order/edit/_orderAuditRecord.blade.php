{{--審核紀錄--}}
<hr/>
<h4 class="text-primary">審核紀錄</h4>
@if(count($order->auditRecords)>0)
    <table class="table table-striped">
        <thead>
        <tr>
            <th>動作</th>
            <th>審核人</th>
            <th>說明</th>
            <th>日期</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->auditRecords as $record)
            <tr>
                <td>{{$record->action}}</td>
                <td>{{$record->auditor->name}}</td>
                <td>{{$record->comments}}</td>
                <td>{{$record->created_at}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
@else
    <p>尚無審核紀錄!</p>
@endif