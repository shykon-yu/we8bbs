@if(count($errors) > 0)
    <div class="alert alert-danger">
        <div class="mt-2">有异常错误:</div>
        <ul class="mt-2 mb-2" style="list-style-type: none;">
            @foreach($errors->all() as $error)
                <li>
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    {{$error}}
                </li>
            @endforeach
        </ul>
    </div>
@endif
