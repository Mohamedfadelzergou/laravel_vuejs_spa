<template>
    <div>
        <input type="text" class="form-control m-1" v-model="user.name" placeholder="Name"> 
        <input type="email" class="form-control m-1" v-model="user.email" placeholder="Email"> 
        <input type="password" class="form-control m-1" v-model="user.password" placeholder="Password"> 
        <button class="btn btn-primary btn-block" @click="register">Register</button>
    </div>
</template>
<script>
export default {
    data(){
        return{
            user:{
                name:'',
                email:'',
                password:''

            },
            errors:[],
        }
    },
    methods:{
        register(){
            axios.post('api/register',this.user).then(response=>{
            })
        }
    },
}
</script>