<body>
<h3>hai, {{$name}}</h3>
@if($active == "N")
    <p>
        @lang('messages_be.email_register_congratulation_title')<br>
    </p>
@else
    <p>
        @lang('messages_be.email_register_congratulation') {{$role}}<br>
        Email : {{$email}}<br>
        Password : {{$password}}<br>
        Link : {{$link}}<br>
    </p>
@endif
<p>
    @lang('messages_be.email_iheritage')
</p>
<p>
    @lang('messages_be.email_thank')
</p>
</body>