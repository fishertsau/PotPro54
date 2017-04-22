@if(isset($errors))
    @if ( $errors->any())
        <div class="alert alert-danger">
            您填的資料,有以下問題歐:
            <hr/>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <hr/>
    @endif
@endif