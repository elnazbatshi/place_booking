@if(session("status"))

    <div class="alert alert-danger
     alert-dismissible fade show mt-4 " role="alert">
        <strong>
            {{session("status")}}
        </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@endif
