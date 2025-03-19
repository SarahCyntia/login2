<!-- <script setup>
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
            router.push('/home');
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
    //     const response = await axiosClient.post("/verify-otp", {
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
</script> -->

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import router from '../router';

const otp = ref('');
const data = ref('');
// const data = ref({ otpVerifying: false });
// const otp = ref("");
// const message = ref("");
// const email = ref("");

// const submitLogin = async () => {
//     try {
//         const response = await axiosClient.post("/verify", {
//             email: email.value,
//             otp: otp.value,
//         });
//         if (response.status === 200) {
//             const token = response.data.token;
//             localStorage.setItem('authToken', token);
//             localStorage.setItem("name", response.data.user.name);
//         Swal.fire({
//             icon: "success",
//             title: "Login Berhasil!",
//         });
//         router.push("/home");
//     }
//         message.value = response.data.message;
//     } catch (error) {
//         Swal.fire({
//             icon: "error",
//             title: "Login Gagal",
//             text: error.response?.data?.message || "Kode OTP salah!",
//         });  
//     }
// };

const submitLogin = async () => {
    // if (!otp.value) {
    //     alert('Silakan masukkan kode OTP.');
    //     return;
    // }
    
    // data.value.otpVerifying = true;
    
    try {
        // Mengirim permintaan verifikasi OTP ke backend Laravel
        const response = await axios.post('/api/verify', { 
            // email: email.value,
            otp: otp.value });
        
        if (response.status === 200) {
            const token = response.data.token
            alert('OTP berhasil diverifikasi!');
            // Redirect atau tindakan lain setelah verifikasi
            router.push("/home")
        } else {
            alert('Kode OTP salah. Silakan coba lagi.');
        }
    } catch (error) {
        console.error('Kesalahan saat verifikasi:', error);
        alert('Terjadi kesalahan. Coba lagi nanti.');
    }
    
    data.value.otpVerifying = false;
};
</script>

<template>
      <div class="w-130 h-80 mt-50 ml-145 rounded-md bg-white px-3 py-1.5  outline-5 -outline-offset-1 outline-gray-900  focus:outline-5 focus:-outline-offset-3">
      <h2 class="mt- text-center text-2xl/30 font-bold tracking-tight text-gray-900">
          Verifikasi
      </h2>

      <div class="mt-1 sm:mx-auto sm:w-full sm:max-w-sm">
          <form @submit.prevent="submitLogin" class="space-y-6">
              <div>
                  <div class="mt-2">
                      <label for="otp" class="block text-sm/6 font-medium text-gray-900">Kode OTP</label>
                      <input type="otp" name="otp" id="otp" autocomplete="otp" required
                          class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                  </div>
                </div>
              <div>
                  <button type="submit"
                      class="mt-7 flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                      <!-- Masuk -->
                      {{ data.otpVerifying ? 'Memverifikasi...' : 'Masuk' }}
                  </button>
              </div>
          </form>

          
      </div>
  </div>
</template>