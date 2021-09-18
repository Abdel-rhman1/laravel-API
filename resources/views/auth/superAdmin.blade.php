@include('layouts.app')
    <form action="{{ route('superAdmin.login.submit') }}" method="post">
        @csrf
        <div class="form-group">
            <input type="email" name="email" class="form-control" blaceholder="Type Your Mail">

        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" blaceholder="Type Your Pass">
        </div>
        <div class="form-group">
            <button class="btn btn-outline-success">Submit</button>
        </div>
    </form>
</body>
</html>