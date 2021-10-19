<template>
    <div v-show="chosenFormId===index" :class="visibleForm? '':'hidden'" class="flex items-center border-b border-b-2 border-teal-500 py-2">
    <input
        v-model="todo_content"
        class="shadow-md h-12 appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-2
                     px-4 leading-tight  focus:outline-none border rounded"
        type="text" placeholder="Add your new task..." aria-label="Task"
    >
    <button @click="updateToDo(id)" class=" text-white py-4 px-4 rounded  bg-purple-900 hover:bg-purple-800" >
        Update
    </button>
</div>


</template>

<script>
export default  {
    props: ['todo_content', 'user_id','index', 'chosenFormId', 'visibleForm', 'id'],
    data(){
        return {
            formData: {}
        }
    },

    methods: {
        updateToDo() {

            this.formData = {
                'todo_content': this.todo_content,
                'user': this.$store.getters.user_id,
                'id': this.id,
            }

            this.$store.dispatch("updateTask", this.formData).then(resp => {
                this.todos = this.$store.getters.response
                alert('Updated.')
                this.$emit('updated', this.todos)
            }).catch(error => {
                console.error(this.$store.getters.errors);
            })


        },
    }
}
</script>
