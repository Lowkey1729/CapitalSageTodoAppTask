<template>


    <form class="w-6/12 mb-2" @submit.prevent >
        <div class="flex items-center border-b border-b-2 border-teal-500 py-2">

            <input
                v-model="formData.todo_content"
                class="shadow-md h-12 appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-2
                     px-4 leading-tight  focus:outline-none border rounded"
                type="text" placeholder="Add your new task..." aria-label="Full name">

            <button @click="addToDo" class=" py-4 px-4 rounded text-white  bg-purple-900 hover:bg-purple-800" >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </button>
        </div>
    </form>

</template>
<script>
export default {
    data() {
        return {
            formData: {
                todo_content: '',
                user: this.$store.getters.user_id,

            },
        }
    },
    methods: {
        addToDo(e){
            e.preventDefault()
            if(this.formData.todo_content !== ''){
                this.$store.dispatch("createTask", this.formData).then(resp => {
                    this.todos = this.$store.getters.response
                    this.$emit('added', this.todos)
                    alert('Added.')
                }).catch(error => {
                    console.error(this.$store.getters.errors);
                })

            }

        },
    }
}
</script>
