<template>
    <div>
       <!-- Button trigger modal -->
        <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#exampleModal">
        New Post
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" :class="['form-control my-2',errors.title?'is-invalid':'']" name="title" placeholder="Title" v-model="post.title">
                <span v-if="errors.title" class="bg-danger text-white p-1 rounded">{{errors.title[0]}}</span>
                <textarea name="body" cols="30" rows="10" :class="['form-control my-2',errors.body?'is-invalid':'']" placeholder="Body" v-model="post.body"></textarea>
                <span v-if="errors.body" class="bg-danger text-white p-1 rounded">{{errors.body[0]}}</span>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" @click="creatPost">Create</button>
            </div>
            </div>
        </div>
        </div>
        <div v-for="post in posts" :key="post.id">
            <h4>{{post.title}}</h4>
            <p>{{post.body}}</p>
        </div>
    </div>

</template>
<script>
export default {
    data(){
        return{
            post:{
                id:'',
                title:'',
                body:''

            },
            errors:[],
            posts:{}
        }
    },
    methods:{
        creatPost(){
            axios.post('api/creatPost',this.post).then(response=>{
                if(response.data.status=='error'){
                    this.errors=response.data.errors;
                }
                else if (response.data.status=='success'){
                    this.posts.unshift(response.data.data)
                    Toast.fire({
                    icon: 'success',
                    title: 'Created successfully'
                    })
                    this.errors=[]
                    this.post={
                        id:'',
                        title:'',
                        body:'',
                        }
                }
            })
        },
        getPosts(){
            axios.get('api/getPosts').then(response=>{
                this.posts=response.data.data;
            })
        },
    },
    created(){
        this.getPosts()
    }
}
</script>
