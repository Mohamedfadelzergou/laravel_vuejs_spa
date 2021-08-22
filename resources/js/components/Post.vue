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
                <h5 v-if="edit" class="modal-title" id="exampleModalLabel">Update</h5>
                <h5 v-else class="modal-title" id="exampleModalLabel">Create</h5>
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
                <button v-if="edit" type="button" class="btn btn-success" @click="updatePost">Update</button>
                <button v-else type="button" class="btn btn-success" @click="creatPost">Create</button>
            </div>
            </div>
        </div>
        </div>
        <div v-for="post in posts.data" :key="post.id" class="my-3">
            <h4>{{post.title}}</h4>
            <p>{{post.body}}</p>
            <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#exampleModal" @click="editPost(post)">
            Edit
            </button>
            <button type="button" class="btn btn-danger btn-sm float-right" @click="deletePost(post.id)">
            delete
            </button>
        </div>
        <pagination :data="posts" @pagination-change-page="getPosts"></pagination>
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
            posts:{},
            edit:false,
        }
    },
    methods:{
        creatPost(){
            let token=localStorage.getItem('token')
            axios.post('api/creatPost?token='+token,this.post).then(response=>{
                if(response.data.status=='error'){
                    this.errors=response.data.errors;
                }
                else if (response.data.status=='success'){
                    this.getPosts()
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
        getPosts(page=1){
            axios.get('api/getPosts?page='+page).then(response=>{
                this.posts=response.data.data;
            })
        },
        editPost(post){
            this.post=post;
            this.edit=true;
        },
        updatePost(){
            let token=localStorage.getItem('token')
            axios.put('api/updatePost/'+this.post.id+'?token='+token,this.post).then(response=>{
                if(response.data.status=='error'){
                    this.errors=response.data.errors;
                }
                else if (response.data.status=='success'){
                    Toast.fire({
                    icon: 'success',
                    title: 'Updated successfully'
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
        deletePost(postid){
            let token=localStorage.getItem('token')
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                axios.delete('api/deletePost/'+postid+'?token='+token).then(response=>{
                    if(response.data.status=='success'){
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                        this.getPosts();
                    }
                })
                
            }
            })
        }
    },
    created(){
        this.getPosts()
    }
}
</script>
