<template>
    <main class="d-flex align-self-center"> 
    <form class="form-signin shadow-lg rounded">
      <img class="mb-3" src="" alt="" width="250" height="70">
      <h3 class="mb-3">CMP</h3>

      <label for="inputUser" class="sr-only">NOME.SOBRENOME</label>
    
      <input type="text" v-model="user.user" id="inputUser" class="form-control mb-2" placeholder="NOME.SOBRENOME" required autofocus>
      

      <label for="inputPassword" class="sr-only">SENHA</label>
      <input type="password" v-model="user.password" id="inputPassword" class="form-control" placeholder="SENHA" required>

      <div class="checkbox mb-4 mt-3 align-items-center">
      <label class="float-left mt-1">
        <input type="checkbox" v-model="remember" value="remember-me"> Lembrar-me
      </label>
      <label class="float-right mr-2">
            <p class="h3" v-b-tooltip.hover.right title="Para acessar os dados que armazenamos sobre você insira seu usuário e senha AD UNIATENEU, em caso de dúvidas entre em contato com o suporte pelo email: xxxxxx@uniateneu.edu.br"><b-icon icon="question-circle-fill" variant="light"></b-icon></p>
      </label>
      </div>
      <b-button class="btn btn-lg btn-primary btn-block" @click="auth" >CONSULTAR</b-button>

    </form>
  </main>
</template>

<script>
export default {
    data() {
      return {
        user: {
          user:  '',
          password: '',
        },
        remember: '',
      }
    },
    mounted() {
      if(localStorage.user){
        this.user.user = localStorage.user;
        this.remember = localStorage.remember;
      }
    },
    methods: { 
      singin() {
        if(this.remember){
          localStorage.user = this.user.user;
          localStorage.remember = this.remember;
        }else{
          localStorage.user = '';
          localStorage.remember = this.remember;
        }
      },
      auth() {
        //const response =  this.axios.post(this.$store.getters.getBaseUrl + "authsingin", { user: this.user, password: this.password });

        this.axios.get(this.$store.getters.getBaseUrl + 'oauth/clients').then(response => {console.log(response.data)})
        //this.singin();
      },
    },

}
</script>

<style>

main{
  height: 90vh;
}

.form-signin {
  padding: 20px;
  width: 100%;
  max-width: 400px;
  margin: auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}


</style>