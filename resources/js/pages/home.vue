
<script setup>
import Swal from "sweetalert2";
import { useRouter } from "vue-router";
// import router from "../router";

//menambahkan nama
// import {ref, onMounted} from "vue";
// const name = ref("");
// onMounted(() => {
//     name.value = localStorage.getItem("name") || "User";
//     console.log(name.value);
// });

const router = useRouter(); // Menggunakan Vue Router untuk navigasi

const logout = () => {
    Swal.fire({
        title: "Apakah Anda yakin ingin keluar?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Keluar",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            // Hapus token dari localStorage
            localStorage.removeItem("authToken");

            // Menampilkan notifikasi sukses
            Swal.fire({
                icon: "success",
                title: "Berhasil Keluar!",
                // text: "Anda akan diarahkan ke halaman login.",
                confirmButtonText: "OK"
            }).then(() => {
                // Redirect ke halaman login
                router.push("/");
            });
        }
    });
};
</script>


<template>
    <div class="landing-page">
      <!-- Header -->
      <header>
      </header>
  
      <!-- Hero Section -->
      <section class="hero">
        <h1>Selamat <span>Datang</span> </h1><br><br>
        <p>Halaman Home</p> <br>
        <!-- <p>Di sini tidak ada apa apa</p> <br> -->
         <button @click="logout">
            Keluar
          <!-- <a href="/" class="font-semibold text-white hover:text-indigo-200">LOGOUT</a> -->
          <!-- <router-link to="/" class="font-semibold text-white hover:text-indigo-200">Logout</router-link> -->
        </button> 
      </section>

      <footer>
        <!-- <p>2025</p> -->
      </footer>
    </div>
  </template>
  
  <!-- <script>
  export default {
    name: 'LandingPage',
    methods: {
      goToContact() {
        window.scrollTo({
          top: document.getElementById('contact').offsetTop,
          behavior: 'smooth'
        });
      }
    }
  }
  </script> -->
  
  <style scoped>
  /* Styling untuk LandingPage.vue */
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  
  .landing-page {
    max-width: 2000px;
    margin: 0 auto;
    /* padding: 20px; */
  }
  
  header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 0;
    background-color: #333;
    color: #fff;
}

header .logo {
    font-size: 2rem;
    font-weight: bold;
    text-align: center;
    
  }
  
  header nav ul {
    display: flex;
    list-style: none;
  }
  
  header nav ul li {
    margin-left: 20px;
  }
  /* span {
      color: red;
  } */
  
  /* header nav ul li a {
    text-decoration: none;
    color: #fff;
    font-size: 1rem;
  } */
  
  .hero {
    background-color: #5b5c5b;
    color: white;
    text-align: center;
    padding: 80px 20px;
  }
  
  .hero h1 {
    font-size: 5rem;
  }
  
  .hero p {
    font-size: 1.5rem;
    margin: 20px 0;
  }
  
  button {
    padding: 10px 20px;
    background-color: #000000;
    color: white;
    
    /* border: none; */
    /* cursor: pointer; */
    /* font-size: 1rem; */
  }
  

  
  footer {
    padding: 20px;
    background-color: #333;
  }
  </style>
  
  




<!-- <template>

    <h1>Selamat Datang</h1>
    <button
        class="mt-75 ml-200 w-25  justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        <a href="/" class="font-semibold text-white hover:text-indigo-200">LOGIN</a>
    </button>
    <button
        class="mt-20 ml-200 w-25  justify-left rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        <a href="/" class="font-semibold text-white hover:text-indigo-200">LOGOUT</a>
    </button>

</template> -->
