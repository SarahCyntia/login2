<template>
    <div class="w-150 h-135 mt-25 ml-135 rounded-md bg-white px-3 py-1.5  outline-5 -outline-offset-1 outline-gray-900  focus:outline-5 focus:-outline-offset-3">
    <h2 class="mt-10 text-center text-2xl/30 font-bold tracking-tight text-gray-900">
        Masuk
    </h2>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <!-- <form @submit.prevent="submitLogin" class="space-y-6"> -->
            <div>
                <div class="mt-2">
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                    <input type="email" name="email" id="email" autocomplete="email" required
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <!--<label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>-->
                    <label for="inputPassword6" class="col-form-label">Kata Sandi</label>
                    <!-- <div class="text-sm">
                        <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Lupa password?</a>
                    </div> -->
                </div>
                <div class="mt-2">
                    <input type="password" name="password" id="password" autocomplete="current-password" required
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
            </div>

            <div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Masuk
                </button>
            </div>
        <!-- </form> -->

        <p class="mt-10 text-center text-sm/6 text-gray-500">
            Tidak memiliki akun?
            {{ " " }}
            <router-link to="/register" class="font-semibold text-indigo-600 hover:text-indigo-500">Buat <span>akun</span></router-link>
            <!-- <a href="/register" class="font-semibold text-indigo-600 hover:text-indigo-500">Buat akun</a> -->
        </p>
    </div>
</div>
</template>