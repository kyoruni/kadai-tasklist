<!-- タスク未入力、または191文字以上の場合 エラーメッセージを表示 -->
@if ( count($errors) >0 )
    <ul class="alert areat-danger" role="aleat">
        @foreach ($errors->all() as $error)
            <li class="ml-4">{{ $error }}</li>
        @endforeach
    </ul>
@endif