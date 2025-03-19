import "./bootstrap";
import { createRouter, createWebHistory } from "vue-router";
import Login from "./pages/login.vue";
import Register from "./pages/register.vue";
// import Dashboard from "./pages/dashboard.vue";
import Home from "./pages/home.vue";
import OtpLogin from "./pages/otp.login.vue";
import OtpRegister from "./pages/otp.register.vue";




const routes = [
    {
        path : "/",
        name : "login",
        component : Login 
    },
    {
        path : "/register",
        name : "register",
        component : Register
    },
    {
        path : "/home",
        name : "home",
        component : Home
    },
    {
        path : "/otp.login",
        name : "otp.login",
        component : OtpLogin
    },
    {
        path : "/otp.register",
        name : "otp",
        component : OtpRegister
    }
    // {
    //     path : "/loginotp",
    //     name : "loginotp",
    //     component : Loginotp
    // }

];

const router = createRouter ({
    history : createWebHistory(),
    routes,
});

export default router;