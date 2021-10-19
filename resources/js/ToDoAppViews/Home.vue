<template>
<main>
  <div class="flex flex-col items-center justify-center">
      <h3 class="mb-3 text-black font-bold text-xl ">
          Todo App
      </h3>

      <form-todolist @added="taskAdded"></form-todolist>

      <form  class="w-6/12 mb-2" @submit.prevent >

          <div v-for="(todo, index) in todos" :key="index" >
          <!--    Edit form -->
              <form-update :todo_content="todo.todo_content" :chosenFormId="chosenFormId"  :visibleForm="visibleForm" :index="index" :id="todo.id"
                @updated="formUpdated"
              ></form-update>

          <!-- Edit Form-->

          <div :class="todo.completed===1?'border-2 rounded border-solid border-green-900 bg-green-300 text-white':''"
               v-show="chosenFormId!==index" class=" relative shadow-md flex items-center  border-teal-500 py-3 mb-2">

              <div @click="displayOptions(index)" class="absolute top-0 right-0 h-7 w-7 ">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                 </svg>
              </div>

              <div  v-if="todo.completed===1" class="absolute bottom-0 right-0 h-6 w-7   ">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
              </div>


              <div v-show="chosenId===index" :class="visibleOptions"  class="absolute grid grid-cols-4 gap-2  top-1 right-0 mt-2 py-2 bg-white border rounded shadow-xl">
                <div  @click="editTask(index)"  class="px-2 cursor-pointer ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                </div>

                 <div @click="deleteToDo(todo.id)" class="px-2 cursor-pointer">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                     </svg>
                 </div>



                  <div v-if="todo.completed===0" class="px-2 cursor-pointer" @click="completedTask(todo.id)">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                      </svg>
                  </div>

                  <div class="px-2 cursor-pointer" @click="hideOptions">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z" />
                      </svg>
                  </div>

              </div>



            <div  class="">
               <h2 class="text-lg px-2">{{todo.todo_content}}</h2>
            </div>
          </div>



          </div>
      </form>
  </div>
</main>
</template>

<script>
export default {
    mounted(){
        this.fetchToDOLists();
    },
    data(){
        return {
            visibleOptions: 'hidden',
            visibleForm: false,
            chosenId: null,
            chosenFormId: null,
            user_id: this.$store.getters.user_id,
            todos: [],
            todo:{
                todo_content: '',
            },
            formData: {
                todo_content: '',
                user: this.$store.getters.user_id,

            },


        }
    },

    methods: {
        displayOptions(index){
            this.visibleOptions = ''
            this.chosenId = index
        },

        formUpdated(todos) {
            this.todos = todos
            this.visibleForm = false
            this.chosenFormId = null
            this.visibleOptions = 'hidden'
        },

        taskAdded(todos) {
            this.todos = todos
        },

        hideOptions(){
            this.visibleOptions = 'hidden'
        },

        editTask(index){
            this.visibleForm = true
            this.chosenFormId = index
        },

        completedTask(id) {
            this.formData = {
                'todo_content': this.todo_content,
                'user': this.$store.getters.user_id,
                'id': id,
                'completed': 1,
            }

            this.$store.dispatch("completeTask", this.formData).then(resp => {
                this.todos = this.$store.getters.response
                this.visibleOptions = 'hidden'
                alert('Updated.')
                this.$emit('updated', this.todos)
            }).catch(error => {
                console.error(this.$store.getters.errors);
            })
        },

        async fetchToDOLists() {
          await fetch("api/todo_list").then(response => {
             if(response.status !== 200) {
                 console.log(
                     "Looks like there was a problem. Status Code: " +
                     response.status
                 );
                 return;
             }
             response.json().then(data => {
                 this.todos = data
                 console.log(data)
             })
          });
        },


       deleteToDo(id) {
           this.$store.dispatch("deleteTask", id).then(resp => {
               this.todos = this.$store.getters.response
               alert('Deleted.')
           }).catch(error => {
               console.error(this.$store.getters.errors);
           })
       }



    }
}
</script>
