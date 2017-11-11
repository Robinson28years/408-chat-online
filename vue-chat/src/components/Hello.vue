<template>
  <div class="hello">
      <button @click="login">登录</button>
      <br>
      <input v-model="msg"></input>
      <br>
      <button @click="send">发送</button>
      <br>

  </div>
</template>

<script>

export default {
  name: 'hello',
  ws:null,
  data () {
    return {
      msg: '',
    }
  },
  created () {
    this.ws = new WebSocket("ws://localhost:7272");
     this.ws.onmessage = function (evt) {
                    var received_msg = evt.data;
                    console.log(evt.data);
                    // alert("数据已接收...");
                };
  },
  methods : {
    login() {
                this.ws.onopen = function () {
                console.log("okioko");
                    // Web Socket 已连接上，使用 send() 方法发送数据
                    this.ws.send('{"type": "login","room_id": 2,"client_name":"hahah"}');
                    alert("数据发送中...");
                };


    },
    send() {
      // var ws = new WebSocket("ws://localhost:7272");
       ws.onopen = function () {
                    // Web Socket 已连接上，使用 send() 方法发送数据
                     ws.send('{"type":"say","content":"hahah","to_client_id":"all"}');
                    alert("会话发送中...");
                };
                ws.onmessage = function (evt) {
                    var received_msg = evt.data;
                    console.log(evt.data);
                    // alert("数据已接收...");
                };
      // ws.send('{"type": "login","room_id": 2,"client_name":"hahah"}');
      // ws.send('{"type":"say","content":"hahah","to_client_id":"all"}');
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>
