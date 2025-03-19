<script setup>
import { ref } from "vue";
import GuestLayout from "../components/GuestLayout.vue";
import axiosClient from "../axios";
import router from "../router";
import Swal from "sweetalert2";

const otp = ref("");
const message = ref("");
const email = ref("");

const sendOtp = async () => {
    console.log('email ditekan')
    try {
        await axiosClient.post("/send-otp", {
            email: email.value
        });
        console.log('mengirim'),
            Swal.fire({
                icon: "success",
                title: "OTP berhasil dikirim!",
            });
            router.push('/otp.login');
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Email Tidak Ditemukan",
            // text: error.response?.data?.message || "Terjadi kesalahan!",
        });
    }
};  
</script>

<template>
    <div
        class="w-130 h-80 mt-50 ml-145 rounded-md bg-white px-3 py-1.5  outline-5 -outline-offset-1 outline-gray-900  focus:outline-5 focus:-outline-offset-3">
        <h2 class="mt- text-center text-2xl/30 font-bold tracking-tight text-gray-900">
            Masuk
        </h2>

        <div class="mt-1 sm:mx-auto sm:w-full sm:max-w-sm">
            <div>
                <div class="mt-2">
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                    <input type="email" name="email" id="email" autocomplete="email" required v-model="email"
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                    <button @click="sendOtp"
                        class="mt-7 flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        kirim OTP
                    </button>
                </div>
            </div>

        </div>
    </div>
</template>