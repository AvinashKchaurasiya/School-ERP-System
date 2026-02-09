@extends('common.baseLayout')
@section('content')
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        @if(session('success'))
            <script>
                Toast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}"
                });
            </script>
        @endif

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

                {{-- LEFT SIDE : IMAGE / BRANDING --}}
                <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-primary text-white p-4">
                    <div class="text-center">
                        <h4 class="fw-semibold">School ERP System</h4>
                        <p class="small opacity-75">
                            Smart management for students, fees & academics
                        </p>
                    </div>
                </div>

                {{-- RIGHT SIDE : LOGIN FORM --}}
                <div class="col-md-6 p-4 p-md-5">

                    <h4 class="text-center mb-4 fw-semibold">Admin Login</h4>

                    <form method="POST" action="#">
                        @csrf

                        {{-- Email --}}
                        <div class="form-outline mb-3">
                            <input type="email" name="email" id="email" class="form-control" required autofocus>
                            <label class="form-label" for="email">Email Address</label>
                        </div>

                        {{-- Password --}}
                        <div class="form-outline mb-4">
                            <input type="password" name="password" id="password" class="form-control" required>
                            <label class="form-label" for="password">Password</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            Login
                        </button>

                        <div class="text-center">
                            <small>
                                First time setup?
                                <a href="{{ route('admin.register') }}">Create Admin</a>
                            </small>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
