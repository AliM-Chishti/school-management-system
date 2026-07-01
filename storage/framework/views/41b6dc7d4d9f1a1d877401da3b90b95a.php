

<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('content'); ?>
<div class="mx-auto w-full max-w-7xl">
    <div class="grid gap-8 lg:grid-cols-[1.25fr_0.95fr] items-center">
        <section class="relative overflow-hidden rounded-[2rem] bg-slate-950 px-8 py-10 text-slate-100 shadow-2xl shadow-slate-900/20 sm:px-12 sm:py-14">
            <div class="absolute -right-16 top-10 h-72 w-72 rounded-full bg-sky-500/10 blur-3xl"></div>
            <div class="absolute left-8 top-4 h-32 w-32 rounded-full bg-violet-500/10 blur-3xl"></div>
            <div class="relative z-10">
                <span class="inline-flex items-center rounded-full bg-sky-500/10 px-4 py-1 text-sm font-semibold text-sky-200 ring-1 ring-sky-200/20">
                    Premium school management
                </span>

                <h1 class="mt-8 max-w-xl text-4xl font-semibold tracking-tight text-white sm:text-5xl">
                    Welcome back to your modern school workspace.
                </h1>

                <p class="mt-6 max-w-xl text-base leading-8 text-slate-300 sm:text-lg">
                    Manage students, teachers, attendance and fees from one elegant dashboard with the productivity and polish of enterprise-grade SaaS.
                </p>

                <div class="mt-10 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl border border-slate-700/80 bg-slate-950/80 p-5 backdrop-blur-xl transition hover:border-sky-400/30 hover:bg-slate-900/90">
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-sky-300">Students</p>
                        <p class="mt-4 text-3xl font-semibold">1,280</p>
                        <p class="mt-2 text-sm text-slate-400">Active learners this semester</p>
                    </div>
                    <div class="rounded-3xl border border-slate-700/80 bg-slate-950/80 p-5 backdrop-blur-xl transition hover:border-violet-400/30 hover:bg-slate-900/90">
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-violet-300">Teachers</p>
                        <p class="mt-4 text-3xl font-semibold">72</p>
                        <p class="mt-2 text-sm text-slate-400">Faculty members on duty</p>
                    </div>
                </div>

                <div class="mt-10 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl border border-slate-700/80 bg-slate-950/80 p-5 backdrop-blur-xl transition hover:border-sky-400/30 hover:bg-slate-900/90">
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-sky-300">Attendance</p>
                        <p class="mt-4 text-3xl font-semibold">94%</p>
                        <p class="mt-2 text-sm text-slate-400">Daily attendance compliance</p>
                    </div>
                    <div class="rounded-3xl border border-slate-700/80 bg-slate-950/80 p-5 backdrop-blur-xl transition hover:border-violet-400/30 hover:bg-slate-900/90">
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-violet-300">Fees</p>
                        <p class="mt-4 text-3xl font-semibold">$48K</p>
                        <p class="mt-2 text-sm text-slate-400">Collected this month</p>
                    </div>
                </div>
            </div>

            <div class="pointer-events-none absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-slate-950/90 to-transparent"></div>
        </section>

        <section class="rounded-[2rem] bg-white px-8 py-10 shadow-2xl shadow-slate-900/10 ring-1 ring-slate-200/80 sm:px-10 sm:py-12">
            <div class="mb-8 flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-sky-500">School Management System</p>
                    <h2 class="mt-4 text-3xl font-semibold tracking-tight text-slate-950">Sign in to your account</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-500">Securely access your school dashboard and manage your campus operations.</p>
                </div>
                <div class="hidden h-14 w-14 rounded-3xl bg-slate-950/5 p-3 text-sky-500 sm:flex items-center justify-center">
                    <svg viewBox="0 0 24 24" fill="none" class="h-8 w-8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M8 9h8M8 13h6m-5 8h6a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z" />
                    </svg>
                </div>
            </div>

            <?php if(session('success')): ?>
                <div class="mb-6 rounded-3xl border border-sky-100 bg-sky-50 p-4 text-sm text-sky-700">
                    <div class="font-semibold">Success</div>
                    <p class="mt-1"><?php echo e(session('success')); ?></p>
                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="mb-6 rounded-3xl border border-red-100 bg-red-50 p-4 text-sm text-red-700">
                    <div class="font-semibold">There was a problem with your login.</div>
                    <ul class="mt-2 list-disc space-y-1 pl-5">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('login.post')); ?>" method="POST" class="space-y-5">
                <?php echo csrf_field(); ?>

                <div class="group relative">
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="<?php echo e(old('email')); ?>"
                        required
                        autofocus
                        placeholder=" "
                        class="peer h-14 w-full rounded-3xl border border-slate-200 bg-slate-50 px-5 pt-5 pb-3 text-sm text-slate-950 outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20"
                    />
                    <label for="email" class="pointer-events-none absolute left-5 top-4 origin-left text-sm text-slate-500 transition-all duration-200 peer-placeholder-shown:top-5 peer-placeholder-shown:text-sm peer-focus:top-3 peer-focus:text-xs peer-focus:text-sky-600">
                        Email address
                    </label>
                </div>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="group relative">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        placeholder=" "
                        class="peer h-14 w-full rounded-3xl border border-slate-200 bg-slate-50 px-5 pt-5 pb-3 text-sm text-slate-950 outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20"
                    />
                    <label for="password" class="pointer-events-none absolute left-5 top-4 origin-left text-sm text-slate-500 transition-all duration-200 peer-placeholder-shown:top-5 peer-placeholder-shown:text-sm peer-focus:top-3 peer-focus:text-xs peer-focus:text-sky-600">
                        Password
                    </label>
                    <button type="button" id="togglePassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 transition hover:text-slate-700" aria-label="Toggle password visibility">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </button>
                </div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                        <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-sky-600 focus:ring-sky-500" />
                        Remember me
                    </label>

                    <?php if(Route::has('password.request')): ?>
                        <a href="<?php echo e(route('password.request')); ?>" class="text-sm font-semibold text-slate-700 transition hover:text-sky-600">Forgot password?</a>
                    <?php else: ?>
                        <span class="text-sm font-semibold text-slate-400">Forgot password?</span>
                    <?php endif; ?>
                </div>

                <button type="submit" class="inline-flex h-14 w-full items-center justify-center rounded-3xl bg-gradient-to-r from-sky-600 to-violet-600 px-6 text-sm font-semibold text-white shadow-lg shadow-sky-500/20 transition hover:-translate-y-0.5 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500/40">
                    Sign in to dashboard
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-slate-500">
                New here? <a href="<?php echo e(route('register')); ?>" class="font-semibold text-slate-900 transition hover:text-sky-600">Create an account</a>
            </p>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        if (!toggleBtn || !passwordInput) return;

        toggleBtn.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            toggleBtn.classList.toggle('text-slate-400');
            toggleBtn.classList.toggle('text-slate-700');
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\SMS\resources\views/auth/login.blade.php ENDPATH**/ ?>