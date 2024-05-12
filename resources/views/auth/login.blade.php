@include('layouts.header')
    <section class="d-flex align-items-center justify-content-center" style="height: 90vh;">
        <div class="container shadow-sm p-3 mb-5 bg-body rounded">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <img src=" {{ asset('assets/images/updated.png') }} " class="img-fluid" alt="dmmmsu-logo">
                </div>
                <div class="col-md-7 col-lg-6 col-xl-4 offset-xl-1">
                    @if (session('message'))
                        <div class="alert alert-success text-center" id="message">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if ($errors->has('login'))
                        <div class="alert alert-danger" role="alert" id="errorAlert">
                            {{ $errors->first('login') }}
                        </div>

                        <script>
                            // Automatically dismiss the error message after 10 seconds
                            setTimeout(function() {
                                var errorAlert = document.getElementById('errorAlert');
                                if (errorAlert) {
                                    errorAlert.style.display = 'none';
                                }
                            }, 3000); // 5seconds (10,000 milliseconds)
                        </script>
                    @endif

                    <form action="{{ route('login.action') }}" method="POST">
                        @csrf

                        <!-- Username input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="username" name="username">Username</label>
                            <input type="text" id="username"
                                class="form-control form-control-sm @error('username') is-invalid @enderror"
                                name="username" />
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-2">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password"
                                class="form-control form-control-sm @error('password') is-invalid @enderror"
                                name="password" />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="d-flex-inline mb-4">
                            <input type="checkbox" id="showPass" name="showPass" onclick="showPassword()">
                            <label for="showPass">Show password</label>
                        </div>

                        {{-- <div class="mt-1 mb-2 float-end" style="cursor:pointer;">
                        <a href="{{ route('password.request') }}">forgot password?</a>
                    </div> --}}
                        {{-- script here --}}
                        <script>
                            function showPassword() {
                                const passwordInput = document.getElementById("password");
                                const showPassCheckbox = document.getElementById("showPass");

                                if (showPassCheckbox.checked) {
                                    passwordInput.type = 'text';
                                } else {
                                    passwordInput.type = 'password';
                                }
                            }
                        </script>
                        {{-- end here --}}


                        <!-- Submit button -->
                        <button type="submit"
                            class="btn btn-success btn-rounded btn-fw form-control fw-bold">Log
                            in</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
@include('layouts.footer')
