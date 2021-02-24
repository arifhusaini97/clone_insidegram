<template>
  <!-- must start with a single blade -->
  <div class="container">
    <button class="btn btn-primary ml-4" @click="followUser" v-text="buttonText"></button>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    followUser() {
      // alert("Great");
      // For testing purpose
      // axios.post("/follow/1").then((response) => {
      //     alert(response.data);
      //  });

      axios.post("/follow/"+this.userId).then((response) => {
        this.status =! this.status;
          console.log(response.data);
       }).catch(errors =>{
         if(errors.response.status==401){
           window.location='/login';
         }
       });
    },
  },
  data:function(){
    return {
      status:this.follows,
    }
  },
  props: ["userId", "follows"],
  computed:{
    buttonText(){
      return (this.status)? 'Unfollow': 'Follow';
    }
  }
};
</script>
