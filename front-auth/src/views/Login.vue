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
        <input type="checkbox" v-model="remember" value="remember-me" @click="rememberF"> Lembrar-me
      </label>
      <label class="float-right mr-2">
            <p class="h3" v-b-tooltip.hover.right title="Para acessar os dados que armazenamos sobre você insira seu usuário e senha AD UNIATENEU, em caso de dúvidas entre em contato com o suporte pelo email: xxxxxx@uniateneu.edu.br"><b-icon icon="question-circle-fill" variant="light"></b-icon></p>
      </label>
      </div>
      <b-button class="btn btn-lg btn-primary btn-block" @click="auth" >CONSULTAR</b-button>
      <b-button class="btn btn-lg btn-primary btn-block" @click="soap" >CONSULTAR SOAP</b-button>
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
      if(localStorage.token){
        this.$store.dispatch('setToken', localStorage.token)
      }

    },
    methods: { 
      rememberF() {
        if(this.remember){
          localStorage.user = this.user.user;
          localStorage.remember = this.remember;
        }else{
          localStorage.user = '';
          localStorage.remember = this.remember;
        }
      },
      soap() {
       this.rememberF();

        this.axios.post(this.$store.getters.getBaseUrl + 'api/login/2', { 
          username: this.user.user, 
          password: this.user.password, 
        }).then(response => { console.log(response)
        }).catch(error=>{console.log(error)});
      },
      auth() {
        this.rememberF();

        this.axios.post(this.$store.getters.getBaseUrl + 'oauth/token', {
          grant_type: 'password', 
          client_id: '4', 
          client_secret: '2Qlk1THzuSS2rb8Fb5vPZ9E44si4oo6kBHyYnBp2', 
          username: this.user.user, 
          password: this.user.password, 
          scope: '*'
        }).then(response => { this.$store.dispatch(
          'setToken', response.data.access_token)
          localStorage.token = this.$store.getters.getToken;
          console.log(response);
        }).catch(error=>{console.log(error)});
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