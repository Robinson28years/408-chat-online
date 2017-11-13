<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>
import bus from './views/bus'
export default {
  name: 'app',
//   created(){
//         console.log("3333333333")
//       bus.$on("username",function(name){
//           this.name = name;
//           console.log("66666666666666");
//           console.log(name);
//         //   changeName(name);
//       });
// }
}

</script>

<style lang="less">
@import '~vux/src/styles/reset.less';

body {
  background-color: #fbf9fe;
}
</style>
