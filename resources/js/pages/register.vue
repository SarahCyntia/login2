<!-- <script setup>
import { ref } from "vue";
import axiosClient from "../axios";
import router from "../router";
import Swal from "sweetalert2";


// Data untuk form
const data = ref({
  name: "",
  email: "",
  password: "",
});

// State untuk menampung error
const errors = ref({});

const register = async () => {
  try {
    let response = await axiosClient.post("/register", {
      name: data.value.name,
      email: data.value.email,
      password: data.value.password,
    });
    
    // Redirect ke halaman login setelah sukses
    router.push({ path: "/otp.register" }); 
    Swal.fire({
                icon: 'success',
                title: 'Register Berhasil!'
                // timer: 2000, // Auto-close dalam 2 detik
                // showConfirmButton: false
            });
    // alert("Register berhasil")
    
  } catch (error) {
    // Menyimpan error response jika terjadi kesalahan
    // alert("Anda sudah memiliki akun tersebut")

    Swal.fire({
            icon: 'error',
            title: 'Email tersebut sudah terdaftar',
            // text: error.response?.data?.message || 'Email atau password salah.',
        });   
         errors.value = error.response?.data || { message: "Terjadi kesalahan." };
  }
};
</script> -->

<script setup>
import { ref } from "vue";
import GuestLayout from "../components/GuestLayout.vue";
import axiosClient from "../axios";
import router from "../router";
import { RouterLink } from "vue-router";
import Swal from "sweetalert2"; // Import SweetAlert2

const data = ref({
    name: "",
    email: "",
    password: "" // Konfirmasi password jika diperlukan
});

const errorMessage = ref(""); // Untuk menampilkan pesan error jika registrasi gagal

const register = async () => {
    console.log("Tombol register ditekan");

    try {
        const response = await axiosClient.post("/register", 
        data.value);
        console.log("Registrasi berhasil!");

        Swal.fire({
            icon: "info",
            title: "OTP Terkirim!",
            text: "Silakan cek email Anda dan masukkan kode OTP.",
            confirmButtonText: "OK"
        });
        localStorage.setItem("email", data.value.email);
        // Redirect ke halaman OTP jika berhasil
        router.push("/otp.register");
    } catch (error) {
        console.error("Error:", error);

        if (error.response) {
            if (error.response.status === 422) {
                Swal.fire({
                    icon: "error",
                    title: "Validasi Gagal!",
                    text: "Periksa kembali data yang Anda masukkan.",
                });
            } else if (error.response.status === 409) {
                Swal.fire({
                    icon: "error",
                    title: "Email sudah terdaftar!",
                    text: "Gunakan email lain atau lakukan login.",
                });
            } else if (error.response.status === 500) {
                Swal.fire({
                    icon: "error",
                    title: "Server Error!",
                    text: "Terjadi kesalahan di server. Coba lagi nanti.",
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Registrasi Gagal!",
                    text: error.response.data.message || "Terjadi kesalahan, coba lagi.",
                });
            }
        } else {
            Swal.fire({
                icon: "error",
                title: "Koneksi Gagal!",
                text: "Tidak dapat terhubung ke server.",
            });
        }
    }
};
</script>

<template>
    <GuestLayout>
        <div
            class="w-150 h-130 mt-18 ml-135 rounded-md bg-white px-3 py-1.5  outline-5 -outline-offset-1 outline-gray-900  focus:outline-5 focus:-outline-offset-3">

            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">
                Buat Akun
            </h2>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form @submit.prevent="register" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm/6 font-medium text-gray-900">Nama</label>
                        <div class="mt-2">
                            <input type="name" name="name" id="name" autocomplete="name" required="" v-model="data.name"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>
                    <div>
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                        <div class="mt-2">
                            <input type="email" name="email" id="email" autocomplete="email" required=""
                                v-model="data.email"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm/6 font-medium text-gray-900">Kata Sandi</label>
                            <!-- <div class="text-sm">
                            <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Lupa Password?</a>
                        </div> -->
                        </div>
                        <div class="mt-2">
                            <input type="password" name="password" id="password" autocomplete="current-password"
                                required="" v-model="data.password"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                            class="mt-10 flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Daftar
                            <router-link to="/otp.register" class="font-semibold text-indigo-600 hover:text-indigo-500"></router-link>
                            <!-- <a href="/" class="font-semibold text-indigo-600 hover:text-indigo-500"></a> -->
                        </button>
                    </div>
                </form>
                <!-- <p class="mt-10 text-center text-sm/6 text-gray-500">
                Sudah memiliki akun?
                {{ " " }}
                <router-link to="/login" class="font-semibold text-indigo-600 hover:text-indigo-500">masuk</router-link>
                <a href="/register" class="font-semibold text-indigo-600 hover:text-indigo-500">Buat akun</a>
            </p> -->
                <!-- <p class="mt-10 text-center text-sm/6 text-gray-500">
                Tidak memiliki akun?
                Don't have account?
                {{" "}}
            </p> -->
            </div>
        </div>
    </GuestLayout>
</template>
<style scoped></style>