<?php $__env->startPush("scripts"); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection("content"); ?>
    <div class="auth-shell">

        <!-- ============ VISUAL / CTA SIDE ============ -->
        <div class="auth-visual">
            <div class="vbrand">
                <img src="<?php echo e(asset('img/logo.png')); ?>" height="40">
            </div>

            <div class="copy">
                <div class="eyebrow">Brand Partnerships, Simplified</div>
                <h2>Every deal, every payout, pointed in one direction — up.</h2>
                <p>Track brand campaigns, watch performance move in real time, and get paid on schedule. Built for creators
                    and partnership teams closing deals every week.</p>
            </div>

            <!-- Directional / sales CTA illustration (inline SVG, no external image) -->
            <svg class="cta-graphic" viewBox="0 0 340 260" fill="none" xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true">
                <path d="M20 210 C 70 210, 90 150, 130 150 S 190 90, 230 90 S 280 40, 320 40" stroke="#2E3C5C"
                    stroke-width="2" stroke-dasharray="4 6" />
                <path d="M20 210 C 70 210, 90 150, 130 150 S 190 90, 230 90 S 280 40, 320 40" stroke="url(#lineGrad)"
                    stroke-width="3" stroke-linecap="round" />
                <defs>
                    <linearGradient id="lineGrad" x1="20" y1="210" x2="320" y2="40" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#0F6E5F" />
                        <stop offset="1" stop-color="#F2A93B" />
                    </linearGradient>
                </defs>
                <!-- deal nodes -->
                <circle cx="20" cy="210" r="5" fill="#0F6E5F" />
                <circle cx="130" cy="150" r="5" fill="#1D8C79" />
                <circle cx="230" cy="90" r="5" fill="#F2A93B" />
                <g transform="translate(298,18)">
                    <circle cx="22" cy="22" r="22" fill="#F2A93B" />
                    <path d="M13 24 L20 31 L32 15" stroke="#141B29" stroke-width="3" stroke-linecap="round"
                        stroke-linejoin="round" />
                </g>
                <!-- arrow pointing direction -->
                <path d="M320 40 L306 30 M320 40 L308 52" stroke="#F2A93B" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round" />
                <!-- floating deal chips -->
                <g transform="translate(40,60)">
                    <rect width="86" height="30" rx="9" fill="#1D2739" stroke="#324062" />
                    <text x="12" y="19" fill="#C9D2DE" font-family="IBM Plex Mono" font-size="11">+18.4% CTR</text>
                </g>
                <g transform="translate(150,190)">
                    <rect width="98" height="30" rx="9" fill="#1D2739" stroke="#324062" />
                    <text x="12" y="19" fill="#C9D2DE" font-family="IBM Plex Mono" font-size="11">$4,120 payout</text>
                </g>
            </svg>

            <div class="proof">
                <div>
                    <div class="p-val">312+</div>
                    <div class="p-lab">Active Brands</div>
                </div>
                <div>
                    <div class="p-val">$2.4M</div>
                    <div class="p-lab">Paid Out</div>
                </div>
                <div>
                    <div class="p-val">4.8/5</div>
                    <div class="p-lab">Partner Rating</div>
                </div>
            </div>
        </div>

        <!-- ============ FORM SIDE (Sign in + Sign up, same page) ============ -->
        <div class="auth-form-side">
            <div class="auth-card">
                <?php echo $__env->make("partial.admin.alert", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="auth-switch" role="tablist">
                    <a href="#" class="active" id="tab-signin" data-bs-toggle="tab" data-bs-target="#pane-signin"
                        role="tab">Sign in</a>

                    <?php if($admin != $type): ?>
                        <a href="#" id="tab-signup" data-bs-toggle="tab" data-bs-target="#pane-signup" role="tab">Sign up</a>
                    <?php endif; ?>
                </div>

                <div class="tab-content">

                    <!-- SIGN IN -->
                    <div class="tab-pane fade show active" id="pane-signin" role="tabpanel">
                        <h1 class="font-display" style="font-size:26px;font-weight:600;margin-bottom:4px;">Welcome back</h1>
                        <p style="font-size:13.5px;color:var(--slate);margin-bottom:24px;">Sign in to check your latest
                            brand performance.</p>

                        <form method="POST" action="<?php echo e(route('login', ['type' => $type])); ?>" id="loginForm">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <div class="input-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 6h18v12H3z" />
                                        <path d="m3 7 9 6 9-6" />
                                    </svg>
                                    <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>"
                                        class="form-control w-100" placeholder="you@brand.com">
                                </div>
                            </div>
                            <div class="mb-2 position-relative">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label">Password</label>
                                    <a href="<?php echo e(route('password.request')); ?>"
                                        style="font-size:12px;color:var(--teal);font-weight:600;">Forgot?</a>
                                </div>
                                <div class="input-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="4" y="10" width="16" height="10" rx="2" />
                                        <path d="M8 10V7a4 4 0 0 1 8 0v3" />
                                    </svg>
                                    <input type="password" id="password" name="password" class="form-control w-100"
                                        placeholder="••••••••••">
                                    <i class="fa fa-eye-slash field-icon text-muted" id="password-icon"
                                        onclick="showPassword('password')"></i>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Sign in to ThousandsLink</button>
                        </form>
                    </div>

                    <!-- SIGN UP -->
                    <div class="tab-pane fade" id="pane-signup" role="tabpanel">
                        <h1 class="font-display" style="font-size:26px;font-weight:600;margin-bottom:4px;">Create your
                            account</h1>
                        <p style="font-size:13.5px;color:var(--slate);margin-bottom:24px;">Basic details first. A quick
                            4-step profile setup follows.</p>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label">First name</label>
                                <input type="text" id="first_name" class="form-control w-100" placeholder="Amara">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Last name</label>
                                <input type="text" id="last_name" class="form-control w-100" placeholder="Khan">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Work email</label>
                            <div class="input-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 6h18v12H3z" />
                                    <path d="m3 7 9 6 9-6" />
                                </svg>
                                <input type="email" id="work_email" class="form-control w-100" placeholder="you@brand.com">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Create password</label>
                            <div class="input-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="4" y="10" width="16" height="10" rx="2" />
                                    <path d="M8 10V7a4 4 0 0 1 8 0v3" />
                                </svg>
                                <input type="password" id="create_password" class="form-control w-100" placeholder="Min. 8 characters">
                            </div>
                        </div>
                        <button type="button" id="signup-continue" class="btn btn-amber w-100">Continue to profile
                            setup</button>
                        <p style="font-size:11.5px;color:var(--slate-2);margin-top:16px;">By continuing you agree to
                            ThousandsLink's Terms and Payout Policy.</p>
                    </div>

                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
                window.location.href = "<?php echo e(route('register', ['type' => $type])); ?>";
            });
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make("layouts.panel_guest", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pub.affishare.com\resources\views/auth/login.blade.php ENDPATH**/ ?>