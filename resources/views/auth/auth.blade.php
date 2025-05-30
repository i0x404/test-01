@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm" x-data="{ activeTab: 'login' }">
                <div class="card-header bg-white">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link" :class="{ 'active': activeTab === 'login' }" href="#" @click.prevent="activeTab = 'login'">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" :class="{ 'active': activeTab === 'register' }" href="#" @click.prevent="activeTab = 'register'">Register</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <!-- Login Form -->
                    <div x-show="activeTab === 'login'" x-transition>
                        <h4 class="mb-4 text-center">Welcome Back</h4>
                        <form id="loginForm" x-data="{ 
                            email: '', 
                            password: '', 
                            loading: false,
                            submitLogin() {
                                this.loading = true;
                                axios.post('/api/auth/login', {
                                    email: this.email,
                                    password: this.password
                                })
                                .then(response => {
                                    localStorage.setItem('token', response.data.token);
                                    window.location.href = '/home';
                                })
                                .catch(error => {
                                    this.loading = false;
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Login Failed',
                                        text: error.response?.data?.message || 'Invalid credentials. Please try again.'
                                    });
                                });
                            }
                        }" @submit.prevent="submitLogin">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" x-model="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" x-model="password" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" :disabled="loading">
                                    <span x-show="loading" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Registration Form -->
                    <div x-show="activeTab === 'register'" x-transition>
                        <h4 class="mb-4 text-center">Create New Account</h4>
                        <form id="registerForm" x-data="{ 
                            fullName: '', 
                            email: '', 
                            password: '', 
                            passwordConfirmation: '',
                            userType: 'student',
                            loading: false,
                            submitRegistration() {
                                this.loading = true;
                                axios.post('/api/auth/register', {
                                    fullName: this.fullName,
                                    email: this.email,
                                    password: this.password,
                                    password_confirmation: this.passwordConfirmation,
                                    userType: this.userType
                                })
                                .then(response => {
                                    localStorage.setItem('token', response.data.token);
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Registration Successful',
                                        text: 'Welcome to DirassaTech!'
                                    }).then(() => {
                                        window.location.href = '/home';
                                    });
                                })
                                .catch(error => {
                                    this.loading = false;
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Registration Failed',
                                        text: error.response?.data?.message || 'Please check your information and try again.'
                                    });
                                });
                            }
                        }" @submit.prevent="submitRegistration">
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" x-model="fullName" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerEmail" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="registerEmail" x-model="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="registerPassword" x-model="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="passwordConfirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="passwordConfirmation" x-model="passwordConfirmation" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">User Type</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="userType" id="student" value="student" x-model="userType">
                                        <label class="form-check-label" for="student">Student</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="userType" id="teacher" value="teacher" x-model="userType">
                                        <label class="form-check-label" for="teacher">Teacher</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="userType" id="parent" value="parent" x-model="userType">
                                        <label class="form-check-label" for="parent">Parent</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" :disabled="loading">
                                    <span x-show="loading" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
