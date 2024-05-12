<div>
    <section class="vh-100 mt-2 px-3 p-2">
        <div class="container py-2 h-75 shadow-lg p-3 mb-5 bg-body rounded">
            {{-- Success message --}}
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            {{-- End of success message --}}
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-4 col-lg-4 ">
                    <img src="{{ asset('assets/images/updated.png') }}" class="img-fluid" alt="dmmmsu-logo">
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6 offset-xl-1">
                    <form wire:submit.prevent="addUser">
                        @csrf

                        <!-- Name and Username -->
                        <div class="row g-3 mb-1">
                            <div class="col">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" wire:model.live="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="username">Username</label>
                                <input type="text" id="username" class="form-control form-control-sm @error('username') is-invalid @enderror" name="username" wire:model.live="username">
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email and User Type -->
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" wire:model.live="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="role">User Type</label>
                                <select id="role" class="form-select form-select-sm @error('role') is-invalid @enderror" name="role" wire:model="role">
                                    <option value="">Select User Type</option>
                                    @foreach ($userTypes as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password and Confirm Password -->
                        <div class="row g-3 mb-2">
                            <div class="col-md-6">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" wire:model="password">
                                    <span class="input-group-text" onclick="togglePasswordVisibility()">
                                        <i class="bi bi-eye-slash" id="password-visibility-icon"></i>
                                    </span>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="cpassword">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" id="cpassword" class="form-control form-control-sm @error('cpassword') is-invalid @enderror" name="cpassword" wire:model="cpassword">
                                    <span class="input-group-text" onclick="toggleConfirmPasswordVisibility()">
                                        <i class="bi bi-eye-slash" id="confirm-password-visibility-icon"></i>
                                    </span>
                                </div>
                                @error('cpassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Campus Input -->
                        <div class="mb-3">
                            <label for="campus">Campus</label>
                            <select type="text" id="campus" class="form-select form-select-sm @error('campus') is-invalid @enderror" name="campus" wire:model="campus" @if($role != 2) disabled @endif>
                                <option selected>Select below...</option>
                                @foreach ($campuses as $campus)
                                <option value="{{ $campus->id }}">{{ $campus->campus_name }}</option>
                                @endforeach
                            </select>
                            @error('campus')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Submit button -->
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-success btn-md btn-rounded">Register</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-visibility-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.replace('bi-eye-slash', 'bi-eye');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.replace('bi-eye', 'bi-eye-slash');
            }
        }

        function toggleConfirmPasswordVisibility() {
            const confirmPasswordInput = document.getElementById('cpassword');
            const confirmPasswordIcon = document.getElementById('confirm-password-visibility-icon');

            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
                confirmPasswordIcon.classList.replace('bi-eye-slash', 'bi-eye');
            } else {
                confirmPasswordInput.type = 'password';
                confirmPasswordIcon.classList.replace('bi-eye', 'bi-eye-slash');
            }
        }

        // Function to enable/disable Campus input based on selected User Type
        document.getElementById('role').addEventListener('change', function() {
            const campusInput = document.getElementById('campus');
            if (this.value == 2) {
                campusInput.disabled = false;
            } else {
                campusInput.disabled = true;
                campusInput.value = ''; // Reset the value when disabled
            }
        });
    </script>
</div>
