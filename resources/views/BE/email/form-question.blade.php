<body>
<h3>hai, {{$nama}}</h3>
<p>
    @lang('messages_be.email_form_question_one') {{$judul_pertanyaan}}, @lang('messages_be.email_form_question_two')<br>
    "{!! $pertanyaan !!}"
</p>
<p>@lang('messages_be.email_form_answer')</p>
{!! $response !!}
<p>
    @lang('messages_be.email_thank')
</p>
</body>