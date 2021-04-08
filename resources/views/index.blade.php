@extends("menu")

@section("mjs")
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
</form>
    <script>
        $(document).ready(()=>{
            setInterval(() => {
                $("auth").html=`@csrf`;
                $("edit").html=`<input type='hidden' name='_method' value='put'>`;
                $("delete").html=`<input type='hidden' name='_method' value='delete'>`;
            }, 1);
        });

    </script>
@endsection