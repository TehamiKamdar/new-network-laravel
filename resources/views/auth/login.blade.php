@extends("layouts.panel_guest")

@push("scripts")
    <script>
        $("#loginForm").validate({
            rules: {
                "email": {
                    required: true,
                },
                "password": {
                    required: true,
                }
            },
            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) { // un-hightlight error inputs
                $(element)
                    .closest('.form-group').removeClass('has-error');
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.input-modal-group'));
            }
        });
    </script>
@endpush

@push('styles')
@endpush

@section("content")
    <div class="row justify-content-center">
        
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mt-4 card-bg-fill">

                <div class="card-body p-4">
                    @include("partial.admin.alert")

                    <div class="text-center mt-2">
                        <h5 class="text-primary">Welcome Back !</h5>
                        <p class="text-muted">Sign in to continue to Velzon.</p>
                    </div>
                    <div class="p-2 mt-4">
                        <form method="POST" action="{{ route('login', ['type' => $type]) }}" id="loginForm">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="email@example.com">
                            </div>

                            <div class="mb-3">
                                <div class="float-end">
                                    <a href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                                </div>
                                <label class="form-label" for="password-input">Password</label>
                                <div class="position-relative auth-pass-inputgroup mb-3">
                                    <input type="password" class="form-control pe-5 password-input" placeholder="••••••••••" id="password" name="password">
                                    <button onclick="showPassword('password')" class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-success w-100" type="submit">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="mt-4 text-center">
                <p class="mb-0">Don't have an account ? <a href="{{ route('register', ['type' => $type]) }}" class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            
            var stepOneData = localStorage.getItem('stepOne');
            if(stepOneData){
                var data = JSON.parse(stepOneData);
                $('#first_name').val(data.first_name);
                $('#last_name').val(data.last_name);
                $('#work_email').val(data.email);
                $('#create_password').val(data.password);
            }

            $('#signup-continue').click(function(e){
                e.preventDefault();
                var firstName = $('#first_name').val().trim();
                var lastName = $('#last_name').val().trim();
                var email = $('#work_email').val().trim();
                var password = $('#create_password').val().trim();

                console.log("First Name:", firstName);
                console.log("Last Name:", lastName);
                console.log("Email:", email);
                console.log("Password:", password);

                if(firstName === '' || lastName === '' || email === '' || password === ''){
                    alert('Please fill in all required fields.');
                    return;
                }

                localStorage.setItem('stepOne', JSON.stringify({
                    first_name: firstName,
                    last_name: lastName,
                    email: email,
                    password: password
                }));

                // Redirect to the registration route with query parameters
                window.location.href = "{{ route('register', ['type' => $type]) }}";
            });
        })
    </script>
@endpush