<template>
  <div id="app" class="w-100 h-100">
    <router-view class=" animate__animated animate__fadeIn"></router-view>
  </div>
</template>

<script>

export default {
  name: 'App',
  components: {
    
  }
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');

#app {
  /*font-family: Avenir, Helvetica, Arial, sans-serif;*/
  text-align: center;
  color: #ffffff;
  font-family: 'Ubuntu', sans-serif;
}

.btn {
  border-style: solid;
  border-color: #027368!important;
  border-width: 5px;
  background-color: #027368!important;
  color: #ffffff!important;
  font-weight: 700;

}

button:disabled,
button[disabled], button:disabled:hover{
  border: 1px solid #02736871!important;
  background-color: #02736883!important;
  color: #ffffff!important;
}

.btn:hover {
  background-color: #0d6158!important;
  border-color: #0d6158!important;
  color: #ffffff!important;
}
</style>
