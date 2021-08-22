<template>
    <div>
        <input type="text" class="form-control m-1" v-model="user.name" placeholder="Name"> 
        <input type="password" class="form-control m-1" v-model="user.password" placeholder="Password"> 
        <button class="btn btn-primary btn-block" @click="login">Login</button>
        <div v-if="error" class="alert alert-danger mt-2"> Error !!!!</div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            user:{
                name:'',
                password:''

            },
            errors:[],
            error:false,
        }
    },
    methods:{
        login(){
            axios.post('api/login',this.user).then(response=>{
                if(response.data.status=='success'){
                    let token=response.data.token
                    localStorage.setItem('token',token)
                    this.error=false
                }else{
                    this.error=true
                }
            })
        }
    },
}
</script>