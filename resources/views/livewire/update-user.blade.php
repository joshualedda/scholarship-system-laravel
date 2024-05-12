<div>
    <section class="p-2">
        <div class="row">
            <div class="col-12 com-md-12">
                <div class="card">
                    <div class="card-header">
                        Profile
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="updateUser">
                            @csrf
                            <div class="mb-3">
                                @if (session()->has('success'))
                                <div class="alert alert-success text-center">
                                    {{ session('success') }}
                                </div>
                                @endif
                                @if (session()->has('error'))
                                <div class="alert alert-danger text-center">
                                    {{ session('error') }}
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control form-control-sm" id="name" name="name"
                                            wire:model="name">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control form-control-sm" id="username"
                                            name="username" wire:model="username">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="text" class="form-control form-control-sm" id="email" name="email"
                                            wire:model="email">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="role" class="form-label">Role</label>
                                        <select class="form-select form-select-sm" id="role" name="role"
                                            wire:model="role">
                                            <option value="1">Admin</option>
                                            <option value="0">Staff</option>
                                            <option value="2">Campus In-charge NLUC</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-6">
                                        <label for="password">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-sm" id="password"
                                                name="password" wire:model="password">
                                            <span class="input-group-text"
                                                onclick="togglePasswordVisibility('password')">
                                                <i class="bi bi-eye-slash"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="confirmPass">Confirm Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-sm" id="confirmPass"
                                                name="confirmPass" wire:model="confirmPass">
                                            <span class="input-group-text"
                                                onclick="togglePasswordVisibility('confirmPass')">
                                                <i class="bi bi-eye-slash"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">Update</button>
                            <a href="{{ url('/userAccount') }}" type="submit" class="btn btn-danger">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function togglePasswordVisibility(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const eyeIcon = passwordField.nextElementSibling.querySelector('i');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
        }
        }
    </script>
</div>
