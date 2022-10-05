<template>
    <h1 class="bg-primary fs-1 fw-bold text-white text-center py-2 text-uppercase">Single Page Todo App</h1>
    <div class="container">
        <div class="col-md-6 offset-3">
            <div>
                <!-- <form action="" method="post" @submit.prevent="todoSave"> -->
                    <div class="group-input">
                        <label for="item_name" class="fs-5 my-2">Item Name</label>
                        <input type="text" id="item_name" class="form-control" v-model="items_input.item_name" placeholder="Enter your Item name here">
                    </div>
                    <div class="group-input">
                        <label for="date" class="fs-5 my-2">Date</label>
                        <input type="date" class="form-control" id="date" v-model="items_input.date" >
                    </div>
                    <div class="group-input">
                        <label for="price" class="fs-5 my-2">Price</label>
                        <input type="text" id="price" class="form-control" v-model="items_input.price" placeholder="Enter your Item price here">
                    </div>
                    <div class="group-input">
                        <label for="price" class="fs-5 my-2">Ststus</label>
                        <select name="completed" class="form-control" id="completed" v-model="items_input.completed" >
                            <option value="0">Incompleted</option>
                            <option value="1">Completed</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" v-if="!this.item_id" class="btn btn-success my-2 fs-5 fw-bold" @click="todoSave" >Submit</button>
                        <button type="submit" v-else class="btn btn-success my-2 fs-5 fw-bold" @click="updateTodo" >Update</button>
                        <button class="btn btn-warning my-2 fs-5 fw-bold mx-2" @click="resetTodo">Reset</button>
                    </div>
                <!-- </form> -->
                <table class="table table-striped table-success">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Item Name</th>
                            <th>Date</th>
                            <th>Item Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in todos" :key="index">
                            <td>{{++index}}</td>
                            <td>{{item.item_name}}</td>
                            <td>{{item.date}}</td>
                            <td>{{item.price}}</td>
                            <td>{{item.completed}}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" @click="editTodo(--index)">Edit</button>
                                <button class="btn btn-sm btn-danger" @click="todoDelete(--index)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            todos:[],
            items_input:{},
            item_id:'',
            item_edit_index: ''
        }
    },
    mounted(){
        console.log("Data Catching");
        axios.get('api/items').then(res =>{
            console.log(res.data);
            this.todos= res.data.items;
        });
    },
    methods:{
        todoSave(){
            
            axios.post('/api/item-create',this.items_input).then(res => {
                console.log(res.data);
                this.todos.push(res.data.items);
                this.items_input=''
            });
        },
        todoDelete(index){
            if(this.todos[index].id){
                axios.get('/api/item-delete/'+this.todos[index].id).then(res => {
                    this.todos.splice(index,1);
                    console.log(res.data.msg);
                })
            }
        },
        editTodo(index){
            if(this.todos[index].id){
                axios.get('/api/item-edit/'+this.todos[index].id).then(res => {
                    this.items_input = this.todos[index];
                    this.item_id = this.todos[index].id;
                    this.item_edit_index = this.todos[index];
                });
            }
        },
        updateTodo(){
            
                axios.put('/api/item-edit/'+this.item_edit_index.id, this.items_input).then(res => {
                    this.resetTodo()
                    this.todos.push(res.data.items, this.todos[index]);
                })
            
        },
        resetTodo(){
            this.items_input = '';
            this.item_id = '';
            this.item_edit_index = '';
        }
    }
}
</script>