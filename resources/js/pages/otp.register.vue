<script setup>
import { ref } from "vue";
// import GuestLayout from "./components/GuestLayout.vue";
import axiosClient from "../axios";
import router from "../router";
import Swal from "sweetalert2";

const data = ref({
    otp: "",
    // otpRequested: false,
    // otpSending: false,
    // otpVerifying: false
});
const email = localStorage.getItem('email');
// Request OTP to be sent to email
// const requestOTP = async () => {
//     console.log('tekan')
//     try {
//         data.value.otpSending = true;
//         const response = await axiosClient.post("/verifyOtp", {
//             email: data.value.email
//         });

//         if (response.data.success) {
//             data.value.otpRequested = true;
//             Swal.fire({
//                 icon: 'success',
//                 title: 'OTP Terkirim!',
//                 text: 'Kode OTP telah dikirim ke email Anda. Silakan periksa kotak masuk Anda.'
//             });
//         }
//     } catch (error) {
//         Swal.fire({
//             icon: 'error',
//             title: 'Gagal Mengirim OTP!',
//             text: error.response?.data?.message || 'Terjadi kesalahan saat mengirim OTP.'
//         });
//     } finally {
//         data.value.otpSending = false;
//     }
// }

// Verify OTP and login
const verifyOTP = async () => {
    console.log("Data yang dikirim:", { email, otp: otp.value });

if (!email || !otp.value) {
    Swal.fire({
        icon: 'warning',
        title: 'Input Tidak Lengkap',
        text: 'Pastikan email dan OTP sudah diisi!'
    });
    return;
}

try {
        const response = await axiosClient.post("/verify-otp", {
            email: email,
            otp: otp.value
        });

        console.log("Response dari server:", response); // Debugging

        // Perbaikan: Gunakan response.status atau cek pesan sukses dari API
        if (response.status === 200) {
            // localStorage.setItem('token', response.data.token);
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil!',
                // text: 'Anda akan diarahkan ke halaman utama.'
                text: 'Anda berhasil login.'
            });
            router.push('/');
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Verifikasi Gagal',
                text: response.data.message || 'OTP tidak valid. Silakan coba lagi.'
            });
        }
    } catch (error) {
        console.error("Error saat verifikasi OTP:", error);
        
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: error.response?.data?.message || 'Terjadi kesalahan saat menghubungi server.'
        });
    }
    // console.log("Data yang dikirim:", data.value);
    // try {
    //     // data.value.otpVerifying = true;
    //     const response = await axiosClient.post("/api/verify-otp", {
    //         email: email,
    //         otp: otp.value
    //     });

    //     if (response.data.token) {
    //         localStorage.setItem('token', response.data.token);
    //         Swal.fire({
    //             icon: 'success',
    //             title: 'Login Berhasil!'
    //         });
    //         router.push('/');
    //     }
    // } catch (error) {
    //     Swal.fire({
    //         icon: 'error',
    //         title: 'Verifikasi OTP Gagal!',
    //         text: error.response?.data?.message || 'Kode OTP tidak valid atau telah kedaluwarsa.'
    //     });
     finally {
        data.value.otpVerifying = false;
    }
}

// Reset the process to request a new OTP
const resetOTPRequest = () => {
    data.value.otpRequested = false;
    data.value.otp = "";
}
</script>

<template>
    <div
        class="w-130 h-80 mt-50 ml-145 rounded-md bg-white px-3 py-1.5  outline-5 -outline-offset-1 outline-gray-900  focus:outline-5 focus:-outline-offset-3">
        <h2 class="mt- text-center text-2xl/30 font-bold tracking-tight text-gray-900">
        Verifikasi
      </h2>

        <div class="mt-1 sm:mx-auto sm:w-full sm:max-w-sm">
            <!-- Email OTP Form -->
            <form @submit.prevent="verifyOTP" class="space-y-6">
                <!-- Email Input -->
                <div>
                    <label for="otp" class="block text-sm/6 font-medium text-gray-900">Kode OTP</label>
                    <div class="mt-2">
                        <input type="otp" name="otp" v-model="data.otp" id="otp" autocomplete="otp" required
                            :disabled="data.otpRequested"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                    </div>
                </div>

                <!-- OTP Input (shown after requesting OTP) -->
                <!-- <div v-if="data.otpRequested">
            <label for="otp" class="block text-sm/6 font-medium text-gray-900">Kode OTP</label>
            <div class="mt-2">
              <input 
                type="text" 
                name="otp" 
                id="otp" 
                required
                v-model="data.otp"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" 
                placeholder="Masukkan kode OTP yang dikirim ke email Anda"
              />
            </div>
            <div class="mt-2 text-sm text-right">
              <button 
                type="button" 
                @click="changeEmail"
                class="font-semibold text-indigo-600 hover:text-indigo-500">
                Ubah Email
              </button>
            </div>
          </div> -->

                <!-- Submit Button (Request OTP or Verify OTP) -->
                <div>
                    <div>
                        <button type="submit"
                            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Daftar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<!-- <style scoped>

</style> -->