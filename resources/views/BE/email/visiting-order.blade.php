<body>
<h3>hai, {{$institutional_name}}</h3>
<p>
    @lang('messages_be.email_visiting_code') : {{$code_booking}}<br>
    Phone : {{$phone}}<br>
    @lang('messages_be.email_visiting_date') : {{$date}}<br>
    @lang('messages_be.email_visiting_number') : {{$pax}}<br>
    @lang('messages_be.email_visiting_information') : {{$information}}
</p>
<p>@lang('messages_be.email_form_answer')</p>
{{$messages_response}}
<p>
    @lang('messages_be.email_thank')
</p>
</body>