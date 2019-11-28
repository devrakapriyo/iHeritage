<form action="{{url('email')}}" method="post">
    @csrf
    <input type="email" name="email" placeholder="email yang dituju"><button>kirim</button>
</form>