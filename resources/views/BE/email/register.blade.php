<body>
<h3>hai, {{$name}}</h3>
@if($active == "N")
    <p>
        Congratulations your account has been saved, please wait for admin confirmation to activate the account<br>
    </p>
@else
    <p>
        Congratulations your account has been active at iHeritage.id as an {{$role}}<br>
        Email : {{$email}}<br>
        Password : {{$password}}<br>
        Link : {{$link}}<br>
    </p>
@endif
<p>Let us explore the extraordinary heritage of the nation to push the boundaries of understanding in the past and today.</p>
iHeritage.id
<p>
    Thank you for your attention.
</p>
</body>