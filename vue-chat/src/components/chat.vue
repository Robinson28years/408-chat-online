<template>
  <div>
    我的名字: <input type="text" v-model="name">
    <button @click="changeName">change</button>
    <br>
    <br>
    加入频道: <input type="text" v-model="group">
    <button @click="join_group">change</button>
    <br>
    <br>
    <p v-for="item in items">
        {{item}}
    </p>
    <input type="text" name="" v-model="kkk">
    <button @click="clickButton">test</button>
  </div>
</template>
<script>
// import Vue from 'vue'
// import VueSocketio from 'vue-socket.io';
// Vue.use(VueSocketio, 'http://localhost:3120');
export default {
  data() {
    return {
      items : [],
      name : "",
      kkk : "",
      group: null,
    }
  },
  sockets: {
    connect: function() {
      console.log('socket connected');
      this.$socket.emit('authentication', {username: "John", password: "secret"});
    },
    authenticated: function (val) {
      console.log("kkkk"+val);
    },
    customEmit: function(val) {
      console.log('this method was fired by the socket server. eg: io.emit("customEmit", data)')
    },
    test_server: function(val) {
      this.items.push(val);
      console.log(val);
    }
  },
  created(){
    this.$socket.on('authenticated', function(data) {
      console.log("ttttt"+data);
    });
    console.log("test");
    this.$socket.on('chat message from server', function(msg) {
        console.log('get message:' + msg + ' from server');
      });
  },
  methods: {
    changeName: function (val) {
      this.$socket.emit('change name',this.name);
    },
    join_group: function (val) {
      this.$socket.emit('select group',this.group);
    },
    clickButton: function(val) {
      // $socket is socket.io-client instance
      // this.$socket.on('chat message from server', function(val) {
      //   console.log('get message:' + this.kkk + ' from server');
      // });
      this.$socket.emit('chat message', this.kkk);
      this.kkk = null;

    }
  }
}
</script>

