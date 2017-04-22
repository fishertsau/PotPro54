{!! Form::model($example,
['route' => ['sales.example.update', $example->id],'method'=>'put']) !!}
<input type="text" class="hidden" name="manager_id" value="{{$example->manager->id}}">
{{csrf_field()}}
@include('admin.example.edit._form')
{!! Form::close() !!}