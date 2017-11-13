<template>
  <div>
      <group>
          <x-input title="姓名" placeholder="请输入你的名字" v-model="name"></x-input>
      </group> 
      <group>
          <x-button type="primary" action-type="button"  @click.native="submit">确定</x-button>
      </group>
  </div>
</template>

<script>
import {XInput, Group, XButton} from 'vux'
import {bus} from './bus.js'
export default {
  components: {
      XInput,
      Group,
      XButton,
      bus
  },
  created() {
      
  },
  data() {
      return {
          name:null,
      }
  },
  methods:{
      submit(){
          window.localStorage.setItem("username",this.name);
        //   bus.$emit('username',this.name);
          this.$router.push('/chat')
      }
  }

}
</script>

