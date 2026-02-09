@extends('common.baseLayout')
@section('content')
    <div class="container vh-100 d-flex align-items-center justify-content-center">
       @if(session('error'))
            <script>
                Toast.fire({
                    icon: 'error',
                    title: "{{ session('error') }}"
                });
            </script>
        @endif

        <div class="card shadow-5" style="max-width: 900px; width: 100%;">
            <div class="row g-0">

                {{-- LEFT SIDE --}}
                <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-success text-white p-4">
                    <div class="text-center">
                        <h4 class="fw-semibold">Admin Setup</h4>
                        <p class="small opacity-75">
                            Create the first administrator account
                        </p>
                    </div>
                </div>

                {{-- RIGHT SIDE : REGISTER FORM --}}
                <div class="col-md-6 p-4 p-md-5">

                    <h4 class="text-center mb-4 fw-semibold">Create Admin</h4>

                    <form method="POST" action="{{ route('admin.register.process') }}">
                        @csrf

                        {{-- Name --}}
                        <div class="form-outline mb-3">
                            <input type="text" name="name" id="name" class="form-control" required>
                            <label class="form-label" for="name">Full Name</label>
                        </div>

                        {{-- Email --}}
                        <div class="form-outline mb-3">
                            <input type="email" name="email" id="email" class="form-control" required>
                            <label class="form-label" for="email">Email Address</label>
                        </div>

                        {{-- Password --}}
                        <div class="form-outline mb-3">
                            <input type="password" name="password" id="password" class="form-control" required>
                            <label class="form-label" for="password">Password</label>
                        </div>

                        {{-- Confirm Password --}}
                        <div class="form-outline mb-4">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" required>
                            <label class="form-label" for="password_confirmation">
                                Confirm Password
                            </label>
                        </div>

                        <input type="submit" value="Create Admin" class="btn btn-success w-100 mb-3">
                        <div class="text-center">
                            <small>
                                Already have admin?
                                <a href="{{ route('admin.login') }}">Login</a>
                            </small>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
