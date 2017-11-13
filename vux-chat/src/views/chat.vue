<template>
<div>
    <p v-for="item in items">
        {{item}}
    </p>
    <group  class="weui-cells_form" style="position:absolute;bottom:0;">
      <x-input :title="name" class="weui-vcode" v-model="kkk">
        <x-button slot="right" type="primary" @click.native="clickButton" mini>发送</x-button>
      </x-input>
    </group>  
</div>

</template>

<script>
import Vue from 'vue'
import { bus } from './bus.js'
import VueSocketio from 'vue-socket.io';
Vue.use(VueSocketio, 'http://localhost:3120');
import { XInput, Group, XButton, Cell } from 'vux'
export default {
  components: {
    XInput,
    XButton,
    Group,
    Cell
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
    data () {
    return {
      kkk:"",
      name:"null",
      items: [],
    }
  },
  mounted(){

  },
    created(){
      console.log("hahahah222222")
      this.name=window.localStorage.getItem("username");
      this.changeName(this.name);
    //   bus.$on("username",function(name){
    //       this.name = name;
    //       console.log("hahahah");
    //       console.log(name);
    //     //   changeName(name);
    //   });
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
      
      this.$socket.emit('chat message', this.kkk);
      this.kkk = null;

    }
  }
}
</script>

